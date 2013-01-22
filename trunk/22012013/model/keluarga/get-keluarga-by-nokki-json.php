<?php
  require '../lib/conn.inc.php';    

  $conn = new Conn();
  $table = 'v_Keluarga';
  $conn->openMssqlConnection();
    
  $sql = 'SELECT * FROM ' . $table . ' WHERE NoKKI=\'' . $_REQUEST[ 'NoKKI' ] . '\'';
  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $data = array(
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

  echo json_encode( $data );
?>
