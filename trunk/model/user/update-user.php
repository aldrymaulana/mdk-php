<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'M_User';
  $conn->openMssqlConnection();
  
  if ( $_REQUEST[ 'password' ] ) {
    $sql = 'UPDATE ' . $table . ' SET username=\'' . $_REQUEST[ 'username' ] . '\', password=\'' . md5( $_REQUEST[ 'password' ] ) . '\' WHERE id=' . $_REQUEST[ 'id' ];
  } else {
    $sql = 'UPDATE ' . $table . ' SET username=\'' . $_REQUEST[ 'username' ] . '\' WHERE id=' . $_REQUEST[ 'id' ];
  }

  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
