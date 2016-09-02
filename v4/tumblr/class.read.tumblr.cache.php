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

class readTumblrCache extends readTumblr {
	protected $cacheDir = null;
	protected $cacheTime = null;
	
	public function __construct($tumblrId,$cacheDir = null,$cacheTime = 3600) {
		if ($cacheDir != null && is_dir($cacheDir) && $cacheTime != null && is_int($cacheTime)) {
			$this->useCache = true;
			$this->cacheDir = $cacheDir;
			$this->cacheTime = $cacheTime;
		}
		parent::__construct($tumblrId);
	}
	
	protected function __cacheRead($params = array()) {
		$cacheFilePath = $this->__cacheFilePath($params);
		if (file_exists($cacheFilePath)) {
			if (time() - filemtime($cacheFilePath) < $this->cacheTime) {
				$this->xml = file_get_contents($cacheFilePath);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	protected function __cacheWrite($params = array()) {
		file_put_contents($this->__cacheFilePath($params),$this->xml);
		return true;
	}
	
	protected function __cacheFilePath($params = array()) {
		$cacheFilePath = $this->tumblrId;
		$cacheFilePath .= '.';
		foreach ($params as $k => $v) {
			$cacheFilePath .= $k.'_'.$v.'.';
		}
		if (substr($cacheFilePath,-1) != '.') {
			$cacheFilePath .= '.';
		}
		$cacheFilePath .= 'xml';

		$cacheFilePath = $this->cacheDir.'/'.$cacheFilePath;
		return $cacheFilePath;
	}
}