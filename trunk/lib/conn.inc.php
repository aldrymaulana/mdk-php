<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conn
 *
 * @author hygsan
 */

define( 'DB_NAME', 'BPMPPKB_KB' );

class Conn {
  
  //private $conn;
  //private $db;
  
  public function openMysqlConnection() {
    $host = '10.3.23.93';
    $username = 'root';
    $password = '';
    
    $mysqli = new mysqli( $host, $username, $password, DB_NAME );
    
    if ( $mysqli->connect_error ) {
      die( 'Connection Error! (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error );
    }
    
    return $mysqli;
  }
  
  public function openMssqlConnection() {
    $host = 'BLEK-PC';
    $username = 'sa';
    $password = '********';
    
    $mssql = mssql_connect( $host, $username, $password );
    
    if ( !$mssql ) {
      die( 'Connection Error!' );
    } else {
      mssql_select_db( DB_NAME, $mssql ) or die( 'Database Error!' );
    }       
    
    return $mssql;
  }
  
  // oop style
  /*public function getConnection() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    
    $this->conn = mysql_connect( $host, $username, $password );
    if ( !$this->conn ) {
      die( 'Connection Error!' );
    }
    
    $this->db = mysql_select_db( DB_NAME, $this->conn );
    if ( !$this->db ) {
      die( 'Database Error!' );      
    }
    
    return $this->conn;
  }*/
  
}

?>
