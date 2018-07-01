<?php

 $debug = false;
 

if(!isset($_SESSION['vezes'])){$_SESSION['vezes']=1; }
	$_SESSION['vezes']   = (int)$_SESSION['vezes'] +1;
	
if(((int)$_SESSION['vezes'])<100){
	

try{
	

	$params = 'action=query';
	$params .= '&list=random&rnnamespace=0';
	$params .= '&rnlimit=6';
	$params .= '&format=xml';
	
	$query = 'http://en.wikipedia.org/w/api.php?'.$params;

	
	/*
		api.php?action=query&list=random&rnnamespace=0&rnlimit=2	

		https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=${keywords}&prop=info&inprop=url&utf8=&format=json&origin=*&sroffset=${number}&srlimit=20`

		Retorna miniaturas:
		https://pt.wikipedia.org/w/api.php?action=query&prop=pageimages&titles=Albert%20Einstein&pithumbsize=100
		
		Retorna lista de pesquisa
		https://en.wikipedia.org/w/api.php?format=xml&origin=*&action=query&generator=search&gsrlimit=4&prop=extracts&exintro&explaintext&exsentences=1&exlimit=max&gsrsearch=felipe
	*/
	

//	$xml = new SimpleXMLElement(file_get_contents($query, false, NULL));

	if($debug){
		header("Content-type: text/xml");
		echo $xml->asXML();
		exit;
	}
} catch (Exception $e) {
    die('The Matrix see you');
}




if(empty($xml->query)){	

} else{	
	foreach ($xml->query->random->page as $r): 	
			echo '<a class="a_misc" href="?search=exact&search_p='.urlencode($r['id']).'">'.str_replace('"','', $r['title']).'</a>';
	endforeach; 
}
}
?>

