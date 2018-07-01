<?php
if(!$_POST){
	die(header('HTTP/1.1 500 Already Voted'));	
	exit;
}
	require '../dinamico/lib/db_evento.php';
	
	$user_vote_type = trim($_POST["vote"]);

	$unique_content_id = filter_var(trim($_POST["unique_id"]),FILTER_VALIDATE_INT);
	
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die(header('HTTP/1.1 500 Already Voted'));
    } 

	
	switch ($user_vote_type){			
		case 'up': 
			if (isset($_COOKIE["voted_up_".$unique_content_id]))
			{
				header('HTTP/1.1 500 Already Voted this Content!'); 
				exit(); 
			}
			$get_total_rows = DbGetVotes($unique_content_id);
			$vote_up 	= ($get_total_rows["vote_up"])?$get_total_rows["vote_up"]:0; 
			$vote_down 	= ($get_total_rows["vote_down"])?$get_total_rows["vote_down"]:0;
			
			if($get_total_rows)	{
				DbSetVoteUp($unique_content_id, (isset($_COOKIE["voted_down_".$unique_content_id])));

				if (isset($_COOKIE["voted_down_".$unique_content_id])){
					if($vote_down>0){
						$vote_down = $vote_down-1;
					}
					setcookie("voted_down_".$unique_content_id, 1, time()-7200); 
				}
			}else{
				DbInsertVote($unique_content_id,1,0);
			}
			
			setcookie("voted_up_".$unique_content_id, 1, time()+7200); 

			$vote_up =$vote_up +1;
			$send_response = array('vote_up'=>$vote_up, 'vote_down'=>$vote_down);
			echo json_encode($send_response);
			break;

		case 'down': 
			if (isset($_COOKIE["voted_down_".$unique_content_id])){
				header('HTTP/1.1 500 Already Voted this Content!');
				exit(); 
			}
			$get_total_rows = DbGetVotes($unique_content_id);
			
			$vote_up 	= ($get_total_rows["vote_up"])?$get_total_rows["vote_up"]:0; 
			$vote_down 	= ($get_total_rows["vote_down"])?$get_total_rows["vote_down"]:0;
			
			if($get_total_rows)
			{
				DbSetVoteDown($unique_content_id, (isset($_COOKIE["voted_up_".$unique_content_id])));
				if (isset($_COOKIE["voted_up_".$unique_content_id])){
					if($vote_up>0){
						$vote_up = $vote_up-1;
					}
					setcookie("voted_up_".$unique_content_id, 1, time()-7200); 
				}
			}else{
				DbInsertVote($unique_content_id,0,1);
			}
			setcookie("voted_down_".$unique_content_id, 1, time()+7200); 

			$vote_down =$vote_down +1;
			$send_response = array('vote_up'=>$vote_up, 'vote_down'=>$vote_down);
			echo json_encode($send_response);
			break;	
	
		case 'fetch':
			$row = DbGetVotes($unique_content_id);

			$vote_up 	= ($row["vote_up"])?$row["vote_up"]:0; 
			$vote_down 	= ($row["vote_down"])?$row["vote_down"]:0;
			
			$send_response = array('vote_up'=>$vote_up, 'vote_down'=>$vote_down);
			echo json_encode($send_response);
			break;
	}


?>