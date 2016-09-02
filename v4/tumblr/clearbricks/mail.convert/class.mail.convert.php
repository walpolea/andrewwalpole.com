<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of Clearbricks.
# Copyright (c) 2006 Olivier Meunier and contributors.
# All rights reserved.
#
# Clearbricks is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 
# Clearbricks is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with Clearbricks; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
# ***** END LICENSE BLOCK *****
#
# mail.convert
# This class converts mail body to xHTML in a descent fashion.
# It can also rewrap mail body.

class mailConvert
{
	public $url_pattern = '%(?<![\[\|])(http|https|ftp|news):(//)?(.*?)(["\s\)]|&gt;|&lt;|\Z)%msu';
	
	public static function toHTML($str)
	{
		$o = new self;
		return $o->html(rtrim($str),true);
	}
	
	public static function rewrap($str,$l=72)
	{
		$o = new self;
		return $o->wrap($str,$l);
	}
	
	public static function getSubject($str)
	{
		while (preg_match('/^re: /msiu',$str)) {
			$str = preg_replace('/^re: /msiu','',$str);
		}
		return $str;
	}
	
	public function html($str,$with_signature=false)
	{
		$res = '';
		$signature = '';
		
		if ($with_signature && preg_match('/^(-- \r?\n.+?)\Z/msu',$str,$m))
		{
			$m[1] = preg_replace('/^-- \r?\n/msu','',$m[1]);
			$signature = '<pre class="signature">'.$this->htmlParseBlock($m[1]).'</pre>';
			$str = preg_replace('/^-- \r?\n(.+?)\Z/msu','',$str);
			$str = rtrim($str);
		}
		
		foreach ($this->getTockens($str) as $t)
		{
			switch ($t['type'])
			{
				case 'block':
					$t['content'] = $this->htmlParseBlock($t['content']);
					$res .= '<pre>'.$t['content']."</pre>\n";
					break;
				case 'quote':
					$res .= "<blockquote>\n".$this->html($t['content'])."</blockquote>\n\n";
					break;
			}
		}
		
		return $res.$signature;
	}
	
	public function wrap($str,$l=72)
	{
		$str = $this->prepareString($str);
		
		$res = '';
		
		foreach (explode("\n",$str) as $line)
		{
			$sep = "\n";
			if (preg_match('/^([>\|]+\s*)/su',$line,$m)) {
				$sep .= $m[1];
			}
			
			$line = wordwrap($line,$l,$sep,false)."\n";
			
			$res .= $line;
		}
		
		return $res;
	}
	
	protected function prepareString($str)
	{
		return preg_replace('/\r?\n/msu',"\n",$str);
	}
	
	protected function getTockens($str)
	{
		$str = $this->prepareString($str);
		
		$tockens = array();
		$type = null;
		$id = -1;
		
		foreach (explode("\n",$str) as $line)
		{
			if (preg_match('/^(?:\s*)(?:>|\|)(?:\s?)(.*?)$/su',$line,$m))
			{
				if ($type != 'quote' && !trim($m[1])) {
					continue;
				}
				
				if ($type == 'quote') {
					$tockens[$id]['content'] .= $m[1]."\n";
				} else {
					$id++;
					$type = 'quote';
					$tockens[$id]['type'] = $type;
					$tockens[$id]['content'] = $m[1]."\n";
				}
			}
			# Empty line
			elseif (preg_match('/^\s*$/su',$line))
			{
				if ($type == 'block') {
					$tockens[$id]['content'] .= "\n";
				}
			}
			# Defaults to block
			else
			{
				if ($type == 'block') {
					$tockens[$id]['content'] .= $line."\n";
				} else {
					$id++;
					$type = 'block';
					$tockens[$id]['type'] = $type;
					$tockens[$id]['content'] = $line."\n";
				}
			}
		}
		
		foreach ($tockens as $i => $t)
		{
			$tockens[$i]['content'] = preg_replace('/\n$/su','',$t['content']);
		}
		
		return $tockens;
	}
	
	protected function htmlParseBlock($str)
	{
		$str = html::escapeHTML($str);
		
		# Transform links
		$str = preg_replace_callback($this->url_pattern,array($this,'htmlUrlHandler'),$str);
		
		# Transform * / _ strings (does not work, may transform links href)
		#$str = preg_replace_callback('%([\*_/])([\w\s]+?)([\*_/])%msu',array($this,'htmlFormatHandler'),$str);
		
		return $str;
	}
	
	protected function htmlUrlHandler($m)
	{
		$url = $m[1].':'.html::decodeEntities($m[2].$m[3]);
		$content = $url;
		$title = '';
		
		if (strlen($url) > 42) {
			$content = substr($url,0,42).'...';
			$title = ' title="'.html::escapeHTML($url).'"';
		}
		
		return '<a href="'.html::escapeHTML($url).'"'.$title.'>'.html::escapeHTML($content).'</a>'.$m[4];
	}
	
	protected function htmlFormatHandler($m)
	{
		switch ($m[1])
		{
			case '*':
				return '<strong>'.$m[2].'</strong>';
			case '/':
				return '<em>'.$m[2].'</em>';
			case '_':
				return '<ins>'.$m[2].'</ins>';
		}
	}
}
?>