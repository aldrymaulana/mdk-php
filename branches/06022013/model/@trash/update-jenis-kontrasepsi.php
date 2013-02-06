<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'M_JenisKontrasepsi';
  $conn->openMssqlConnection();
  
  if ( $_REQUEST[ 'Jenis' ] ) {
    $sql = 'UPDATE ' . $table . ' SET Jenis=\'' . $_REQUEST[ 'Jenis' ] . '\' WHERE JenisKontrasepId=' . $_REQUEST[ 'JenisKontrasepId' ];
  } else {
    $sql = 'UPDATE ' . $table . ' SET Jenis=\'' . $_REQUEST[ 'Jenis' ] . '\' WHERE JenisKontrasepId=' . $_REQUEST[ 'JenisKontrasepId' ];
  }

  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
