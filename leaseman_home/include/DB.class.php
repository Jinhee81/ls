<?php 
class DB
{
	var $connect;    // DB Connect
	var $result;     // Query Result
	var $host;
	var $id;
	var $pass;
	var $schema;

	function DB($host = '', $id = '', $pass = '', $schema = '')
	{
		$this->host = $host; $this->schema = $schema;
		$this->id = $id; $this->pass = $pass; 
		
		$this->connect = mysql_connect($this->host, $this->id, $this->pass);
		if($this->connect == false){ $this->Error(); return false; }
		if(mysql_select_db($this->schema, $this->connect) == false){ $this->Error(); return false; }
		return $this->connect;
	}


	// SQL실행
	function Query($sql, $multi = false)
	{
		if(!$multi)
		{
			$this->result = mysql_query($sql) or die(mysql_error().'</br>'.$sql);
			if($this->result == false){ $this->Error(); return false; }
			return $this->result;
		}
		else
			mysql_unbuffered_query($sql);
	}
	
	function Select($table, $values='*', $where='1', $etc='')
	{
		$this->query('SELECT '.$values.' FROM '.$table.' WHERE '.$where.' '.$etc);
	}
	function Insert($table, $values=array(), $where=null, $except=array())
	{		
		if(empty($where)){ // INSERT
			if(is_array($values)){
				$fs = $vs = array();
				foreach($values as $k => $v )
				{
					$fs[] = '`'.$k.'`';
					if(is_array($except) && in_array($k, $except)) $vs[] = $v;
					else $vs[] = '"'.mysql_escape_string($v).'"';
				}
				$this->query('INSERT INTO '.$table.' ('.implode(',', $fs).') VALUES ( '.implode(',', $vs).' )');
			}else{
				$this->query('INSERT INTO '.$table.' VALUES ( '.$values.' )');
			}
		}else{ // UPDATE
			$s = array();
			foreach($values as $k => $v )
			{
				if(is_array($except) && in_array($k, $except)) $s[] = '`'.$k.'`'.'='.$v;
				else $s[] = '`'.$k.'`'.'="'.mysql_escape_string($v).'"';
			}
			$this->query('UPDATE  '.$table.' SET '.implode(',', $s).' WHERE '.$where);
		}
	}
	function Delete($table, $where='1', $etc='')
	{
		$this->query('DELETE FROM '.$table.' WHERE '.$where.' '.$etc);
	}

	// SQL실행종류
	function Fetch($how='assoc')
	{
		if($this->result == false)
		{
			$this->Error();
			return false;
		}
		switch($how)
		{
			case 'assoc':
				$returnVar = mysql_fetch_assoc($this->result);
				break;
			case 'row' :
				$returnVar = mysql_fetch_row($this->result);
				break;
			case 'array' :
				$returnVar = mysql_fetch_array($this->result);
				break;
			case 'object' :
				$returnVar = mysql_fetch_object($this->result);
				break;
			case 'result' :
				$returnVar = @mysql_result($this->result,0,0);
				break;
		}
		return $returnVar;
	}
	
	function FetchArray($idx = null, $how='assoc')
	{
		$ret = array();
		while($data = $this->Fetch($how)){
			if($idx == null)
				array_push($ret, $data);
			else
				$ret[$data[$idx]] = $data; 
		}
		return $ret;
	}
	
	function getFields($table)
	{
		$ret = array();
		$this->Query('DESC '.$table);
		while($data = $this->Fetch()) $ret[] = $data;
		return $ret;
	}
	
	function getTables()
	{
		$ret = array();
		$this->Query('SHOW TABLES FROM '.$this->schema);
		while($data = $this->Fetch('array'))
			$ret[] = $data['0'];
		return $ret;
	}
	
	function getLastSeq($table){
		$this->Query('SHOW TABLE STATUS LIKE "'.$table.'"');
		$data = $this->Fetch();
		return $data['Auto_increment'];
	}

	// Result Set에서 로우 개수
	function recordNum()
	{
		if($this->result == false)
		{
			$this->Error();
			return false;
		}
		$returnVar = @mysql_num_rows($this->result);
		return $returnVar;
	}

	// INSERT,UPDATE,DELETE 수행시 적용된 로우 개수
	function affectNum()
	{
		if($this->result == false)
		{
			$this->Error();
			return false;
		}
		$returnVar = mysql_affected_rows($this->result);
		return $returnVar;
	}

	// auto_increment로 실행된 최근 Primary Key
	function insertId()
	{
		return mysql_insert_id();
	}

	// Result Set을 메모리에서 삭제
	function Close()
	{
		@mysql_free_result ($this->result);
		@mysql_close($this->connect);
	}
	function Reconnect()
	{
		$this->Close();
		$this->DB($this->DataBase());
	}

	// Error Message 출력
	function Error()
	{
		$errorNo = mysql_errno();
		$errorMsg = mysql_error();
		$errorString = 'Error Code '.$errorNo.' : '.$errorMsg.' \n';
		echo $errorString;
		exit;
	}

	// db명 출력
	function DataBase()
	{
		return array('host'=>$this->host,'id'=>$this->id,'pass'=>$this->pass,'name'=>$this->schema);
	}
}
?>