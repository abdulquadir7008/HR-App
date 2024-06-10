<?php
	function checkIfTimedOut()
	{
		$current = time();// take the current time
		$diff = $current - $_SESSION['SESS_ADMIN_ID'];
		if($diff > $_SESSION['timeOut'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>