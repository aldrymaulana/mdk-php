<?php
  require '../../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_Bulan';
  $conn->openMssqlConnection();
  
  $sql = 'SELECT Bulan FROM ' . $table . ' WHERE BulanId=' . $_REQUEST[ 'BulanId' ];
  $result = mssql_query( $sql );  
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data = array(
          'Bulan' => $val[ 'Bulan' ]
      );
    }
  }

  mssql_free_result( $result );

  header( 'Content-type: application/json' );
  
  echo json_encode( $data );
?>