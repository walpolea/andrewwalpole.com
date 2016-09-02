<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of Clearbricks.
# Copyright (c) 2007 Olivier Meunier and contributors. All rights
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

class sqliteSchema extends dbSchema implements i_dbSchema
{
	private $table_hist = array();
	
	private $table_stack = array();
	private $x_stack = array();
	
	public function dbt2udt($type,&$len,&$default)
	{
		$type = parent::dbt2udt($type,$len,$default);
		
		return $type;
	}
	
	public function udt2dbt($type,&$len,&$default)
	{
		$type = parent::udt2dbt($type,$len,$default);
		
		switch ($type)
		{
			case 'smallint':
			case 'bigint':
				return 'integer';
			case 'real':
				return 'float';
			case 'date':
			case 'time':
				return 'timestamp';
			case 'timestamp':
				if ($default == 'now()') {
					# SQLite does not support now() default value...
					$default = "'1970-01-01 00:00:00'";
				}
				return $type;
		}
		
		return $type;
	}
	
	public function flushStack()
	{
		# Vilain hack of #@! SQLite that doesn't support
		# ALTER ... ADD CONSTRAINT on tables
		foreach ($this->table_stack as $table => $def)
		{
			$sql = 'CREATE TABLE '.$table." (\n".implode(",\n",$def)."\n)\n ";
			$this->con->execute($sql);
		}
		
		foreach ($this->x_stack as $x)
		{
			$this->con->execute($x);
		}
	}
	
	public function db_get_tables()
	{
		$res = array();
		$sql = "
		Select * from
		( select 'main' as TABLE_CATALOG , 'sqlite' as TABLE_SCHEMA ,
		tbl_name as TABLE_NAME , case when type = 'table'
		then 'BASE TABLE' when type = 'view' then 'VIEW'
		end as TABLE_TYPE, sql as TABLE_SOURCE from sqlite_master
		where type in('table','view')
		and tbl_name not like 'INFORMATION_SCHEMA_%'
		union select 'main' as TABLE_CATALOG , 'sqlite' as TABLE_SCHEMA,
		tbl_name as TABLE_NAME , case when type = 'table'
		then 'TEMPORARY TABLE' when type = 'view'
		then 'TEMPORARY VIEW' end as TABLE_TYPE, sql as
		TABLE_SOURCE from sqlite_temp_master where type in('table','view')
		and tbl_name not like 'INFORMATION_SCHEMA_%' )
		BT order by TABLE_TYPE , TABLE_NAME
		";
		
		$rs = $this->con->select($sql);
		
		$res = array();
		while ($rs->fetch()) {
			$res[] = $rs->TABLE_NAME;
		}
		
		return $res;
	}
	
	public function db_get_columns($table)
	{
		# We may need to do it one day
		return array();
	}
	
	public function db_get_keys($table)
	{
		# Don't need this with SQLite
		return array();
	}
	
	public function db_get_indexes($table)
	{
		# Don't need this with SQLite
		return array();
	}
	
	public function db_get_references($table)
	{
		# Don't need this with SQLite
		return array();
	}
	
	public function db_create_table($name,$fields)
	{
		$a = array();
		
		foreach ($fields as $n => $f)
		{
			$type = $f['type'];
			$len = (integer) $f['len'];
			$default = $f['default'];
			$null = $f['null'];
			
			$type = $this->udt2dbt($type,$len,$default);
			$len = $len > 0 ? '('.$len.')' : '';
			$null = $null ? 'NULL' : 'NOT NULL';
			
			if ($default === null) {
				$default = 'DEFAULT NULL';
			} elseif ($default !== false) {
				$default = 'DEFAULT '.$default.' ';
			} else {
				$default = '';
			}
			
			$a[] = $n.' '.$type.$len.' '.$null.' '.$default;
		}
		
		$this->table_stack[$name][] = implode(",\n",$a);
		$this->table_hist[$name] = $fields;
	}
	
	public function db_create_field($table,$name,$type,$len,$null,$default)
	{
		# Don't need this with SQLite
	}
	
	public function db_create_primary($table,$name,$cols)
	{
		$this->table_stack[$table][] = 'CONSTRAINT '.$name.' PRIMARY KEY ('.implode(',',$cols).') ';
	}
	
	public function db_create_unique($table,$name,$cols)
	{
		$this->table_stack[$table][] = 'CONSTRAINT '.$name.' UNIQUE ('.implode(',',$cols).') ';
	}
	
	public function db_create_index($table,$name,$type,$cols)
	{
		$this->x_stack[] = 'CREATE INDEX '.$name.' ON '.$table.' ('.implode(',',$cols).') ';
	}
	
