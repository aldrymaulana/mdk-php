<?php
  session_start();
    
  require '../../lib/conn.inc.php';

  $conn = new Conn();
  $table = 'S_User';
  $conn->openMssqlConnection();
    
  $sql = 'SELECT *, c.Nama AS nama_kelurahan FROM ' . $table . ' a INNER JOIN S_Role b ON a.UserId=b.UserId INNER JOIN M_Kelurahan c ON b.KelurahanId=c.KelurahanId WHERE a.UserId=\'' . $_REQUEST[ 'username' ] . '\' AND Password=\'' . md5( $_REQUEST[ 'password' ] ) . '\'';
  $result = mssql_query( $sql );
  
  if ( mssql_num_rows( $result ) > 0 ) {
    while( $val = mssql_fetch_assoc( $result ) ) {
      $_SESSION[ 'username' ] = $val[ 'UserId' ];
      $_SESSION[ 'group_id' ] = $val[ 'GroupId' ];
      $_SESSION[ 'nama' ] = $val[ 'Nama' ];
      $_SESSION[ 'kelurahan_id' ] = $val[ 'KelurahanId' ];
      $_SESSION[ 'tahun' ] = $_REQUEST[ 'tahun' ];

      if ( $_SESSION[ 'group_id' ] == 1 ) {
        $_SESSION[ 'nama' ] = 'Administrator';  
      } else if ( $_SESSION[ 'group_id' ] == 2 ) {
        //$_SESSION[ 'nama' ] = 'Kecamatan' . $val[ 'nama_kecamatan' ];;  
      } else {
        $_SESSION[ 'nama' ] = 'Kelurahan ' . $val[ 'nama_kelurahan' ];
      }       
    }

    echo 'sukses';
  } else {
    echo 'gagal';
  }  

?>
