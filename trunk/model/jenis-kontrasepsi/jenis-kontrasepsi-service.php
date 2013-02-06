<?php
  require_once 'lib/conn.inc.php';

  class JenisKontrasepsiService {

    private $conn = null;
    private $table = 'M_JenisKontrasepsi';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY JenisKontrasepsiId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'JenisKontrasepId' => $val[ 'JenisKontrasepsiId' ],
              'Jenis' => $val[ 'Jenis' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }    
  }  
  
?>
