<?php
  require '../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_JenisKontrasepsi';
  $conn->openMssqlConnection();
  
  $sql = 'SELECT Jenis FROM ' . $table . ' WHERE JenisKontrasepId=' . $_REQUEST[ 'KontrasepId' ];
  $result = mssql_query( $sql );  
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data = array(
          'Jenis' => $val[ 'Jenis' ]
      );
    }
  }

  mssql_free_result( $result );

  header( 'Content-type: application/json' );
  
  echo json_encode( $data );
?>