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

class mimeMessage
{
	protected $from_email = null;
	protected $from_name = null;
	protected $ctype_primary = null;
	protected $ctype_secondary = null;
	protected $ctype_parameters = array();
	protected $d_parameters = array();
	protected $disposition = null;
	protected $headers = array();
	protected $body = null;
	protected $parts = array();
	
	public function __construct($message)
	{
		list($header,$body) = $this->splitBodyHeader($message);
		$this->decode($header,$body);
	}
	
	public function getMainBody()
	{
		# Look for the main body part (text/plain or text/html)
		if ($this->body && $this->ctype_primary == 'text' && $this->ctype_secondary == 'plain') {
			return $this->body;
		}
		
		foreach ($this->parts as $part)
		{
			if (($body = $part->getBody()) !== null) {
				return $body;
			}
		}
		
		return null;
	}
	
	public function getBody()
	{
		return $this->body;
	}
	
	public function getHeaders()
	{
		return $this->headers;
	}
	
	public function getHeader($hdr,$only_last=false)
	{
		$hdr = strtolower($hdr);
		
		if (!isset($this->headers[$hdr])) {
			return null;
		}
		
		if ($only_last && is_array($this->headers[$hdr])) {
			$r = $this->headers[$hdr];
			return array_pop($r);
		}
		
		return $this->headers[$hdr];
	}
	
	public function getFrom()
	{
		return array($this->from_email,$this->from_name);
	}
	
	public function getAllFiles()
	{
		$parts = array();
		foreach ($this->parts as $part)
		{
			$body = $part->getBody();
			$filename = $part->getFileName();
			if ($body && $filename)
			{
				$parts[] = array(
					'filename' => $filename,
					'content' => $part->getBody()
				);
			}
			else
			{
				$parts = array_merge($parts,$part->getAllFiles());
			}
		}
		
		return $parts;
	}
	
	public function getFileName()
	{
		if (isset($this->ctype_parameters['name'])) {
			return $this->ctype_parameters['name'];
		}
		
		if (isset($this->d_parameters['filename'])) {
			return $this->d_parameters['filename'];
		}
		
		return null;
	}
	
	protected function decode($headers,$body,$default_ctype='text/plain')
	{
		$headers = $this->parseHeaders($headers);
		
		foreach ($headers as $v)
		{
			if (isset($this->headers[strtolower($v['name'])]) &&
			!is_array($this->headers[strtolower($v['name'])]))
			{
				$this->headers[strtolower($v['name'])] = array($this->headers[strtolower($v['name'])]);
				$this->headers[strtolower($v['name'])][] = $v['value'];
			}
			elseif (isset($this->headers[strtolower($v['name'])]))
			{
				$this->headers[strtolower($v['name'])][] = $v['value'];
			}
			else
			{
				$this->headers[strtolower($v['name'])] = $v['value'];
			}
		}
		
		foreach ($headers as $k => $v)
		{
			$headers[$k]['name'] = strtolower($headers[$k]['name']);
			switch ($headers[$k]['name'])
			{
				case 'from':
					list($this->from_name,$this->from_email) = $this->decodeSender($headers[$k]['value']);
					break;
				
				case 'content-type':
					$content_type = $this->parseHeaderValue($headers[$k]['value']);
					
					if (preg_match('/([0-9a-z+.-]+)\/([0-9a-z+.-]+)/i', $content_type['value'], $regs)) {
						$this->ctype_primary   = strtolower($regs[1]);
						$this->ctype_secondary = strtolower($regs[2]);
					}
					
					if (isset($content_type['other']))
					{
						while (list($p_name, $p_value) = each($content_type['other'])) {
							$this->ctype_parameters[$p_name] = $p_value;
						}
					}
					break;
				
				case 'content-disposition':
					$content_disposition = $this->parseHeaderValue($headers[$k]['value']);
					$this->disposition   = $content_disposition['value'];
					if (isset($content_disposition['other'])) {
						while (list($p_name, $p_value) = each($content_disposition['other'])) {
							$this->d_parameters[$p_name] = $p_value;
						}
					}
					break;
				
				case 'content-transfer-encoding':
					$content_transfer_encoding = $this->parseHeaderValue($headers[$k]['value']);
					break;
			}
		}
		
		if (isset($content_type))
		{
			switch (strtolower($content_type['value']))
			{
				case 'text/plain':
				case 'text/html':
					$encoding = isset($content_transfer_encoding) ? $content_transfer_encoding['value'] : '7bit';
					$charset = isset($this->ctype_parameters['charset']) ? $this->ctype_parameters['charset'] : null;
					$this->body = $this->decodeBody($body,$encoding);
					$this->body = text::cleanUTF8(@text::toUTF8($this->body,$charset));
					break;
				
				case 'multipart/parallel':
				case 'multipart/appledouble': // Appledouble mail
				case 'multipart/report': // RFC1892
				case 'multipart/signed': // PGP
				case 'multipart/digest':
				case 'multipart/alternative':
				case 'multipart/related':
				case 'multipart/mixed':
					if (!isset($content_type['other']['boundary'])) {
						throw new Exception('No boundary found');
					}
					
					$default_ctype = (strtolower($content_type['value']) === 'multipart/digest') ? 'message/rfc822' : 'text/plain';
					
					$parts = $this->boundarySplit($body,$content_type['other']['boundary']);
					for ($i = 0; $i < count($parts); $i++)
					{
						$this->parts[] = new self($parts[$i]);
					}
					break;
				
				case 'message/rfc822':
					$this->parts[] = new self($body);
					break;
				
				default:
					if(!isset($content_transfer_encoding['value'])) {
						$content_transfer_encoding['value'] = '7bit';
					}
					$this->body = $this->decodeBody($body, $content_transfer_encoding['value']);
					break;
			}
		}
		else
		{
			$ctype = explode('/', $default_ctype);
			$this->ctype_primary   = $ctype[0];
			$this->ctype_secondary = $ctype[1];
			$this->body = $this->decodeBody($body,'7bit');
			$this->body = text::cleanUTF8(@text::toUTF8($this->body));
		}
	}
	
