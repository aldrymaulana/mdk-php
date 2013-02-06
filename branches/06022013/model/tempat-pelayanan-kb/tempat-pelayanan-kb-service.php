<?php
  require_once 'lib/conn.inc.php';

  class TempatPelayananKbService {

    private $conn = null;
    private $table = 'M_TempatPelayananKB';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY TempatPelayananKBId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'TempatPelayananKBId' => $val[ 'TempatPelayananKBId' ],
              'Nama' => $val[ 'Nama' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }    
  }  
  
?>
