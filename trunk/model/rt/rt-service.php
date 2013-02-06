<?php
  require_once 'lib/conn.inc.php';

  class RtService {

    private $conn = null;
    private $table = 'M_RT';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY RTId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'RTId' => $val[ 'RTId' ],
              'Nama' => $val[ 'Nama' ],
              'RWId' => $val[ 'RWId' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }       

    public function getRtByRw( $id ) {
      $sql = 'SELECT * FROM ' . $this->table . ' WHERE RWId=' . $id;  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'RTId' => $val[ 'RTId' ],
              'Nama' => $val[ 'Nama' ],
              'RWId' => $val[ 'RWId' ]
          );
        }
      }     
      
      mssql_free_result( $result ); 
      
      return $data;
    }
  }  
  
?>
