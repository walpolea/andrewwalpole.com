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

/* From http://fr.php.net/manual/fr/function.html-entity-decode.php#68491 */
class utf8HtmlEntityDecode {
	public static function __chr_utf8($code) {
		if ($code < 0) { return false; }
		elseif ($code < 128) { return chr($code); }
		elseif ($code < 160) {
			if ($code == 128) { $code=8364; }
			elseif ($code == 129) { $code=160; }
			elseif ($code == 130) { $code=8218; }
			elseif ($code == 131) { $code=402; }
			elseif ($code == 132) { $code=8222; }
			elseif ($code == 133) { $code=8230; }
			elseif ($code == 134) { $code=8224; }
			elseif ($code == 135) { $code=8225; }
			elseif ($code == 136) { $code=710; }
			elseif ($code == 137) { $code=8240; }
			elseif ($code == 138) { $code=352; }
			elseif ($code == 139) { $code=8249; }
			elseif ($code == 140) { $code=338; }
			elseif ($code == 141) { $code=160; }
			elseif ($code == 142) { $code=381; }
			elseif ($code == 143) { $code=160; }
			elseif ($code == 144) { $code=160; }
			elseif ($code == 145) { $code=8216; }
			elseif ($code == 146) { $code=8217; }
			elseif ($code == 147) { $code=8220; }
			elseif ($code == 148) { $code=8221; }
			elseif ($code == 149) { $code=8226; }
			elseif ($code == 150) { $code=8211; }
			elseif ($code == 151) { $code=8212; }
			elseif ($code == 152) { $code=732; }
			elseif ($code == 153) { $code=8482; }
			elseif ($code == 154) { $code=353; }
			elseif ($code == 155) { $code=8250; }
			elseif ($code == 156) { $code=339; }
			elseif ($code == 157) { $code=160; }
			elseif ($code == 158) { $code=382; }
			elseif ($code == 159) { $code=376; }
		}
		if ($code < 2048) { return chr(192 | ($code >> 6)) . chr(128 | ($code & 63)); }
		elseif ($code < 65536) { return chr(224 | ($code >> 12)) . chr(128 | (($code >> 6) & 63)) . chr(128 | ($code & 63)); }
		else { return chr(240 | ($code >> 18)) . chr(128 | (($code >> 12) & 63)) . chr(128 | (($code >> 6) & 63)) . chr(128 | ($code & 63)); }
	}

	public static function __html_entity_replace($matches) {
		if ($matches[2]) {
			return utf8HtmlEntityDecode::__chr_utf8(hexdec($matches[3]));
		} elseif ($matches[1]) {
			return utf8HtmlEntityDecode::__chr_utf8($matches[3]);
		}
		switch ($matches[3]) {
			case "nbsp": return utf8HtmlEntityDecode::__chr_utf8(160);
			case "iexcl": return utf8HtmlEntityDecode::__chr_utf8(161);
			case "cent": return utf8HtmlEntityDecode::__chr_utf8(162);
			case "pound": return utf8HtmlEntityDecode::__chr_utf8(163);
			case "curren": return utf8HtmlEntityDecode::__chr_utf8(164);
			case "yen": return utf8HtmlEntityDecode::__chr_utf8(165);
		}
		return false;
	}

	public static function htmlentities2utf8 ($string) {
		$string = preg_replace_callback('~&(#(x?))?([^;]+);~',array('utf8HtmlEntityDecode','__html_entity_replace'),$string);
		return $string;
	}
}
?>