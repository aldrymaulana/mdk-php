<?php
	session_start();

	require_once '../lib/conn.inc.php';
	require_once '../lib/custom.inc.php';
  include '../js/ofc/php-ofc-library/open-flash-chart.php';

  checkSession();

  $conn = new Conn();  
  $conn->openMssqlConnection();
  $table = 'v_Keluarga';

  // ambil data nama dan id rw dari variabel array yang telah dimasukkan
  // ke dalam session (pass value between page(s))
  $aRw = $_SESSION[ 'aRw' ];
  
  $sql = 'SELECT b.Nama AS RT, COUNT(a.ID) AS Jumlah, (SELECT COUNT(*)
    FROM ' . $table . ' WHERE RWID=' . $aRw[ $_REQUEST[ 'rwId' ] ][ 'id' ] . ') AS total
		FROM ' . $table . ' a INNER JOIN M_RT b ON a.RTID=b.RTId 
		WHERE a.RWID=' . $aRw[ $_REQUEST[ 'rwId' ] ][ 'id' ] . '
		GROUP BY a.RTID, b.Nama ORDER BY b.Nama, a.RTID';
  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $rt[] = 'RT ' . $val[ 'RT' ];
      $jumlah[] = $val[ 'Jumlah' ];
      $total = $val[ 'total' ];
      $tempJumlah = $val[ 'Jumlah' ];
      $maxJumlah = ( $maxJumlah > $tempJumlah ) ? $maxJumlah : $tempJumlah;
    }
  }	
	
	$max = 0;
	
	$title = new title( 'Jumlah Data Peserta KB Per RT, RW ' . $aRw[ $_REQUEST[ 'rwId' ] ][ 'nama' ] . ' Total : ' . $total . ' ( ' . date("D M d Y") . ' ) ' );
	$title->set_style( '{font-size:15px; color: #bcd6ff; margin:0px; background-color: #5E83BF;}' );

	$bar = new bar_3d();
	$bar->set_values( $jumlah );	
	$bar->colour = '#9999FF';	
	$bar->set_on_show( new bar_on_show( 'grow-up', 1, 0 ) );

	$labels = new x_axis_labels();
	$labels->set_labels( $rt );

	$y_base = new y_axis_base();
	$y_base->set_range( 0, $maxJumlah + round( $maxJumlah / 2 ), round( $maxJumlah / 10 ) );

	$x = new x_axis();
	$x->set_labels( $labels );
	$x->set_3d( 5 );

	$y = new y_axis();
	$y->set_labels( $y_labels );

	$tags = new ofc_tags();
	$tags->font( 'Verdana', 10 )
		->colour( '#000000' )
		->align_x_center()
		->text( '#y#' );

	$i = 0;
	foreach( $jumlah as $j ) {
		$tags->append_tag( new ofc_tag( $i, $j ) );
		$i++;
	}

	$chart = new open_flash_chart();
	$chart->set_title( $title );
	$chart->add_element( $bar );
	$chart->add_element( $tags );
	$chart->set_x_axis( $x );
	$chart->set_y_axis( $y_base );
	                    
	echo $chart->toString();
?> 