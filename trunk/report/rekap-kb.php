<?php
	$fname = "rptRekapKB.rptdesign";
  $tahun = $_REQUEST[ 'tahun' ];
  $bulan = $_REQUEST[ 'bulan' ];    
  $kecamatanId = $_REQUEST[ 'kecamatan_id' ];
  $kelurahanId = $_REQUEST[ 'kelurahan_id' ];
  $rtId = $_REQUEST[ 'rt_id' ];
  $rwId = $_REQUEST[ 'rw_id' ];  
  $kki = $_REQUEST[ 'kki' ];
  
  $dest = "http://10.3.23.90:8080/birt-viewer/frameset?__report=";
  $dest .= urlencode( $fname );
  $dest .= "&__format=pdf&__svg=false&__designer=true&__masterpage=true&__rtl=false&__cubememsize=10";
  $dest .= "&tahun=" . urlencode( $tahun ) . "&rt_id=" . urlencode( $rtId ) . "&rw_id=" . urlencode( $rwId ) . "&kelurahan_id=" . urlencode( $kelurahanId ) . "&kecamatan_id=" . urlencode( $kecamatanId ) . "&bulan=" . urlencode( $bulan );
  
  header("Location: $dest" );
?>