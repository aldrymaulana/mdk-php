<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'S_User';
  $conn->openMssqlConnection();
  
  if ( $_REQUEST[ 'Pass' ] ) {
    $sql = 'UPDATE ' . $table . ' SET Password=\'' . md5( $_REQUEST[ 'Pass' ] ) . '\', Nama=\'' . $_REQUEST[ 'Nama' ] . '\', GroupId=' . $_REQUEST[ 'GroupId' ] . ' WHERE UserId=' . $_REQUEST[ 'UserId' ];
  } else {
    $sql = 'UPDATE ' . $table . ' SET Nama=\'' . $_REQUEST[ 'Nama' ] . '\', GroupId=' . $_REQUEST[ 'GroupId' ] . ' WHERE UserId=' . $_REQUEST[ 'UserId' ];
  }

  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
