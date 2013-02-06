<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'KeluargaKB';
  $conn->openMssqlConnection();
    
  // cek data apakah sudah ada?
  $sql = 'UPDATE ' . $table . ' SET JenisKontrasepsiId=' . $_REQUEST[ 'JenisKontrasepsiId' ] . ', TempatPelayananKBId=' . $_REQUEST[ 'TempatPelayananKBId' ] . ', TingkatKesejahteraanId=' . $_REQUEST[ 'TingkatKesejahteraanId' ] . ', AlasanTidakKBId=' . $_REQUEST[ 'AlasanTidakKBId' ] . ', TglKB=\'' . date( 'Y-m-d', strtotime( $_REQUEST[ 'TglKB' ] ) ) . '\' WHERE KeluargaId=' . $_REQUEST[ 'KeluargaId' ] . ' AND BulanId=' . $_REQUEST[ 'BulanId' ] . ' AND Tahun=' . $_REQUEST[ 'Tahun' ];
  $result = mssql_query( $sql );
  
  if ( $result ) {
    echo 'sukses';
  } else {
    echo 'gagal';
  }    
  
?>
