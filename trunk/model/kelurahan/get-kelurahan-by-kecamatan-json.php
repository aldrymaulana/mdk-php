<?php
  require '../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_Kelurahan';
  $conn->openMssqlConnection();
  
  $sql = 'SELECT * FROM ' . $table . ' WHERE KecamatanId=' . $_REQUEST[ 'id' ] . ' ORDER BY KelurahanId';  
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

  header( 'Content-type: application/json' );
  
  echo json_encode( $data );
?>