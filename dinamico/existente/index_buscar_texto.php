<?php
 require_once 'dinamico/lib/wiki_evento.php';

$debug = false;

	if(!isset($_GET['search_p']) or ($debug)){
		if($debug){
				$_GET['search_p'] = '502128';
		}else{
			die;
		}
	}

try{
	$wiki_principal = GetPrincipalId($_GET['search_p']);
	if ($wiki_principal->id == -1){
		echo '<header class="major"><h2>The Matrix see you</h2></header>';
		echo '<p>I did not find what you want. See other options found...</p>';
	}else{
		
		if ( $wiki_principal->ds_url_image != ''){
			echo '<p><img src="'.$wiki_principal->ds_url_image.'" class="img_serch" itemprop="image" ></p>';
		}
		echo '<header class="major"><h2 itemprop="name">'.$wiki_principal->ds_titulo.'</h2></header>';
		echo '<p  itemprop="articleBody">'.$wiki_principal->ds_conteudo.'</p>';
		echo '<header class="major"><div class="box alt" id="more_images">	<p><a class="more_images button small" id="'.$wiki_principal->id.'" >See images<a></p></div></header>';
		
		include 'vote/vote_buttons.php';
		echo gerar_buttons($wiki_principal->id);
					

//teste
/*
echo '<H1>IMAGE</H1>';
$wiki_teste= GetObjListaImg($wiki_principal->id);
$is_first = false;
if (count($wiki_teste) >0){
	echo '<div class="box alt">	<div class="row uniform 50%">';
	foreach ($wiki_teste as $value) {
		if($is_first){
			$classe='12u';
			$is_first=false;
		}else{
			$classe='4u';	
		}
	
		echo '<div class="'.$classe.'"><span class="image fit"><img src="'.$value->ds_titulo.'" /></span></div>';
	}
	echo '</div></div>';
}ELSE{echo 'Sorry, I did not find any images :c';}
*/


		//Lista de pesquisa principal
		$lista_wiki = GetObjListaPesquisa($wiki_principal->ds_titulo);
		if (count($lista_wiki) >0){
			
			echo '<br/><br/><header class="major"><h1>Others options</h1></header>';
			echo '<ul class="actions">';
			foreach ($lista_wiki as $value) {
				echo '<li> <a href="?search=exact&search_p='.urlencode($value->id).'" >'.str_replace('"','', $value->ds_titulo).'</a></li>';
			}
			echo '</ul>';
		}
		echo ' <a href="#header" class="button scrolly" > Search other </a>';
		echo '<script type="text/javascript">
					document.title = "'.str_replace('"','', $wiki_principal->ds_titulo).'";
					document.onreadystatechange = function () {
						if (document.readyState === "complete") {
							document.getElementById("begin_result").click();
						}
					}
		 	 </script>';
	}
	
} catch (Exception $e) {
    die('The Matrix see you');
}


?>

   
   