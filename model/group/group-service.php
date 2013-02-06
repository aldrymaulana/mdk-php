<?php
  require_once 'lib/conn.inc.php';

  class GroupService {

    private $conn = null;
    private $table = 'S_UserGroup';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY GroupId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'GroupId' => $val[ 'GroupId' ],
              'Nama' => $val[ 'Nama' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }       

    public function getNamaById( $id ) {
      $sql = 'SELECT * FROM ' . $this->table . ' WHERE GroupId=' . $id;
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'GroupId' => $val[ 'GroupId' ],
              'Nama' => $val[ 'Nama' ]
          );
        }
      }     
      
      mssql_free_result( $result ); 
      
      return $data;
    }
  }  
  
?>
