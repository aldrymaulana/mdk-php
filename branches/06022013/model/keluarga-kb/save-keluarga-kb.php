<?php
  require '../../lib/conn.inc.php';    
  require '../../lib/custom.inc.php';    

  $conn = new Conn();
  $table = 'KeluargaKB';
  $conn->openMssqlConnection();
   
  // cek data apakah sudah ada?
  $sql = 'SELECT * FROM ' . $table . ' WHERE Tahun=' . $_REQUEST[ 'Tahun' ] . ' AND BulanId=' . $_REQUEST[ 'BulanId' ] . ' AND KeluargaId=' . $_REQUEST[ 'KeluargaId' ];
  $query = mssql_query( $sql );
  $rows = mssql_num_rows( $query );

  if ( $rows > 0 ) {
    echo 'ada';
  } else {
    if ( $_REQUEST[ 'IkutKb' ] == 'true' ) {
      $sql = 'INSERT INTO ' . $table . '(Tahun,BulanId,KeluargaId,JenisKontrasepsiId,TempatPelayananKBId,TglKB,TingkatKesejahteraanId) VALUES(' . $_REQUEST[ 'Tahun' ] . ',' . $_REQUEST[ 'BulanId' ] . ',' . $_REQUEST[ 'KeluargaId' ] . ',' . $_REQUEST[ 'JenisKontrasepsiId' ] . ',' . $_REQUEST[ 'TempatPelayananKBId' ] . ',\'' . date( 'Y-m-d', strtotime( $_REQUEST[ 'TglKB' ] ) ) . '\',' . $_REQUEST[ 'TingkatKesejahteraanId' ] . ')';
    } else {
      $sql = 'INSERT INTO ' . $table . '(Tahun,BulanId,KeluargaId,AlasanTidakKBId,TingkatKesejahteraanId) VALUES(' . $_REQUEST[ 'Tahun' ] . ',' . $_REQUEST[ 'BulanId' ] . ',' . $_REQUEST[ 'KeluargaId' ] . ',' . $_REQUEST[ 'AlasanTidakKBId' ] . ',' . $_REQUEST[ 'TingkatKesejahteraanId' ] . ')';
    }
    
    $result = mssql_query( $sql );
      
    if ( $result ) {
      echo 'sukses';
    } else {
      echo 'gagal';
    }
  }
  
?>
