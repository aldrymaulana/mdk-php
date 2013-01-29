<?php
	require_once '../lib/conn.inc.php';
  include '../js/ofc/php-ofc-library/open-flash-chart.php';

  $conn = new Conn();  
  $conn->openMssqlConnection();
  $table = 'v_Keluarga';
  
  $sql = 'SELECT b.Nama AS Kecamatan, COUNT(a.ID) AS Jumlah, (SELECT COUNT(*)
                            FROM ' . $table . ') AS total FROM ' . $table . ' a INNER JOIN M_Kecamatan b ON a.KecamatanID=b.KecamatanId GROUP BY a.KecamatanID, b.Nama ORDER BY a.KecamatanID';
  $result = mssql_query( $sql );
  $data = array();

  if ( mssql_num_rows( $result ) > 0 ) {
    while ( $val = mssql_fetch_assoc( $result ) ) {      
      $kecamatan[] = $val[ 'Kecamatan' ];
      $jumlah[] = $val[ 'Jumlah' ];
      $total = $val[ 'total' ];
      $tempJumlah = $val[ 'Jumlah' ];
      $maxJumlah = ( $maxJumlah > $tempJumlah ) ? $maxJumlah : $tempJumlah;
    }
  }	
	
	$max = 0;
	
	$title = new title( 'Jumlah Data MDK Per Kecamatan, Total : ' . $total . ' ( ' . date("D M d Y") . ' ) ' );
	$title->set_style( '{font-size:20px; color: #bcd6ff; margin:0px; background-color: #5E83BF;}' );

	$bar = new bar_3d();
	$bar->set_values( $jumlah );	
	$bar->colour = '#9999FF';	
	$bar->set_on_show( new bar_on_show( 'grow-up', 1, 0 ) );

	$labels = new x_axis_labels();
	$labels->set_labels( $kecamatan );

	$y_base = new y_axis_base();
	$y_base->set_range( 0, $maxJumlah + 10000, round( $maxJumlah / 10 ) );

	$x = new x_axis();
	$x->set_labels( $labels );
	$x->set_3d( 5 );

	$y = new y_axis();
	$y->set_labels( $y_labels );

	$chart = new open_flash_chart();
	$chart->set_title( $title );
	$chart->add_element( $bar );
	$chart->set_x_axis( $x );
	$chart->set_y_axis( $y_base );
	                    
	echo $chart->toString();
?> 