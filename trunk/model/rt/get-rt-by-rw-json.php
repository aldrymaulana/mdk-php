<?php
  require '../../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_RT';
  $conn->openMssqlConnection();
  
  $sql = 'SELECT * FROM ' . $table . ' WHERE RWId=' . $_REQUEST[ 'id' ] . ' ORDER BY RTId';  
  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data[] = array(
          'RWId' => $val[ 'RWId' ],
          'Nama' => $val[ 'Nama' ],
          'RTId' => $val[ 'RTId' ]
      );
    }
  }

  mssql_free_result( $result );

  header( 'Content-type: application/json' );
  
  echo json_encode( $data );
?>