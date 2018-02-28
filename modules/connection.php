<?php
class connection{
    var $_dbh = '';
    var $_sql = '';
    var $_cursor = NULL;        
    
    public function connection() {
        try
        {
            $this->_dbh = new PDO('mysql:host=localhost;dbname='.dbName,dbUser,dbPass);
            $this->_dbh->query('set names "utf8"');
            $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
       catch(PDOException $e)
       {exit("Can't connection to database");}
    }
    
    public function setQuery($sql) {
        $this->_sql = $sql;
    }
    
    //Function execute the query 
    public function execute($options=array()) {
        try{
			$this->_cursor = $this->_dbh->prepare($this->_sql);
			
			$this->_cursor->execute($options);
			return $this->_cursor;
            
            }
        catch(PDOException $e){ return false;}
    }
    
    //Funtion load datas on table
    public function loadAllRows($options=array()) {
        if(!$options) {
            if(!$result = $this->execute())
                return false;
        }
        else {
            if(!$result = $this->execute($options))
                return false;
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
    
    //Funtion load 1 data on the table
    public function loadRow($option=array()) {
        if(!$option) {
            if(!$result = $this->execute())
                return false;
        }
        else {
            if(!$result = $this->execute($option))
                return false;
        }
        return $result->fetch(PDO::FETCH_OBJ);
    }
    
    //Function count the record on the table
    public function loadRecord($option=array()) {
        if(!$option) {
            if(!$result = $this->execute())
                return false;
        }
        else {
            if(!$result = $this->execute($option))
                return false;
        }
        return $result->fetch(PDO::FETCH_COLUMN);
    }
    
    public function getLastId() {
        return $this->_dbh->lastInsertId();
    }
	
    public function tong_so_dong($option=array())
	{
		if(!$option) {
            if(!$result = $this->execute())
                return false;
        }
        else {
            if(!$result = $this->execute($option))
                return false;
        }
		return $this->_cursor->rowCount();
	}
	
    public function disconnect() {
        $this->_dbh = NULL;
    }
}
?>