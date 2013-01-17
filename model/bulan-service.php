<?php
  require_once 'lib/conn.inc.php';

  class BulanService {

    private $conn = null;
    private $table = 'M_Bulan';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY BulanId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'BulanId' => $val[ 'BulanId' ],
              'Bulan' => $val[ 'Bulan' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }    
  }  
  
?>