	protected function splitBodyHeader($input)
	{
		if (preg_match('/^(.*?)\r?\n\r?\n(.*)/s', $input, $match)) {
			return array($match[1], $match[2]);
		} else { # No body found
			return array($input,'');
		}
	}
	
	protected function parseHeaders($input)
	{
		if (!$input) {
			return array();
		}
		
		# Unfold the input
		$input   = preg_replace("/\r?\n/", "\r\n", $input);
		$input   = preg_replace("/\r\n(\t| )+/", ' ', $input);
		$headers = explode("\r\n", trim($input));
		
		$res = array();
		
		# Remove first From line if exists
		if (strpos($headers[0],'From ') === 0) {
			array_shift($headers);
		}
		
		foreach ($headers as $value)
		{
			$hdr_name = substr($value, 0, $pos = strpos($value, ':'));
			
			$hdr_value = substr($value, $pos+1);
			
			if($hdr_value[0] == ' ') {
				$hdr_value = substr($hdr_value, 1);
			}
			
			$res[] = array(
				'name' => $hdr_name,
				'value' => $this->decodeHeader($hdr_value)
			);
		}
		
		return $res;
	}
	
	protected function parseHeaderValue($input)
	{

		if (($pos = strpos($input, ';')) !== false)
		{
			$return['value'] = trim(substr($input, 0, $pos));
			$input = trim(substr($input, $pos+1));
			
			if (strlen($input) > 0)
			{
				# This splits on a semi-colon, if there's no preceeding backslash
				# Now works with quoted values; had to glue the \; breaks in PHP
				# the regex is already bordering on incomprehensible
				$splitRegex = '/([^;\'"]*[\'"]([^\'"]*([^\'"]*)*)[\'"][^;\'"]*|([^;]+))(;|$)/';
				preg_match_all($splitRegex, $input, $matches);
				$parameters = array();
				for ($i=0; $i<count($matches[0]); $i++)
				{
					$param = $matches[0][$i];
					while (substr($param, -2) == '\;') {
						$param .= $matches[0][++$i];
					}
					$parameters[] = $param;
				}
				
				for ($i = 0; $i < count($parameters); $i++)
				{
					$param_name  = trim(substr($parameters[$i], 0, $pos = strpos($parameters[$i], '=')), "'\";\t\\ ");
					$param_value = trim(str_replace('\;', ';', substr($parameters[$i], $pos + 1)), "'\";\t\\ ");
					if ($param_value[0] == '"') {
						$param_value = substr($param_value, 1, -1);
					}
					
					if (preg_match('/\*$/',$param_name)) {
						$return['other'][strtolower(substr($param_name,0,-1))] = $this->parserHeaderSpecialValue($param_value);
					} else {
						$return['other'][strtolower($param_name)] = $param_value;
					}
				}
			}
		}
		else
		{
			$return['value'] = trim($input);
		}
		
		return $return;
	}
	
