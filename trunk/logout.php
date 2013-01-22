<?php
	session_start();
	session_destroy();

	echo '<script>window.location.replace("http://localhost/mdk-php/");</script>';
?>