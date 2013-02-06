<?php
  require '../../lib/conn.inc.php';  

  $conn = new Conn();
  $table = 'S_User';
  $conn->openMssqlConnection();
  
  $username = isset( $_REQUEST[ 'UserId' ] ) ? $_REQUEST[ 'UserId' ] : '';

  $where = '1=1 ';

  if ( $username ) {
    $where .= ' AND UserId LIKE \'%' . $username . '%\'';
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
    $sql = 'SELECT a.*, b.Nama AS NamaGroup FROM ' . $table . ' a INNER JOIN S_UserGroup b ON a.GroupId=b.GroupId WHERE ' . $where . ' ORDER BY a.UserId ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';  
  } else {
    $sql = 'SELECT a.*, b.Nama AS NamaGroup FROM ' . $table . ' a INNER JOIN S_UserGroup b ON a.GroupId=b.GroupId ORDER BY UserId ASC OFFSET(' . ( $page - 1 ) * $rows . ') ROWS FETCH NEXT ' . $rows . ' ROWS ONLY';  
  }

  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {
      $data[] = array(
          'id' => $val[ 'id' ],
          'UserId' => $val[ 'UserId' ],
          'Password' => $val[ 'Password' ],
          'Nama' => $val[ 'Nama' ],
          'GroupId' => $val[ 'GroupId' ],
          'NamaGroup' => $val[ 'NamaGroup' ]
      );
    }
  }
  
  header( 'Content-type: application/json' );
  
  echo '{"rows":' . json_encode( $data ) . ', "total":' . $total[ 'total' ] . '}';  
?>
