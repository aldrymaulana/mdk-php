<?php
	session_start();

	require_once '../lib/conn.inc.php';
	require_once '../lib/custom.inc.php';
  include '../js/ofc/php-ofc-library/open-flash-chart.php';

  checkSession();

  $conn = new Conn();  
  $conn->openMssqlConnection();
  $table = 'v_Keluarga';
  
  $sql = 'SELECT b.Nama AS RW, b.RWId, COUNT(a.ID) AS Jumlah, (SELECT COUNT(*)
		FROM ' . $table . ' WHERE KelurahanId=' . $_SESSION[ 'kelurahan_id' ] . ') AS total
		FROM ' . $table . ' a INNER JOIN M_RW b ON a.RWID=b.RWId 
		WHERE a.KelurahanId=' . $_SESSION[ 'kelurahan_id' ] . '
		GROUP BY a.RWID, b.Nama, b.RWId ORDER BY a.RWID';
  $result = mssql_query( $sql );
  $data = array();

  unset( $_SESSION[ 'aRw' ] );

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $rw[] = 'RW ' . $val[ 'RW' ];
      $jumlah[] = $val[ 'Jumlah' ];
      $rwId[] = array( 'nama' => $val[ 'RW' ], 'id' => $val[ 'RWId' ] );
      $total = $val[ 'total' ];
      $tempJumlah = $val[ 'Jumlah' ];
      $maxJumlah = ( $maxJumlah > $tempJumlah ) ? $maxJumlah : $tempJumlah;
    }

    $_SESSION[ 'aRw' ] = $rwId;
  }	
	
	$max = 0;
	
	$title = new title( 'Jumlah Data Peserta KB Per RW, Total : ' . $total . ' ( ' . date("D M d Y") . ' ) ' );
	$title->set_style( '{font-size:20px; color: #bcd6ff; margin:0px; background-color: #5E83BF;}' );

	$bar = new bar_3d();
	$bar->set_values( $jumlah );	
	$bar->colour = '#9999FF';	
	$bar->set_on_show( new bar_on_show( 'grow-up', 1, 0 ) );
	$bar->set_on_click('getDetail');
	//$bar->set_on_click("http://10.3.23.90/mdk-php/");

	$labels = new x_axis_labels();
	$labels->set_labels( $rw );

	if ( count( $rw ) > 20 ) {
		$labels->set_size( 11 );
		$labels->rotate( 315 );
	}

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