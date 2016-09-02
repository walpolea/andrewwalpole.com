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

/**
@ingroup CB_DBLAYER
@brief SQLite Database Driver.

See the dbLayer documentation for common methods.
*/
class sqliteConnection extends dbLayer implements i_dbLayer
{
	protected $__driver = 'sqlite';
	
	public function db_connect($host,$user,$password,$database)
	{
		if (!function_exists('sqlite_open')) {
			throw new Exception('PHP SQLite functions are not available');
		}
		
		if (($link = @sqlite_open($database)) === false) {
			throw new Exception('Unable to connect to database');
		}
		
		$this->db_post_connect($link,$database);
		
		return $link;
	}
	
	public function db_pconnect($host,$user,$password,$database)
	{
		if (!function_exists('sqlite_popen')) {
			throw new Exception('PHP SQLite functions are not available');
		}
		
		if (($link = @sqlite_popen($database)) === false) {
			throw new Exception('Unable to connect to database');
		}
		
		$this->db_post_connect($link,$database);
		
		return $link;
	}
	
	private function db_post_connect($link,$database)
	{
		$this->db_exec($link,'PRAGMA short_column_names = 1');
		sqlite_create_function($link,'now',array($this,'now'),0);
	}
	
	public function db_close($handle)
	{
		if (is_resource($handle)) {
			sqlite_close($handle);
		}
	}
	
	public function db_version($handle)
	{
		return sqlite_libversion();
	}
	
	public function db_query($handle,$query)
	{
		if (is_resource($handle))
		{
			$res = @sqlite_query($query,$handle);
			if ($res === false) {
				$e = new Exception($this->db_last_error($handle));
				$e->sql = $query;
				throw $e;
			}
			return $res;
		}
	}
	
	public function db_exec($handle,$query)
	{
		if (is_resource($handle))
		{
			$res = @sqlite_exec($query,$handle);
			if ($res === false) {
				$e = new Exception($this->db_last_error($handle));
				$e->sql = $query;
				throw $e;
			}
			return $res;
		}
	}
	
	public function db_num_fields($res)
	{
		if (is_resource($res)) {
			return sqlite_num_fields($res);
		}
		return 0;
	}
	
	public function db_num_rows($res)
	{
		if (is_resource($res)) {
			return sqlite_num_rows($res);
		}
		return 0;
	}
	
	public function db_field_name($res,$position)
	{
		if (is_resource($res)) {
			return sqlite_field_name($res,$position);
		}
	}
	
	public function db_field_type($res,$position)
	{
		return 'varchar';
	}
	
	public function db_fetch_assoc($res)
	{
		if (is_resource($res)) {
			return sqlite_fetch_array($res,SQLITE_ASSOC);
		}
	}
	
	public function db_result_seek($res,$row)
	{
		if (is_resource($res)) {
			return sqlite_seek($res,$row);
		}
	}
	
	public function db_changes($handle,$res)
	{
		if (is_resource($handle)) {
			return sqlite_changes($handle);
		}
	}
	
	public function db_last_error($handle)
	{
		if (is_resource($handle))
		{
			$e = sqlite_last_error($handle);
			if ($e) {
				return sqlite_error_string($e).' ('.$e.')';
			}
		}
		return false;
	}
	
	public function db_escape_string($str,$handle=null)
	{
		return sqlite_escape_string($str);
	}
	
	public function vacuum($table)
	{
		$this->execute('VACUUM '.$this->escapeSystem($table));
	}
	
	public function dateFormat($field,$pattern)
	{
		return "strftime('".$this->escape($pattern)."',".$field.') ';
	}
	
	public function escapeSystem($str)
	{
		return "'".sqlite_escape_string($str)."'";
	}
	
	/// Internal SQLite function that adds NOW() SQL function.
	public function now()
	{
		return date('Y-m-d H:i:s');
	}
}
?>