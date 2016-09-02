#!/usr/bin/env php
<?php

class debianChangelog
{
	public $f = 'debian/changelog';
	
	public function __construct()
	{
		if (!is_file($this->f)) {
			throw new Exception('No changelog file found');
		}
	}
	
	private function readLastRevision()
	{
		$f = file($this->f);
		$res = array();
		$done = false;
		
		foreach ($f as $v)
		{
			$v = rtrim($v,"\n");
			
			# First line of a change
			if (strpos($v,' ') !== 0 && trim($v) != '')
			{
				if ($done) {
					break;
				}
				
				$done = true;
				$res = $this->getPackageInfo($v,$res[$i]);
			}
			# Maintainer information
			elseif (strpos($v,' --') === 0)
			{
				$res['maintainer'] = $this->getMaintainerInfo($v);
			}
			# Changelog
			elseif (strpos($v,'  ') === 0)
			{
				$res['changelog'] .= $v."\n";
			}
		}
		
		return $res;
	}
	
	public function writeChangelog()
	{
		$ch = $this->readLastRevision();
		
		# Get debian revision
		$rev = 1;
		if (preg_match('/^(.*)-(\d+)$/',$ch['version'],$m)) {
			$ch['version'] = $m[1];
			$rev = $m[2];
		}
		$rev++;
		
		# Get SVN revision
		$svnrev = isset($ch['keywords']['svnrev']) ? (integer) $ch['keywords']['svnrev'] : 1;
		
		# Get current SVN revision
		$currev = svnInfo::getCurrentRevision();
		if ($currev <= $svnrev) {
			return;
		}
		
		$changelog = '';
		foreach (svnInfo::getChangeLog($svnrev+1,$currev) as $vch)
		{
			$changelog .=
			'  * SVN Revision '.$vch['rev'].' - '.$vch['author'].', on '.$vch['date']."\n".
			$vch['changelog']."\n";
		} 
		
		$res =
		$ch['package'].' ('.$ch['version'].'-'.$rev.') '.$ch['dist'].'; urgency='.$ch['keywords']['urgency'].
		' ; svnrev='.$currev.
		"\n\n".
		rtrim($changelog)."\n\n".
		' -- '.$ch['maintainer']['name'].' <'.$ch['maintainer']['email'].'>  '.date('r')."\n".
		"\n";
		
		$old_changelog = file_get_contents($this->f);
		$fp = fopen($this->f,'wb');
		fwrite($fp,$res.$old_changelog);
		fclose($fp);
	}
	
	private function getPackageInfo($l)
	{
		$res = array(
			'package' => '',
			'version' => '',
			'dist' => '',
			'keywords' => '',
			'changelog' => '',
			'maintainer' => array()
		);
		
		$l = explode(';',$l);
		
		# Info
		$info = array_shift($l);
		$res['package'] = strtok($info,' ');
		$res['version'] = strtok('()');
		$res['dist'] = trim(strtok(';'));
		
		# Keywords
		foreach ($l as $v) {
			$v = explode('=',$v);
			if (count($v) == 2) {
				$res['keywords'][trim($v[0])] = trim($v[1]);
			}
		}
		
		return $res;
	}
	
	private function getMaintainerInfo($l)
	{
		$res = array(
			'name' => '',
			'email' => '',
			'date' => ''
		);
		
		if (preg_match('/^ -- (.+?) <(.+?)>  (.+?)$/',$l,$m)) {
			$res['name'] = $m[1];
			$res['email'] = $m[2];
			$res['date'] = $m[3];
		}
		
		return $res;
	}
}

class svnInfo
{
	public static function getCurrentRevision()
	{
		$info = `export LANG=C; svn info`;
		if (preg_match('/^Revision: (\d+)/ms',$info,$m)) {
			return (integer) $m[1];
		} else {
			throw new Exception('Unable to get current SVN revision');
		}
	}
	
	public static function getChangeLog($fromrev,$torev)
	{
		$log = `export LANG=C;svn log -r $fromrev:$torev`;
		$log = explode("\n",$log);
		
		# Remove two last lines
		array_pop($log);
		array_pop($log);
		
		$i = -1;
		$newline = false;
		$res = array();
		
		foreach ($log as $l)
		{
			# New log line
			if ($l == '------------------------------------------------------------------------')
			{
				$i++;
				$newline = true;
			}
			elseif ($newline)
			{
				$newline = false;
				$res[$i] = self::getRevInfo($l);
			}
			elseif (trim($l) != '')
			{
				$res[$i]['changelog'] .= '    '.$l."\n";
			}
		}
		
		return $res;
	}
	
	private static function getRevInfo($l)
	{
		$res = array(
			'rev' => '',
			'author' => '',
			'date' => '',
			'changelog' => ''
		);
		
		$res['rev'] = substr(trim(strtok($l,'|')),1);
		$res['author'] = trim(strtok('|'));
		$res['date'] = date('r',strtotime(trim(strtok('('))));
		
		return $res;
	}
}

# Main
try
{
	$ch = new debianChangelog();
	$ch->writeChangelog();
}
catch (Exception $e)
{
	fwrite(STDERR,$e->getMessage()."\n");
	exit(1);
}
?>
