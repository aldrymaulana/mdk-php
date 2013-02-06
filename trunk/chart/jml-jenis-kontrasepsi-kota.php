<?php
	session_start();

	require_once '../lib/conn.inc.php';
  include '../js/ofc/php-ofc-library/open-flash-chart.php';

  $conn = new Conn();  
  $conn->openMssqlConnection();
  $table = 'v_KeluargaKB';
  
  $sql = 'SELECT COUNT(a.KeluargaId) AS Jumlah, b.Jenis, (SELECT COUNT(*) FROM ' . $table . ') AS total FROM ' . $table . ' a
			LEFT JOIN M_JenisKontrasepsi b ON a.JenisKontrasepsiId=b.JenisKontrasepsiId 
			WHERE a.Tahun=' . $_SESSION[ 'tahun' ] . ' 
			GROUP BY a.JenisKontrasepsiId, b.Jenis
			ORDER BY a.JenisKontrasepsiId';

  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $jenis[] = $val[ 'Jenis' ];
      $jumlah[] = $val[ 'Jumlah' ];
      $total = $val[ 'total' ];
      $data[] = new pie_value( $val[ 'Jumlah' ], ( $val[ 'Jenis' ] == null ) ? 'Tidak KB' : $val[ 'Jenis' ] );
      //$tempJumlah = $val[ 'Jumlah' ];
      //$maxJumlah = ( $maxJumlah > $tempJumlah ) ? $maxJumlah : $tempJumlah;     
    }
  }
	
	$max = 0;
	
	$title = new title( 'Jumlah Pemakaian Alat Kontrasepsi Berdasarkan Jenis, Total : ' . $total . ' ( ' . date("D M d Y") . ' ) ' );
	$title->set_style( '{font-size:20px; color: #bcd6ff; margin:0px; background-color: #5E83BF;}' );

	$pie = new pie();
	$pie->alpha( 0.5 )
		->add_animation( new pie_fade() )
		->add_animation( new pie_bounce( 5 ) )
		->start_angle( 0 )
		->tooltip( '#val# dari #total#<br>#percent# dari 100%' )		
		->colours( array( '#d01f3c', '#356aa0', '#c79810', '#639bf7', '#ac77dea' ) );

	$pie->set_values( $data );

	/*$bar = new bar_3d();
	$bar->set_values( $jumlah );	
	$bar->colour = '#9999FF';	
	$bar->set_on_show( new bar_on_show( 'grow-up', 1, 0 ) );

	$labels = new x_axis_labels();
	$labels->set_labels( $jenis );

	$y_base = new y_axis_base();
	$y_base->set_range( 0, $maxJumlah + round( $maxJumlah / 2 ), round( $maxJumlah / 2 ) );

	$x = new x_axis();
	$x->set_labels( $labels );
	$x->set_3d( 5 );

	$y = new y_axis();
	$y->set_labels( $y_labels );*/

	$chart = new open_flash_chart();
	$chart->set_title( $title );
	$chart->add_element( $pie );
	//$chart->set_bg_colour( '#202020' );
	//$chart->set_x_axis( $x );
	//$chart->set_y_axis( $y_base );
	                    
	echo $chart->toPrettyString();
?> 