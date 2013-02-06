<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'M_JenisKontrasepsi';
  $conn->openMssqlConnection();
    
  $sql = 'INSERT INTO ' . $table . ' VALUES(\'' . $_REQUEST[ 'Jenis' ] . '\')';
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
