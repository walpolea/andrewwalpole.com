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


function __($str)
{
	return (!empty($GLOBALS['__l10n'][$str])) ? $GLOBALS['__l10n'][$str] : $str;
}

class l10n
{
	protected static $langs = array();
	
	public static function init()
	{
		$GLOBALS['__l10n'] = array();
		$GLOBALS['__l10n_files'] = array();
	}
	
	public static function set($file)
	{
		$lang_file = $file.'.lang';
		$po_file = $file.'.po';
		$php_file = $file.'.lang.php';
		
		if (file_exists($php_file))
		{
			require $php_file;
		}
		elseif (($tmp = self::getPoFile($po_file)) !== false)
		{
			$GLOBALS['__l10n_files'][] = $po_file;
			$GLOBALS['__l10n'] = array_merge($GLOBALS['__l10n'],$tmp);
		}
		elseif (($tmp = self::getLangFile($lang_file)) !== false)
		{
			$GLOBALS['__l10n_files'][] = $lang_file;
			$GLOBALS['__l10n'] = array_merge($GLOBALS['__l10n'],$tmp);
		}
		else
		{
			return false;
		}
	}
	
	public static function getLangFile($file)
	{
		if (!file_exists($file)) {
			return false;
		}
		
		$fp = @fopen($file,'r');
		
		if ($fp === false) {
			return false;
		}
		
		$res = array();
		while ($l = fgets($fp))
		{
			$l = trim($l);
			# Comment
			if (substr($l,0,1) == '#') {
				continue;
			}
			
			# Original text
			if (substr($l,0,1) == ';' && ($t = fgets($fp)) !== false && trim($t) != '') {
				$res[$l] = trim($t);
			}
			
		}
		fclose($fp);
		
		return $res;
	}
	
	public static function getPoFile($file)
	{
		if (!file_exists($file)) {
			return false;
		}
		
		$fc = implode('',file($file));
		
		$res = array();
		
		$matched = preg_match_all('/(msgid\s+("([^"]|\\\\")*?"\s*)+)\s+'.
		'(msgstr\s+("([^"]|\\\\")*?(?<!\\\)"\s*)+)/',
		$fc, $matches);
		
		if (!$matched) {
			return false;
		}
		
		for ($i=0; $i<$matched; $i++)
		{
			$msgid = preg_replace('/\s*msgid\s*"(.*)"\s*/s','\\1',$matches[1][$i]);
			$msgstr= preg_replace('/\s*msgstr\s*"(.*)"\s*/s','\\1',$matches[4][$i]);
			
			$msgstr = self::poString($msgstr);
			
			if ($msgstr) {
				$res[self::poString($msgid)] = $msgstr;
			}
		}
		
		if (!empty($res[''])) {
			$meta = $res[''];
			unset($res['']);
		}
		
		return $res;
	}
	
	private static function poString($string,$reverse=false)
	{
		if ($reverse) {
			$smap = array('"', "\n", "\t", "\r");
			$rmap = array('\\"', '\\n"' . "\n" . '"', '\\t', '\\r');
			return trim((string) str_replace($smap, $rmap, $string));
		} else {
			$smap = array('/"\s+"/', '/\\\\n/', '/\\\\r/', '/\\\\t/', '/\\\"/');
			$rmap = array('', "\n", "\r", "\t", '"');
			return trim((string) preg_replace($smap, $rmap, $string));
		}
	}
	
	public static function getFilePath($dir,$file,$lang)
	{
		$f = $dir.'/'.$lang.'/'.$file;
		if (!file_exists($f)) {
			$f = $dir.'/en/'.$file;
		}
		
		return file_exists($f) ? $f : false;
	}
	
