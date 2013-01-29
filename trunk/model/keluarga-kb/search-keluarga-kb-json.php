<?php
  require '../../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'v_KeluargaKB';
  $conn->openMssqlConnection();
    
  $noKKI = isset( $_REQUEST[ 'NoKKI' ] ) ? $_REQUEST[ 'NoKKI' ] : '';
  $namaKK = isset( $_REQUEST[ 'NamaKK' ] ) ? $_REQUEST[ 'NamaKK' ] : '';
  $bulan = isset( $_REQUEST[ 'Bulan' ] ) ? $_REQUEST[ 'Bulan' ] : '';
  $tahun = isset( $_REQUEST[ 'Tahun' ] ) ? $_REQUEST[ 'Tahun' ] : '';
  $kecamatan = isset( $_REQUEST[ 'Kecamatan' ] ) ? $_REQUEST[ 'Kecamatan' ] : '';
  $kelurahan = isset( $_REQUEST[ 'Kelurahan' ] ) ? $_REQUEST[ 'Kelurahan' ] : '';
  $rw = isset( $_REQUEST[ 'Rw' ] ) ? $_REQUEST[ 'Rw' ] : '';
  $rt = isset( $_REQUEST[ 'Rt' ] ) ? $_REQUEST[ 'Rt' ] : '';

  $where = '1=1 ';

  if ( $noKKI ) {
    $where .= 'AND NoKKI=\'' . $noKKI . '\'';
  }

  if ( $namaKK ) {
    $where .= 'AND KepalaKeluarga LIKE \'%' . $namaKK . '%\'';
  }

  if ( $bulan ) {
    $where .= 'AND BulanId=' . $bulan;
  }

  if ( $tahun ) {
    $where .= 'AND Tahun=' . $tahun;
  }

  if ( $kecamatan ) {
    $where .= 'AND KecamatanId=' . $kecamatan;
  }

  if ( $kelurahan ) {
    $where .= 'AND KelurahanId=' . $kelurahan;
  }

  if ( $rw ) {
    $where .= 'AND RWID=' . $rw;
  }

  if ( $rt ) {
    $where .= 'AND RTID=' . $rt;
  }

  $sql = 'SELECT COUNT(*) AS total FROM ' . $table . ' WHERE ' . $where;
  $result = mssql_query( $sql );
  $total = mssql_fetch_assoc( $result );

  $page = isset( $_REQUEST[ 'page' ] ) ? intval( $_REQUEST[ 'page' ] ) : 0;
  $rows = isset( $_REQUEST[ 'rows' ] ) ? intval( $_REQUEST[ 'rows' ] ) : 10;

  $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $where . 'ORDER BY KeluargaId ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';
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
          'NamaIstri' => $val[ 'NamaIstri' ],
          'Bulan' => $val[ 'Bulan' ],
          'NoKKI' => $val[ 'NoKKI' ],
          'JenisKontrasepsi' => $val[ 'JenisKontrasepsi' ],
          'TempatPelayanan' => $val[ 'TempatPelayanan' ]
      );
    }
  }
  
  header( 'Content-type: application/json' );
  
  echo '{"rows":' . json_encode( $data ) . ', "total":' . $total[ 'total' ] . '}';  
?>
