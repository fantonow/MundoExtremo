

<?php
 //$_GET['id']

if(!isset($_GET['id']) ){
    echo '<span>Sorry, I did not find any images :c</span>';
    exit;
}

require_once '../lib/wiki_evento.php';

echo '<h1>Imagens</h1>';
GravaViewImgId($_GET['id']);
$wiki_teste= GetObjListaImg( $_GET['id']);
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
}ELSE{echo '<span>Sorry, I did not find any images :c</span>';}

?>