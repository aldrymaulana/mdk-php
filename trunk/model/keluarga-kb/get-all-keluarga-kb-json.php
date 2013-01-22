<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'v_KeluargaKB';
  $conn->openMssqlConnection();
    
  $sql = 'SELECT COUNT(*) AS total FROM ' . $table;
  $result = mssql_query( $sql );
  $total = mssql_fetch_assoc( $result );

  $page = isset( $_REQUEST[ 'page' ] ) ? intval( $_REQUEST[ 'page' ] ) : 0;
  $rows = isset( $_REQUEST[ 'rows' ] ) ? intval( $_REQUEST[ 'rows' ] ) : 10;

  $sql = 'SELECT * FROM ' . $table . ' ORDER BY KeluargaId ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';
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
  
  echo '{"rows":' . json_encode( $data ) . ', "total":' . $total[ 'total' ] . '}';
?>