	public static function getISOcodes($flip=false)
	{
		if (empty(self::$langs))
		{
			self::$langs = array(
			'aa' => 'Afar',
			'ab' => 'Abkhazian',
			'ae' => 'Avestan',
			'af' => 'Afrikaans',
			'ak' => 'Akan',
			'am' => 'Amharic',
			'an' => 'Aragonese',
			'ar' => 'Arabic',
			'as' => 'Assamese',
			'av' => 'Avaric',
			'ay' => 'Aymara',
			'az' => 'Azerbaijani',
			'ba' => 'Bashkir',
			'be' => 'Belarusian',
			'bg' => 'Bulgarian',
			'bh' => 'Bihari',
			'bi' => 'Bislama',
			'bm' => 'Bambara',
			'bn' => 'Bengali',
			'bo' => 'Tibetan',
			'br' => 'Breton',
			'bs' => 'Bosnian',
			'ca' => 'Catalan',
			'ce' => 'Chechen',
			'ch' => 'Chamorro',
			'co' => 'Corsian',
			'cr' => 'Cree',
			'cs' => 'Czech',
			'cu' => 'Church Slavic',
			'cv' => 'Chuvash',
			'cy' => 'Welsh',
			'da' => 'Danish',
			'de' => 'German',
			'dv' => 'Divehi',
			'dz' => 'Dzongkha',
			'ee' => 'Ewe',
			'el' => 'Greek',
			'en' => 'English',
			'eo' => 'Esperanto',
			'es' => 'Spanish',
			'et' => 'Estonian',
			'eu' => 'Basque',
			'fa' => 'Persian',
			'ff' => 'Fulah',
			'fi' => 'Finnish',
			'fj' => 'Fijian',
			'fo' => 'Faroese',
			'fr' => 'French',
			'fy' => 'Western Frisian',
			'ga' => 'Irish',
			'gd' => 'Scottish Gaelic',
			'gl' => 'Galician',
			'gn' => 'Guarani',
			'gu' => 'Gujarati',
			'gv' => 'Manx',
			'ha' => 'Hausa',
			'he' => 'Hebrew',
			'hi' => 'Hindi',
			'ho' => 'Hiri Motu',
			'hr' => 'Croatian',
			'ht' => 'Haitian',
			'hu' => 'Hungarian',
			'hy' => 'Armenian',
			'hz' => 'Herero',
			'ia' => 'Interlingua',
			'id' => 'Indonesian',
			'ie' => 'Interlingue',
			'ig' => 'Igbo',
			'ii' => 'Sichuan Yi',
			'ik' => 'Inupiaq',
			'io' => 'Ido',
			'is' => 'Icelandic',
			'it' => 'Italian',
			'iu' => 'Inuktitut',
			'ja' => 'Japanese',
			'jv' => 'Javanese',
			'ka' => 'Georgian',
			'kg' => 'Kongo',
			'ki' => 'Kikuyu',
			'kj' => 'Kwanyama',
			'kk' => 'Kazakh',
			'kl' => 'Kalaallisut',
			'km' => 'Khmer',
			'kn' => 'Kannada',
			'ko' => 'Korean',
			'kr' => 'Kanuri',
			'ks' => 'Kashmiri',
			'ku' => 'Kurdish',
			'kv' => 'Komi',
			'kw' => 'Cornish',
			'ky' => 'Kirghiz',
			'la' => 'Latin',
			'lb' => 'Luxembourgish',
			'lg' => 'Ganda',
			'li' => 'Limburgish',
			'ln' => 'Lingala',
			'lo' => 'Lao',
			'lt' => 'Lithuanian',
			'lu' => 'Luba-Katanga',
			'lv' => 'Latvian',
			'mg' => 'Malagasy',
			'mh' => 'Marshallese',
			'mi' => 'Māori',
			'mk' => 'Macedonian',
			'ml' => 'Malayalam',
			'mn' => 'Mongolian',
			'mo' => 'Moldavian',
			'mr' => 'Marathi',
			'ms' => 'Malay',
			'mt' => 'Maltese',
			'my' => 'Burmese',
			'na' => 'Nauru',
			'nb' => 'Norwegian Bokmål',
			'nd' => 'North Ndebele',
			'ne' => 'Nepali',
			'ng' => 'Ndonga',
			'nl' => 'Dutch',
			'nl-be' => 'Dutch (Belgium)',
			'nn' => 'Norwegian Nynorsk',
			'no' => 'Norwegian',
			'nr' => 'South Ndebele',
			'nv' => 'Navajo',
			'ny' => 'Chichewa',
			'oc' => 'Occitan',
			'oj' => 'Ojibwa',
			'om' => 'Oromo',
			'or' => 'Oriya',
			'os' => 'Ossetian',
			'pa' => 'Panjabi',
			'pi' => 'Pāli',
			'pl' => 'Polish',
			'ps' => 'Pashto',
			'pt' => 'Portuguese',
			'pt-br' => 'Portuguese (Brazil)',
			'qu' => 'Quechua',
			'rm' => 'Raeto-Romance',
			'rn' => 'Kirundi',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'rw' => 'Kinyarwanda',
			'sa' => 'Sanskrit',
			'sc' => 'Sardinian',
			'sd' => 'Sindhi',
			'se' => 'Northern Sami',
			'sg' => 'Sango',
			'sh' => 'Serbo-Croatian',
			'si' => 'Sinhalese',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'sm' => 'Samoan',
			'sn' => 'Shona',
			'so' => 'Somali',
			'sq' => 'Albanian',
			'sr' => 'Serbian',
			'ss' => 'Swati',
			'st' => 'Sotho',
			'su' => 'Sundanese',
			'sv' => 'Swedish',
			'sw' => 'Swahili',
			'ta' => 'Tamil',
			'te' => 'Telugu',
			'tg' => 'Tajik',
			'th' => 'Thai',
			'ti' => 'Tigrinya',
			'tk' => 'Turkmen',
			'tl' => 'Tagalog',
			'tn' => 'Tswana',
			'to' => 'Tonga',
			'tr' => 'Turkish',
			'ts' => 'Tsonga',
			'tt' => 'Tatar',
			'tw' => 'Twi',
			'ty' => 'Tahitian',
			'ug' => 'Uighur',
			'uk' => 'Urkainian',
			'ur' => 'Urdu',
			'uz' => 'Uzbek',
			've' => 'Venda',
			'vi' => 'Vietnamese',
			'vo' => 'Volapük',
			'wa' => 'Walloon',
			'wo' => 'Wolof',
			'xh' => 'Xhosa',
			'yi' => 'Yiddish',
			'yo' => 'Yoruba',
			'za' => 'Zhuang',
			'zh' => 'Chinese',
			'zh-hk' => 'Chinese (Hong-Kong)',
			'zh-tw' => 'Chinese (Taiwan)',
			'zu' => 'Zulu'
			);
		}
		
		if ($flip) {
			$res = array_flip(self::$langs);
			ksort($res);
			return $res;
		}
		
		return self::$langs;
	}
}
?>