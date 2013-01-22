<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'KeluargaKB';
  $conn->openMssqlConnection();
    
  $sql = 'UPDATE ' . $table . ' SET Tahun=' . $_REQUEST[ 'Tahun' ] . ', BulanId=' . $_REQUEST[ 'BulanId' ] . ', JenisKontrasepsiId=' . $_REQUEST[ 'JenisKontrasepsiId' ] . ', TempatPelayananKBId=' . $_REQUEST[ 'TempatPelayananKBId' ] . ' WHERE KeluargaId=' . $_REQUEST[ 'KeluargaId' ];
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
