<?php

    require_once("../db/db.php");
	require_once("../functions/functions.php");
    $card_id = '';
    $add = '';
	
    if(isset($_GET['card_id'])){
        $card_id = (string)$_GET['card_id'];
		$card_id = strtoupper($card_id);
    }
	
	if(isset($_GET['add'])){
        $add = (string)$_GET['add'];  
    }

	$query = "SELECT * FROM new_cards;";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$new = $row['status'];
	
	if($new == 1){
		$query = "UPDATE new_cards SET `card_id` = ${card_id} WHERE id = 1;";
		$result = mysqli_query($connection, $query);
		echo "FECHADO";
	}
	
	if($new == 0){
		# check if card_id exists
		$check_q = "SELECT * FROM cards";
		$result = mysqli_query($connection, $check_q);
		
		$status = '';
			
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
			if($row['card_id'] == trim($card_id, "\"")):
				if($row['block'] == 1)
					$status = 'Bloqueado';
				if($row['active'] == 1)
					$status = 'active';
			endif;
		endwhile;
				
		if($status == 'Bloqueado'){
			echo "FECHADO";
			attendance($card_id, "Bloqueado", $connection);
		}
		else if($status == 'active'){
			echo "ABERTO";
			attendance($card_id, "open", $connection);
		}
		else{
			echo "FECHADO";
			attendance($card_id, "Bloqueado", $connection);
		}
	}
?>
