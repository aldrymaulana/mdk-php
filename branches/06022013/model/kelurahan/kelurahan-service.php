<?php
  require_once 'lib/conn.inc.php';

  class KelurahanService {

    private $conn = null;
    private $table = 'M_Kelurahan';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY KelurahanId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'KecamatanId' => $val[ 'KecamatanId' ],
              'Nama' => $val[ 'Nama' ],
              'KodeDedagri' => $val[ 'KodeDepdagri' ],
              'KelurahanId' => $val[ 'KelurahanId' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }       

    public function getKelurahanById( $id ) {
      $sql = 'SELECT * FROM ' . $this->table . ' WHERE KelurahanId=' . $id;  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'KecamatanId' => $val[ 'KecamatanId' ],
              'Nama' => $val[ 'Nama' ],
              'KodeDedagri' => $val[ 'KodeDepdagri' ],
              'KelurahanId' => $val[ 'KelurahanId' ]
          );
        }
      }     
      
      mssql_free_result( $result ); 
      
      return $data;
    }
  }  
  
?>
