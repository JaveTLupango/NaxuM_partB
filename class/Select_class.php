<?php

/**
 * 
 */
class SelectionClass
{
	
	function func_select($conn)
	{
		$sql = "SELECT * FROM users";
		$stmt = $conn->query($sql);
		return $stmt;
	}
}