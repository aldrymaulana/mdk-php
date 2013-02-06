<?php
  require_once 'lib/conn.inc.php';

  class BarService {

    private $conn = null;
    private $table = null;

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getJmlMDKPerKelurahan() {
      $this->table = 'v_Keluarga';
      $sql = 'SELECT KelurahanID, COUNT(*) AS Jumlah FROM ' . $this->table . ' GROUP BY KelurahanID ORDER BY KelurahanID';
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $kelurahan[] = $val[ 'KelurahanID' ];
          $jumlah[] = $val[ 'Jumlah' ];

          $data[] = array( 'kelurahan' => $kelurahan, 'jumlah' => $jumlah );
        }
      }

      mssql_free_result( $result );

      return $data;
    } 

    public function getNamaBulanById( $id ) {
      $sql = 'SELECT Bulan FROM ' . $this->table . ' WHERE BulanId=' . $id;
      $result = mssql_query( $sql );
      
      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $namaBulan = $val[ 'Bulan' ];
        }
      }

      mssql_free_result( $result );

      return $bulan;
    }   
  }  
  
?>
