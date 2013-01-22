<?php
  require '../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_RW';
  $conn->openMssqlConnection();
  
  $sql = 'SELECT * FROM ' . $table . ' WHERE KelurahanId=' . $_REQUEST[ 'id' ] . ' ORDER BY RWId';  
  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data[] = array(
          'RWId' => $val[ 'RWId' ],
          'Nama' => $val[ 'Nama' ],
          'KelurahanId' => $val[ 'KelurahanId' ]
      );
    }
  }

  mssql_free_result( $result );

  header( 'Content-type: application/json' );
  
  echo json_encode( $data );
?>