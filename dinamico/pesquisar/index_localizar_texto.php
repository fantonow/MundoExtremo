<?php

 require_once 'dinamico/lib/wiki_evento.php';

 $debug = false;

	if(!isset($_GET['search_p']) or ($debug)){
		if($debug){
				$_GET['search_p'] = urlencode('Mundo Extremo');
		}else{
			die;
		}
	}


if ($_GET['search_p'] == '4815162342'){
	echo 'Password is enabled. To start the protocol activation, enter the value defined by the operation. <br><br>';
	echo 'The first phase was activated. <br><br>';
	echo 'Transaction 2 of 2. Wallet: 1NhyoUyh3Gs2mZY5h8yrfASadpVYqpuAmY';
	die;
}

try{
	$SEARCH = ($_GET['search_p']);
	GravaPalavraPesquisada($SEARCH);
	//Pesquisa principal
	$wiki_principal =GetPrincipalPesquisa($SEARCH);
	if ($wiki_principal->id == -1){
		if ($SEARCH == ''){	
			echo '<header class="major"><h2>The Matrix see you</h2></header>';
		}else{
			echo '<header class="major"><h2>'.$SEARCH.'</h2></header>';	
		}
		echo '<p>I did not find what you want. See other options found...<br/>
			    
			 </p>
			 <script type="text/javascript">
					document.title = "I did not find what you want: '.str_replace('"','', $SEARCH).'";
					document.onreadystatechange = function () {
						if (document.readyState === "complete") {
							document.getElementById("begin_result").click();
						}
					}
		 	 </script>';



	}else{
		
		if ( $wiki_principal->ds_url_image != ''){
			echo '<p><img src="'.$wiki_principal->ds_url_image.'" class="img_serch" ></p>';
		}
		echo '<header class="major"><h2>'.$wiki_principal->ds_titulo.'</h2></header>';
		echo '<p>'.$wiki_principal->ds_conteudo.'</p>';
		echo '<header class="major"><div class="box alt" id="more_images">	<p><a class="more_images button small" id="'.$wiki_principal->id.'" >See images<a></p></div></header>';
		
		include 'vote/vote_buttons.php';
		echo gerar_buttons($wiki_principal->id);

		echo '<script type="text/javascript">
					document.title = "'.str_replace('"','', $wiki_principal->ds_titulo).'";
					document.onreadystatechange = function () {
						if (document.readyState === "complete") {
							document.getElementById("begin_result").click();
						}
					}
		 	 </script>';
	}

	//Lista de pesquisa principal
	$lista_wiki = GetObjListaPesquisa($SEARCH);
	if (count($lista_wiki) >0){
		
		echo '<header class="major"><h1>Others options</h1></header>';
		echo '<ul class="actions">';
		foreach ($lista_wiki as $value) {
			echo '<li> <a href="?search=exact&search_p='.urlencode($value->id).'" >'.str_replace('"','', $value->ds_titulo).'</a></li>';
		}
		echo '</ul>';
	}
	echo ' <a href="#header" class="button scrolly" > Search other </a>';

} catch (Exception $e) {
    die('The Matrix see you');
}


?>

