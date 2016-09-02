<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of Clearbricks.
# Copyright (c) 2006 Olivier Meunier and contributors. All rights
# reserved.
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

class nntpMessage extends mimeMessage
{
	public function __construct($message)
	{
		parent::__construct($message);
	}
	
	public function getTS()
	{
		if (isset($this->headers['date'])) {
			return strtotime($this->headers['date']);
		}
		
		return time();
	}
	
	public function getReferences()
	{
		if (!isset($this->headers['references'])) {
			return array();
		}
		
		return explode(' ',$this->headers['references']);
	}
}
?>