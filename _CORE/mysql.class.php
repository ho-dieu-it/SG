<?php
/*	LEGO-PHP
	@author - Hoang Huy Phan
	@All rights reserved
	Support by	:	_
	Edited by	:	_
*/
//	Public function
class	lg_mysql
{
	var		$conn;
	var		$db_name;
	var		$count_query	=	0;
//	init
	public	function	__construct( $host , $db_user , $db_pass , $db_name)
	{
		$this->$db_name	=	$db_name;
	
		$this->conn	=	mysql_connect($host , $db_user, $db_pass)		or die("Can't connect");
		@mysql_set_charset('utf8',$this->conn);
		mysql_select_db($db_name , $this->conn)							or die("Can't select db");
	}
	public	function	__destruct()
	{
		@mysql_close( $this->conn );
	}
//	select - insert - update - delete
	public	function	query ( $query )
	{
		
		return	@mysql_query($query);
	}
	public	function	select ( $table , $where = "" , $clause = "" )
	{

		$this->count_query++;
		$sql	=	"SELECT * FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;	
		return	@mysql_query($sql , $this->conn);
	}
	public	function	insert	( $table , $feild , $values )
	{
		try{
		$this->count_query++;
		$sql	=	"INSERT INTO ".$table;
		if	( trim($feild) != "" )
			$sql	.=	" (".$feild.")";
		$sql	.=	" VALUES (".$values.");";
		@mysql_query($sql, $this->conn );
		return	mysql_insert_id($this->conn);
		}catch(Exception $e){
			throw $e;
		}
		
	}
	public	function	update	( $table , $feild , $value , $where )
	{
		$this->count_query++;
		$sql	=	"UPDATE $table SET $feild = '".$value."'";
		if	( trim($where) != "" )
			$sql	.=	" WHERE ".$where;
		return	@mysql_query($sql);
	}
	public	function	delete	( $table , $where = "" )
	{
		
		$this->count_query++;
		$sql	=	"DELETE FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		@mysql_query($sql , $this->conn) or die();
		$this->optimize($table);
	}
//	optimize
	public	function	optimize ( $table_name )
	{
		return	@mysql_query("OPTIMIZE $table_name", $this->conn);
	}
//	fetch
	public	function	fetch_array ( $rs )
	{
		return	@mysql_fetch_array( $rs );
	}
	public	function	fetch ( $rs )
	{
		return @mysql_fetch_array( $rs );
	}
	public	function	fetch_assoc ( $rs )
	{
		return @mysql_fetch_assoc( $rs );
	}
	public	function	fetch_object ( $rs )
	{
		return @mysql_fetch_object( $rs );
	}
//	Trả về - số records - của - 1 Result Set
	public	function	num_rows ( $rs )
	{
		return	mysql_num_rows( $rs );
	}
//	Hàm này - dùng để - chuyển - các ký tự - đặc biệt - sang - thể Escape - chống - Hack - SQL Injection
	public	function	inj_str	( $txt )
	{
		$txts=$this->escape($txt);
		return	mysql_real_escape_string($txts);
	}   
	public	function	escape ( $txt )
	{
		$txt_temp=stripslashes($txt);
		return	mysql_real_escape_string($txt_temp);
		//return 
	}
	public	function	error()
	{
		return mysql_error($this->conn);
	}
/* -----------------------------------------
        Các hàm áp dụng với 1 Tables        
----------------------------------------- */
	public	function	show_tables ()
	{
		return	mysql_query("SHOW TABLES",$this->conn);
	}
	public	function	show_create_table ( $table_name )
	{
		return	mysql_query("SHOW CREATE TABLE ".$table_name,$this->conn);
	}
	public	function	show_creation_table ( $table_name )
	{
		$row	=	mysql_fetch_array($this->show_create_table($table_name));
		return	$row["Create Table"];
	}
}
?>