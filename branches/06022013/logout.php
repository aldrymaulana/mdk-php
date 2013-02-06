<?php
	session_start();
	session_destroy();

	echo '<script>window.location.replace("http://10.3.23.90/mdk-php/");</script>';
?>