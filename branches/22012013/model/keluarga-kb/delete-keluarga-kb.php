<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'KeluargaKB';
  $conn->openMssqlConnection();
    
  $sql = 'DELETE FROM ' . $table . ' WHERE Tahun=' . $_REQUEST[ 'Tahun' ] . ' AND BulanId=' . $_REQUEST[ 'BulanId' ] . ' AND KeluargaId=' . $_REQUEST[ 'KeluargaId' ];
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
