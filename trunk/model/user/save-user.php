<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'M_User';
  $conn->openMssqlConnection();
    
  $sql = 'INSERT INTO ' . $table . ' VALUES(\'' . $_REQUEST[ 'username' ] . '\',\'' . md5( $_REQUEST[ 'password' ] ) . '\')';
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
