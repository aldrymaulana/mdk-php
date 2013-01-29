<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'S_User';
  $conn->openMssqlConnection();
    
  $sql = 'DELETE FROM ' . $table . ' WHERE UserId=\'' . $_REQUEST[ 'UserId' ] . '\'';
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
