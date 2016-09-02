<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of phpTumblr.
# Copyright (c) 2006 Simon Richard and contributors. All rights
# reserved.
#
# phpTumblr is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 
# phpTumblr is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with phpTumblr; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
# ***** END LICENSE BLOCK *****

class readTumblr {
	protected $tumblrId = '';
	protected $httpObj = null;
	protected $xml = '';
	protected $xmlArr = array();
	protected $tumblrPostTypes = array('regular','quote','photo','link','conversation','video','audio');
	protected $useCache = false;
	protected $firstRequest = true;
	protected $totalPosts = 0;

	
	/* Public functions
	*********************/
	public function __construct($tumblrId = null) {
		if ($tumblrId != null) {
			$this->tumblrId = $tumblrId;
			$httpObj = &$this->httpObj;
			$httpObj = new netHttp($this->tumblrId.'.tumblr.com');
			$httpObj->setUserAgent('phpTumblr');
			return true;
		} else {
			unset($this);
			return false;
		}
	}
	
	public function getPosts($start = 0,$num = 20,$type = null,$id = null) {
		$params = array();
		
		if ($id == null) {
			if ($start != null && is_numeric($start)) { $params['start'] = $start; } else { $params['start'] = 0; }
			if ($num != null && is_numeric($num)) { $params['num'] = $num; } else { $params['num'] = 20; }
			if ($type != null && is_string($type) && in_array($type,$this->tumblrPostTypes)) { $params['type'] = $type; }
		} elseif (is_numeric($id)) {
			$params['id'] = $id;
		}

		if ($num == 'all') {
			$params['num'] = 50;
			$max = $params['start'] + 1;
			$first = true;
			
			while ($max > $params['start']) {
				$this->__apiRead($params);
				
				if ($first) {
					$max = $this->totalPosts;
					$first = false;
				}
				
				$params['start'] = $params['start'] + 50;
			}
		} elseif ($num > 50) {
			$params['num'] = $nextDo = 50;
			$done = 0;
			$toDo = $num;
			$first = true;
			while (true) {
				$this->__apiRead($params);
				
				if ($first) {
					$max = $this->totalPosts;
					$first = false;
				}
				
				$done = $done + $nextDo;
				$toDo = $toDo - $nextDo;
				
				if ($done >= $max || $toDo == 0) { break; }
				
				if ($toDo >= 50) { $nextDo = 50; } else { $nextDo = $toDo; }
				
				$params['start'] = $start + $done;
				$params['num'] = $nextDo;
			}
		} else {		
			$this->__apiRead($params);
		}
		return true;
	}
	
	public function sortArray($chrono = false) {
		$xmlArr = &$this->xmlArr;
		if ($chrono) {
			ksort($xmlArr['posts'],SORT_NUMERIC);
		} else {
			krsort($xmlArr['posts'],SORT_NUMERIC);
		}
		return true;
	}
	
	public function getXml() {
		return $this->xml;
	}
	
	public function getArray() {
		return $this->xmlArr;
	}
	
	public function flush($tumblrId = null) {
		$_tumblrId = ($tumblrId == null) ? $this->tumblrId : $tumblrId;
		unset($this->tumblrId,$this->httpObj,$this->xml,$this->xmlArr);
		$this->firstRequest = true;
		$this->__construct($_tumblrId);
		return true;
	}
	
	public static function quickGetPosts($tumblrId = null,$start = 0,$num = 20,$type = null,$id = null) {
		if ($tumblrId != null) {
			$tObj = new readTumblr($tumblrId);
			$tObj->getPosts($start,$num,$type,$id);
			$tObj->sortArray();
			return $tObj->getArray();
		} else {
			return false;
		}
	}
	/* Protected functions
	*********************/
	protected function __apiRead($params) {
		$httpObj = &$this->httpObj;
		
		if (!$this->useCache || !$this->__cacheRead($params)) {
			$httpObj->get('/api/read',$params);
			if ($httpObj->getStatus() != 200) { return false; }
			$this->xml = $httpObj->getContent();
		}
		
		if ($this->useCache) {
			$this->__cacheWrite($params);
		}

		$this->__xml2array();
		return true;
	}
	
