<?php
  session_start();
    
  require '../../lib/conn.inc.php';

  $conn = new Conn();
  $table = 'M_User';
  $conn->openMssqlConnection();
    
  $sql = 'SELECT * FROM ' . $table . ' WHERE username=\'' . $_REQUEST[ 'username' ] . '\' AND password=\'' . md5( $_REQUEST[ 'password' ] ) . '\'';
  $result = mssql_query( $sql );
  
  if ( mssql_num_rows( $result ) > 0 ) {
    $_SESSION[ 'username' ] = $_REQUEST[ 'username' ];
    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
