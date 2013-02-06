<?php
  require '../../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_TempatPelayananKB';
  $conn->openMssqlConnection();
  
  $sql = 'SELECT Nama FROM ' . $table . ' WHERE TempatPelayananKBId=' . $_REQUEST[ 'TempatPelayananId' ];
  $result = mssql_query( $sql );  
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data = array(
          'Nama' => $val[ 'Nama' ]
      );
    }
  }

  mssql_free_result( $result );

  header( 'Content-type: application/json' );
  
  echo json_encode( $data );
?>