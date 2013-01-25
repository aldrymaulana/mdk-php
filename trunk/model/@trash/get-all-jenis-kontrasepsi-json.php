<?php
  require '../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'M_JenisKontrasepsi';
  $conn->openMssqlConnection();
  
  $jenis = isset( $_REQUEST[ 'Jenis' ] ) ? $_REQUEST[ 'Jenis' ] : '';

  $where = '1=1 ';

  if ( $jenis ) {
    $where .= ' AND Jenis LIKE \'%' . $jenis . '%\'';
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
    $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $where . ' ORDER BY JenisKontrasepId ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';  
  } else {
    $sql = 'SELECT * FROM ' . $table . ' ORDER BY JenisKontrasepId ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';  
  }

  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {
      $data[] = array(
          'JenisKontrasepId' => $val[ 'JenisKontrasepId' ],
          'Jenis' => $val[ 'Jenis' ]
      );
    }
  }
  
  header( 'Content-type: application/json' );
  
  echo '{"rows":' . json_encode( $data ) . ', "total":' . $total[ 'total' ] . '}';  
?>
