<?php


function gerar_buttons($id_p){

    return '<div class="voting_wrapper_pai">
				<div class="voting_wrapper" id="'.$id_p.'" >
					<div class="voting_btn">
						<div class="up_button">&nbsp;</div><span class="up_votes" id="'.$id_p.'up_votes" >0</span>
					</div>
					<div class="voting_btn">
						<div class="down_button">&nbsp;</div><span class="down_votes" id="'.$id_p.'down_votes">0</span>
					</div>
			  	</div>
			  </div>
			';

	}

?>