	protected function parserHeaderSpecialValue($value)
	{
		if (strpos($value,"''") === false) {
			return $value;
		}
		
		list($charset,$value) = explode("''",$value);
		return @text::toUTF8(rawurldecode($value),$charset);
	}
	
	protected function boundarySplit($input, $boundary)
	{
		$parts = array();
		
		$bs_possible = substr($boundary, 2, -2);
		$bs_check = '\"' . $bs_possible . '\"';
		
		if ($boundary == $bs_check) {
			$boundary = $bs_possible;
		}
		
		$tmp = explode('--' . $boundary, $input);
		
		for ($i = 1; $i < count($tmp) - 1; $i++) {
			$parts[] = $tmp[$i];
		}
		
		return $parts;
	}
	
	protected function decodeHeader($input)
	{
		# Remove white space between encoded-words
		$input = preg_replace('/(=\?[^?]+\?(q|b)\?[^?]*\?=)(\s)+=\?/i', '\1=?', $input);
		
		# Non encoded
		if (!preg_match('/(=\?([^?]+)\?(q|b)\?([^?]*)\?=)/i',$input)) {
			return @text::toUTF8($input);
		}
		
		# For each encoded-word...
		while (preg_match('/(=\?([^?]+)\?(q|b)\?([^?]*)\?=)/i', $input, $matches))
		{
			$encoded  = $matches[1];
			$charset  = $matches[2];
			$encoding = $matches[3];
			$text     = $matches[4];
			
			switch (strtolower($encoding))
			{
				case 'b':
					$text = base64_decode($text);
					break;
				
				case 'q':
					$text = str_replace('_', ' ', $text);
					preg_match_all('/=([a-f0-9]{2})/i', $text, $matches);
					foreach($matches[1] as $value) {
						$text = str_replace('='.$value, chr(hexdec($value)), $text);
					}
					break;
			}
			$text = @text::toUTF8($text,$charset);
			$input = str_replace($encoded, $text, $input);
		}
		
		return text::cleanUTF8($input);
	}
	
	protected function decodeSender($sender)
	{
		if (preg_match('/([\'|"])?(.*)(?(1)[\'|"])\s+<([\w\-=!#$%^*\'+\\.={}|?~]+@[\w\-=!#$%^*\'+\\.={}|?~]+[\w\-=!#$%^*\'+\\={}|?~])>/', $sender, $matches)) {
			# Match address in the form: Name <email@host>
			$result[0] = $matches[2];
			$result[1] = $matches[sizeof($matches) - 1];
		} elseif (preg_match('/([\w\-=!#$%^*\'+\\.={}|?~]+@[\w\-=!#$%^*\'+\\.={}|?~]+[\w\-=!#$%^*\'+\\={}|?~])\s+\((.*)\)/', $sender, $matches)) {
			# Match address in the form: email@host (Name)
			$result[0] = $matches[1];
			$result[1] = $matches[2];
		} else {
			# Only the email address present
			$result[0] = $sender;
			$result[1] = $sender;
		}
		
		$result[0] = str_replace("\"", "", $result[0]);
		$result[0] = str_replace("'", "", $result[0]);

		return $result;
	}
	
	protected function decodeBody($input, $encoding = '7bit')
	{
		switch (strtolower($encoding))
		{
			case '7bit':
				return $input;
				break;
			
			case 'quoted-printable':
				return $this->quotedPrintableDecode($input);
				break;
			
			case 'base64':
				return base64_decode($input);
				break;
			
			default:
				return $input;
		}
	}
	
	protected function quotedPrintableDecode($input)
	{
		// Remove soft line breaks
		$input = preg_replace("/=\r?\n/", '', $input);
		
		// Replace encoded characters
		$input = preg_replace_callback('/=([a-f0-9]{2})/i',array($this,'quotedPrintableDecodeHandler'),$input);
		
		return $input;
	}
	
	protected function quotedPrintableDecodeHandler($m)
	{
		return chr(hexdec($m[1]));
	}
}
?>