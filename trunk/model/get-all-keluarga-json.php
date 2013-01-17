<?php
  require '../lib/conn.inc.php';  

  define( 'TABLE_NAME', 'v_Keluarga' );

  $conn = new Conn();
  $conn->openMssqlConnection();
  
  $sql = 'SELECT COUNT(*) AS total FROM ' . TABLE_NAME;
  $result = mssql_query( $sql );
  $total = mssql_fetch_assoc( $result );

  $page = isset( $_REQUEST[ 'page' ] ) ? intval( $_REQUEST[ 'page' ] ) : 1;
  $rows = isset( $_REQUEST[ 'rows' ] ) ? intval( $_REQUEST[ 'rows' ] ) : 10;

  $sql = 'SELECT * FROM ' . TABLE_NAME . ' ORDER BY ID ASC OFFSET(' . $page . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';  
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
          'KelurahanId' => $val[ 'KelurahanID' ],
          'RwId' => $val[ 'RWID' ],
          'RtId' => $val[ 'RTID' ]
      );
    }
  }
  
  header( 'Content-type: application/json' );
  
  echo '{"rows":' . json_encode( $data ) . ', "total":' . $total[ 'total' ] . '}';
?>
