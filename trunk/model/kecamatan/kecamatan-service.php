<?php
  require_once 'lib/conn.inc.php';  

  class KecamatanService {

    private $conn = null;
    private $table = 'M_Kecamatan';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY KecamatanId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'KecamatanId' => $val[ 'KecamatanId' ],
              'Nama' => $val[ 'Nama' ],
              'KodeDedagri' => $val[ 'KodeDepdagri' ]
          );
        }
      }     
      
      mssql_free_result( $result ); 

      return $data;
    }
  }  
  
?>
