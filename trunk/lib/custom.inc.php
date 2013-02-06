<?php
  session_start();
  
  function checkSession() {
	  if ( !isset( $_SESSION[ 'username' ] ) || $_SESSION[ 'username' ] == '' ) {
	    echo '<script>window.location.replace("http://localhost/mdk-php/");</script>';
	  }
  }

  // change mssql datetime format to locale
  function parseDateTimeFormat( $dateTime, $delimiter ) {
  	if ( $dateTime == null || $dateTime == '' ) {
  		return null;
  	} else {
	  	$string = explode( $delimiter, $dateTime );
	  	$mm = $string[ 0 ];
	  	$dd = $string[ 1 ];
	  	$yy = $string[ 2 ];

	  	$dd = ( $dd < 10 ) ? '0' . $dd : $dd;
	  	
	  	switch ( $mm ) {
	  		case 'Jan' : {
	  			$mm = '01';
	  		} break;

	  		case 'Feb' : {
	  			$mm = '02';
	  		} break;

	  		case 'Mar' : {
	  			$mm = '03';
	  		} break;

	  		case 'Apr' : {
	  			$mm = '04';
	  		} break;

	  		case 'May' : {
	  			$mm = '05';
	  		} break;

	  		case 'Jun' : {
	  			$mm = '06';
	  		} break;

	  		case 'Jul' : {
	  			$mm = '07';
	  		} break;

	  		case 'Aug' : {
	  			$mm = '08';
	  		} break;

	  		case 'Sep' : {
	  			$mm = '09';
	  		} break;

	  		case 'Oct' : {
	  			$mm = '10';
	  		} break;

	  		case 'Nov' : {
	  			$mm = '11';
	  		} break;

	  		case 'Dec' : {
	  			$mm = '12';
	  		} break;
	  	}

	  	return $dd . '-' . $mm . '-' . $yy;	  	
	  }
  }
  
?>