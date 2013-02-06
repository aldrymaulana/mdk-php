<?php
  
  function checkSession() {
	  if ( !isset( $_SESSION[ 'username' ] ) || $_SESSION[ 'username' ] == '' ) {
	    echo '<script>window.location.replace("http://localhost/mdk-php/");</script>';
	  }
  }

?>