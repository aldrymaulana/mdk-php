<?php
  require '../lib/conn.inc.php';  

  define( 'TABLE_NAME', 'v_KeluargaKB' );

  $conn = new Conn();
  $conn->openMssqlConnection();
    
  $sql = 'SELECT * FROM ' . TABLE_NAME . ' ORDER BY NoKKI ASC';  
  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data[] = array(
          'KeluargaId' => $val[ 'KeluargaId' ],
          'BulanId' => $val[ 'BulanId'],
          'Tahun' => $val[ 'Tahun' ],
          'JenisKontrasepsiId' => $val[ 'JenisKontrasepsiId' ],
          'TempatPelayananKBId' => $val[ 'TempatPelayananKBId' ],
          'KepalaKeluarga' => $val[ 'KepalaKeluarga' ],
          'Bulan' => $val[ 'Bulan' ],
          'NoKKI' => $val[ 'NoKKI' ],
          'JenisKontrasepsi' => $val[ 'JenisKontrasepsi' ],
          'TempatPelayanan' => $val[ 'TempatPelayanan' ]
      );
    }
  }
  
  header( 'Content-type: application/json' );
  
  echo '{"data":' . json_encode( $data ) . ', "total":' . $total . '}';
?>
