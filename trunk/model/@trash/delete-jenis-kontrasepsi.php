<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'M_JenisKontrasepsi';
  $conn->openMssqlConnection();
    
  $sql = 'DELETE FROM ' . $table . ' WHERE JenisKontrasepId=' . $_REQUEST[ 'JenisKontrasepId' ];
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