	protected function __xml2array() {
		$xmlArr = array();
		$xmlObj = new SimpleXMLElement($this->xml);
		
		$this->totalPosts = (int) $xmlObj->posts->attributes()->total;
		
		if ($this->firstRequest) {
			$xmlArr['tumblelog']['title'] = (string) $xmlObj->tumblelog->attributes()->title;
			$xmlArr['tumblelog']['description'] = (string) $xmlObj->tumblelog;
			
			if ((string) $xmlObj->tumblelog->attributes()->cname == null) {
				$xmlArr['tumblelog']['url'] =  (string) 'http://'.$xmlObj->tumblelog->attributes()->name.'.tumblr.com/';
			} else {
				$xmlArr['tumblelog']['url'] =  (string) 'http://'.$xmlObj->tumblelog->attributes()->cname.'/';
			}
			
			$xmlArr['tumblelog']['timezone'] = (string) $xmlObj->tumblelog->attributes()->timezone;
			$this->firstRequest = false;
		}
				
		foreach ($xmlObj->posts->children() as $k => $v) {
			$pid = (integer) $v->attributes()->{'unix-timestamp'}.'|'.$v->attributes()->id;
			$xmlArr['posts'][$pid]['id'] = (integer) $v->attributes()->id;
			$xmlArr['posts'][$pid]['url'] = (string) $v->attributes()->url;
			$xmlArr['posts'][$pid]['type'] = (string) $v->attributes()->type;
			$xmlArr['posts'][$pid]['timestamp'] = (integer) $v->attributes()->{'unix-timestamp'};
			$xmlArr['posts'][$pid]['bookmarklet'] = (boolean) $v->attributes()->bookmarklet;
			$xmlArr['posts'][$pid]['mobile'] = (boolean) $v->attributes()->mobile;
		
			switch ($v->attributes()->type) {
				case 'regular' :
					$xmlArr['posts'][$pid]['content']['title'] = (string) $v->{'regular-title'};
					$xmlArr['posts'][$pid]['content']['body'] = (string) $v->{'regular-body'};
					break;
				case 'quote' :
					$xmlArr['posts'][$pid]['content']['quote'] = (string) $v->{'quote-text'};
					$xmlArr['posts'][$pid]['content']['source'] = (string) $v->{'quote-source'};
					break;
				case 'photo' :
					$xmlArr['posts'][$pid]['content']['caption'] = (string) $v->{'photo-caption'};
					$xmlArr['posts'][$pid]['content']['url-500'] = (string) $v->{'photo-url'}[0];
					$xmlArr['posts'][$pid]['content']['url-400'] = (string) $v->{'photo-url'}[1];
					$xmlArr['posts'][$pid]['content']['url-250'] = (string) $v->{'photo-url'}[2];
					$xmlArr['posts'][$pid]['content']['url-100'] = (string) $v->{'photo-url'}[3];
					$xmlArr['posts'][$pid]['content']['url-75sq'] = (string) $v->{'photo-url'}[4];
					break;
				case 'link' :
					$xmlArr['posts'][$pid]['content']['text'] = (string) $v->{'link-text'};
					$xmlArr['posts'][$pid]['content']['url'] = (string) $v->{'link-url'};
					$xmlArr['posts'][$pid]['content']['description'] = (string) $v->{'link-description'};
					break;
				case 'conversation' :
					$xmlArr['posts'][$pid]['content']['text'] = (string) $v->{'conversation-text'};
					$x = 0;
					foreach ($v->{'conversation-line'} as $k) {
						$xmlArr['posts'][$pid]['content']['lines'][$x]['name'] = (string) $k->attributes()->name;
						$xmlArr['posts'][$pid]['content']['lines'][$x]['content'] = (string) $k;
						$x++;
					}
					break;
				case 'video' :
					$xmlArr['posts'][$pid]['content']['caption'] = (string) $v->{'video-caption'};
					$xmlArr['posts'][$pid]['content']['source'] = (string) $v->{'video-source'};
					$xmlArr['posts'][$pid]['content']['player'] = (string) $v->{'video-player'};
					break;
				case 'audio' :
					$xmlArr['posts'][$pid]['content']['caption'] = (string) $v->{'audio-caption'};
					$xmlArr['posts'][$pid]['content']['player'] = (string) $v->{'audio-player'};
					$xmlArr['posts'][$pid]['content']['plays'] = (string) $v->{'audio-plays'};
					break;
			}
		}
		if (!isset($this->xmlArr['posts'])) {
			$xmlArr = $this->__cleanArr($xmlArr);
			$this->xmlArr = $xmlArr;
		} else {
			$xmlArr['posts'] = $this->__cleanArr($xmlArr['posts']);
			$this->xmlArr['posts'] = $this->xmlArr['posts'] + $xmlArr['posts'];
		}
		return true;
	}
	
	protected function __cleanArr($arr = null) {
		if (!$arr) { $arr = $this->xmlArr; }
		foreach ($arr as $k => $v) {
			if (is_string($arr[$k])) {
				$arr[$k] = utf8HtmlEntityDecode::htmlentities2utf8($arr[$k],ENT_QUOTES,'ISO-8859-1');
				$arr[$k] = trim($arr[$k]);
			}
			if (is_array($arr[$k])) { $arr[$k] = $this->__cleanArr($arr[$k]); }
		}
		return $arr;
	}
}
?>