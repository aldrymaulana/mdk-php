<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'KeluargaKB';
  $conn->openMssqlConnection();
    
  $sql = 'INSERT INTO ' . $table . ' VALUES(' . $_REQUEST[ 'Tahun' ] . ',' . $_REQUEST[ 'BulanId' ] . ',' . $_REQUEST[ 'KeluargaId' ] . ',' . $_REQUEST[ 'JenisKontrasepsiId' ] . ',' . $_REQUEST[ 'TempatPelayananKBId' ] . ')';
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  
?>
