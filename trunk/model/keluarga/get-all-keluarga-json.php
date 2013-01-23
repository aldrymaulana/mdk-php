<?php
  require '../../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'v_Keluarga';
  $conn->openMssqlConnection();
  
  $noKKI = isset( $_REQUEST[ 'NoKKI' ] ) ? $_REQUEST[ 'NoKKI' ] : '';
  $namaKK = isset( $_REQUEST[ 'NamaKK' ] ) ? $_REQUEST[ 'NamaKK' ] : '';
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

  if ( $_REQUEST[ 'search' ] ) {
    $sql = 'SELECT COUNT(*) AS total FROM ' . $table . ' WHERE ' . $where;
  } else {
    $sql = 'SELECT COUNT(*) AS total FROM ' . $table;
  }

  $result = mssql_query( $sql );
  $total = mssql_fetch_assoc( $result );

  $page = isset( $_REQUEST[ 'page' ] ) ? intval( $_REQUEST[ 'page' ] ) : 0;
  $rows = isset( $_REQUEST[ 'rows' ] ) ? intval( $_REQUEST[ 'rows' ] ) : 10;

  if ( $_REQUEST[ 'search' ] ) {
    $sql = 'SELECT *, (SELECT Nama FROM M_Kecamatan WHERE KecamatanId=a.KecamatanID) AS Kecamatan, (SELECT Nama FROM M_Kelurahan WHERE KelurahanId=a.KelurahanID) AS Kelurahan, (SELECT Nama FROM M_RW WHERE RWId=a.RWID) AS RW, (SELECT Nama FROM M_RT WHERE RTId=a.RTID) AS RT FROM ' . $table . ' a WHERE ' . $where . ' ORDER BY ID ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';
  } else {
    $sql = 'SELECT *, (SELECT Nama FROM M_Kecamatan WHERE KecamatanId=a.KecamatanID) AS Kecamatan, (SELECT Nama FROM M_Kelurahan WHERE KelurahanId=a.KelurahanID) AS Kelurahan, (SELECT Nama FROM M_RW WHERE RWId=a.RWID) AS RW, (SELECT Nama FROM M_RT WHERE RTId=a.RTID) AS RT FROM ' . $table . ' a ORDER BY ID ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';
  }

  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {
      $data[] = array(
          'KeluargaId' => $val[ 'ID' ],
          'NoKKI' => $val[ 'NoKKI' ],
          'KepalaKeluarga' => $val[ 'KepalaKeluarga' ],
          'NamaIstri' => $val[ 'NamaIstri' ],
          'PeriodeId' => $val[ 'PeriodeID' ],
          'IsToBeDeleted' => $val[ 'IsToBeDeleted' ],
          'ProvinsiId' => $val[ 'ProvinsiID' ],
          'KabupatenId' => $val[ 'KabupatenID' ],
          'KecamatanId' => $val[ 'KecamatanID' ],
          'Kecamatan' => $val[ 'Kecamatan' ],
          'Kelurahan' => $val[ 'Kelurahan' ],
          'RW' => $val[ 'RW' ],
          'RT' => $val[ 'RT' ],
          'KelurahanId' => $val[ 'KelurahanID' ],
          'RwId' => $val[ 'RWID' ],
          'RtId' => $val[ 'RTID' ]
      );
    }
  }
  
  header( 'Content-type: application/json' );
  
  echo '{"rows":' . json_encode( $data ) . ', "total":' . $total[ 'total' ] . '}';
?>
