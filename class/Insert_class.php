<?php

/**
 * 
 */
class InsertionClass 
{
	
	function func_Resgistration($conn, $name, $b_day, $address, $card, $profilePic)
	{
		try
		{  			
			$now = new DateTime();
			$dt = $now->format('Y-m-d H:i:s');
			$dt1 = $now->format('m-Y-d H:i:s');
			$dt2 = $now->format('d-m-Y H:i:s');
			$dttime = $now->format('Y-m-d H:i:s');
			$id = round($dt).round($dt1).round($dt2).round(microtime(true));			

			$sql = "INSERT INTO users (userid, name, bday, address, card, profilepic, tdt) VALUES ('$id', '$name', '$b_day', '$address', '$card', '$profilePic', '$dttime')";
			$conn->exec($sql);
			return "success";
		}
		catch (Exception $e)
		{			
			return "Failed to login " .$e->getMessage();
		}
	}

	function func_ValidateCard($conn, $card)
	{
		try
		{  
			$query = "SELECT * FROM users WHERE card = :card";  
		    $stmt = $conn->prepare($query);
		    $stmt->execute(
		    	array(  
                          'card'     =>    $card
                     ) );

		     $count = $stmt->rowCount();
		    return $count;
		}
		catch (Exception $e)
		{			
			return $e->getMessage();
		}
	}
}