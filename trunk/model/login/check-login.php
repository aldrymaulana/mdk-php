<?php
  session_start();
    
  require '../../lib/conn.inc.php';

  $conn = new Conn();
  $table = 'S_User';
  $conn->openMssqlConnection();
    
  $sql = 'SELECT * FROM ' . $table . ' a INNER JOIN S_Role b ON a.UserId=b.UserId WHERE a.UserId=\'' . $_REQUEST[ 'username' ] . '\' AND Password=\'' . md5( $_REQUEST[ 'password' ] ) . '\'';
  $result = mssql_query( $sql );
  
  if ( mssql_num_rows( $result ) > 0 ) {
    while( $val = mssql_fetch_assoc( $result ) ) {
      $_SESSION[ 'username' ] = $val[ 'UserId' ];
      $_SESSION[ 'group_id' ] = $val[ 'GroupId' ];
      $_SESSION[ 'nama' ] = $val[ 'Nama' ];
      $_SESSION[ 'kelurahan_id' ] = $val[ 'KelurahanId' ];
    }

    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