	public function db_create_reference($name,$c_table,$c_cols,$p_table,$p_cols,$update,$delete)
	{
		if (!isset($this->table_hist[$c_table])) {
			return;
		}
		
		if (count($c_cols) > 1 || count($p_cols) > 1) {
			throw new Exception('SQLite UDBS does not support multiple columns foreign keys');
		}
		
		$c_col = $c_cols[0];
		$p_col = $p_cols[0];
		
		$update = strtolower($update);
		$delete = strtolower($delete);
		
		$cnull = $this->table_hist[$c_table][$c_col]['null'];
		
		# Create constraint
		$this->x_stack[] =
		'CREATE TRIGGER bir_'.$name."\n".
		'BEFORE INSERT ON '.$c_table."\n".
		"FOR EACH ROW BEGIN\n".
		'  SELECT RAISE(ROLLBACK,\'insert on table "'.$c_table.'" violates foreign key constraint "'.$name.'"\')'."\n".
		'  WHERE '.
		($cnull ? 'NEW.'.$c_col." IS NOT NULL\n  AND " : '').
		'(SELECT '.$p_col.' FROM '.$p_table.' WHERE '.$p_col.' = NEW.'.$c_col.") IS NULL;\n".
		"END;\n";
		
		# Update constraint
		$this->x_stack[] =
		'CREATE TRIGGER bur_'.$name."\n".
		'BEFORE UPDATE ON '.$c_table."\n".
		"FOR EACH ROW BEGIN\n".
		'  SELECT RAISE(ROLLBACK,\'update on table "'.$c_table.'" violates foreign key constraint "'.$name.'"\')'."\n".
		'  WHERE '.
		($cnull ? 'NEW.'.$c_col." IS NOT NULL\n  AND " : '').
		'(SELECT '.$p_col.' FROM '.$p_table.' WHERE '.$p_col.' = NEW.'.$c_col.") IS NULL;\n".
		"END;\n";
		
		# ON UPDATE
		if ($update == 'cascade')
		{
			$this->x_stack[] =
			'CREATE TRIGGER aur_'.$name."\n".
			'AFTER UPDATE ON '.$p_table."\n".
			"FOR EACH ROW BEGIN\n".
			'  UPDATE '.$c_table.' SET '.$c_col.' = NEW.'.$p_col.' WHERE '.$c_col.' = OLD.'.$p_col.";\n".
			"END;\n";
		}
		elseif ($update == 'set null')
		{
			$this->x_stack[] =
			'CREATE TRIGGER aur_'.$name."\n".
			'AFTER UPDATE ON '.$p_table."\n".
			"FOR EACH ROW BEGIN\n".
			'  UPDATE '.$c_table.' SET '.$c_col.' = NULL WHERE '.$c_col.' = OLD.'.$p_col.";\n".
			"END;\n";
		}
		else # default on restrict
		{
			$this->x_stack[] =
			'CREATE TRIGGER bur_'.$name."\n".
			'BEFORE UPDATE ON '.$p_table."\n".
			"FOR EACH ROW BEGIN\n".
			'  SELECT RAISE (ROLLBACK,\'update on table "'.$p_table.'" violates foreign key constraint "'.$name.'"\')'."\n".
			'  WHERE (SELECT '.$c_col.' FROM '.$c_table.' WHERE '.$c_col.' = OLD.'.$p_col.") IS NOT NULL;\n".
			"END;\n";
		}
		
		# ON DELETE
		if ($delete == 'cascade')
		{
			$this->x_stack[] =
			'CREATE TRIGGER bdr_'.$name."\n".
			'BEFORE DELETE ON '.$p_table."\n".
			"FOR EACH ROW BEGIN\n".
			'  DELETE FROM '.$c_table.' WHERE '.$c_col.' = OLD.'.$p_col.";\n".
			"END;\n";
		}
		elseif ($delete == 'set null')
		{
			$this->x_stack[] =
			'CREATE TRIGGER bdr_'.$name."\n".
			'BEFORE DELETE ON '.$p_table."\n".
			"FOR EACH ROW BEGIN\n".
			'  UPDATE '.$c_table.' SET '.$c_col .' = NULL WHERE '.$c_col.' = OLD.'.$p_col.";\n".
			"END;\n";
		}
		else
		{
			$this->x_stack[] =
			'CREATE TRIGGER bdr_'.$name."\n".
			'BEFORE DELETE ON '.$p_table."\n".
			"FOR EACH ROW BEGIN\n".
			'  SELECT RAISE (ROLLBACK,\'delete on table "'.$p_table.'" violates foreign key constraint "'.$name.'"\')'."\n".
			'  WHERE (SELECT '.$c_col.' FROM '.$c_table.' WHERE '.$c_col.' = OLD.'.$p_col.") IS NOT NULL;\n".
			"END;\n";
		}
	}
	
	public function db_alter_field($table,$name,$type,$len,$null,$default)
	{
		# Don't need this with SQLite
	}
	
	public function db_alter_primary($table,$name,$newname,$cols)
	{
		# Don't need this with SQLite
	}
	
	public function db_alter_unique($table,$name,$newname,$cols)
	{
		# Don't need this with SQLite
	}
	
	public function db_alter_index($table,$name,$newname,$type,$cols)
	{
		# Don't need this with SQLite
	}
	
	public function db_alter_reference($name,$newname,$c_table,$c_cols,$p_table,$p_cols,$update,$delete)
	{
		# Don't need this with SQLite
	}
}
?>