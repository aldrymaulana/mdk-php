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

  $where = '1=1';

  if ( $noKKI ) {
    $where .= ' AND a.NoKKI=\'' . $noKKI . '\'';
  }

  if ( $namaKK ) {
    $where .= ' AND a.KepalaKeluarga LIKE \'%' . $namaKK . '%\'';
  }
  
  if ( $kecamatan ) {
    $where .= ' AND a.KecamatanId=' . $kecamatan;
  }

  if ( $kelurahan ) {
    $where .= ' AND a.KelurahanId=' . $kelurahan;
  }

  if ( $rw ) {
    $where .= ' AND a.RWID=' . $rw;
  }

  if ( $rt ) {
    $where .= ' AND a.RTID=' . $rt;
  }

  if ( $_REQUEST[ 'search' ] ) {
    $sql = 'SELECT COUNT(*) AS total FROM ' . $table . ' a WHERE ' . $where;
  } else {
    $sql = 'SELECT COUNT(*) AS total FROM ' . $table . ' a';
  }

  $result = mssql_query( $sql );
  $total = mssql_fetch_assoc( $result );

  $page = isset( $_REQUEST[ 'page' ] ) ? intval( $_REQUEST[ 'page' ] ) : 0;
  $rows = isset( $_REQUEST[ 'rows' ] ) ? intval( $_REQUEST[ 'rows' ] ) : 10;

  if ( $_REQUEST[ 'search' ] ) {
    $sql = 'SELECT a.*, b.Nama AS kecamatan, c.Nama AS kelurahan, d.Nama AS rw, e.Nama AS rw FROM ' . $table . ' a  inner join M_Kecamatan b on a.KecamatanID=b.KecamatanId
        inner join M_Kelurahan c on a.KelurahanID=c.KelurahanId
        inner join M_RW d on a.RWID=d.RWId
        inner join M_RT e on a.RTID=e.RTId  WHERE ' . $where . 'ORDER BY ID ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';
  } else {
    $sql = 'SELECT a.*, b.Nama AS kecamatan, c.Nama AS kelurahan, d.Nama AS rw, e.Nama AS rw FROM ' . $table . ' a inner join M_Kecamatan b on a.KecamatanID=b.KecamatanId
  inner join M_Kelurahan c on a.KelurahanID=c.KelurahanId
  inner join M_RW d on a.RWID=d.RWId
  inner join M_RT e on a.RTID=e.RTId ORDER BY ID ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';
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
