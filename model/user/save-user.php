<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'S_User';
  $conn->openMssqlConnection();
    
  $sql = 'INSERT INTO ' . $table . ' VALUES(\'' . $_REQUEST[ 'UserId' ] . '\',\'' . md5( $_REQUEST[ 'Pass' ] ) . '\',\'' . $_REQUEST[ 'Nama' ] . '\',' . $_REQUEST[ 'GroupId' ] . ')';
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
