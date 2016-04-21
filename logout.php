<?php

	session_start();
	unset($_SESSION);
	session_destroy();
		
		echo "<script> alert('You have been logged out successfully');";
		echo "</script>";
		echo "<script>location.href='index.php'</script>";
		exit();

		
?>