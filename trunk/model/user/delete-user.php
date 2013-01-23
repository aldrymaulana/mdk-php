<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'M_User';
  $conn->openMssqlConnection();
    
  $sql = 'DELETE FROM ' . $table . ' WHERE id=' . $_REQUEST[ 'id' ];
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
