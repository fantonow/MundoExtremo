<?php
require_once 'db_evento.php';
//require_once 'db_evento.php';

class Post_Wiki{
    public $ds_titulo;
    public $ds_url_image;
    public $ds_conteudo;
    public $id;
}  

function getXmlFromUrl($query){
	try{
        GravaLog($query,'get');
	    @$xml=  new SimpleXMLElement(file_get_contents($query, false, NULL));
        return $xml;

    } catch (Exception $e) {
        GravaLog('getXmlFromUrl():'.$query,'error');
        GravaLog($e,'error');
    }   
}

function GetURLWiki(){
    return 'http://en.wikipedia.org/w/api.php?';
}

function GetQueryListaPesquisa($pesquisa){
    $params = 'action=query';
	$params .= '&origin=*';
	$params .= '&generator=search';
	$params .= '&gsrlimit=7';
    $params .= '&gsrsearch='.urlencode($pesquisa);
	$params .= '&format=xml';

    return GetURLWiki().$params;
}

function GetQueryListaFileImage($id){
    $params = 'action=query';
	$params .= '&prop=images';
    $params .= '&imlimit=20';
    
    $params .= '&pageids='.$id;
	$params .= '&format=xml';

    return GetURLWiki().$params;
    /*
    https://en.wikipedia.org/w/api.php?action=query&prop=images&pageids=629758&format=xml
    */
}

function GetQueryUrlListaFileImage($img_list){
    $params = 'action=query';
	$params .= '&iiprop=url';
    $params .= '&prop=imageinfo';
    $params .= '&iiurlwidth=150';
    $params .= '&titles='.($img_list);
	$params .= '&format=xml';

    return GetURLWiki().$params;
    /*
    https://en.wikipedia.org/w/api.php?action=query&continue=&iiprop=url&prop=imageinfo&titles=File%3ABlumenau-1.jpg
    */
}




function GetQueryPrincipalPesquisa($pesquisa){
    $params = 'action=query';
	$params .= '&prop=extracts|pageimages';
	$params .= '&pithumbsize=500';
	$params .= '&exlimit=1';
	$params .= '&exintro&explaintext&exsentences=6';
	$params .= '&continue';
    $params .= '&titles='.urlencode($pesquisa);
	$params .= '&format=xml';

	return GetURLWiki().$params;
}

function GetQueryConteudoId($id){
    $params = 'action=query';
	$params .= '&prop=extracts|pageimages';
	$params .= '&pithumbsize=500';
	$params .= '&exlimit=max';
	$params .= '&explaintext&exintro';
	$params .= '&exsentences=10';
	$params .= '&continue';
	$params .= '&pageids='. $id;
	$params .= '&format=xml';

    return GetURLWiki().$params;
}


//teste
function GetObjListaImg($id){
     $xml = getXmlFromUrl(GetQueryListaFileImage($id));
     $lista_obj = new ArrayObject(); 
     $list_img = "";
    if(empty($xml->query->pages->page->images)){	  
        //nada     
    } else{
        foreach ($xml->query->pages->page->images->im as $r): 
            if(!empty($list_img)){ $list_img .="|";}	
            $list_img .= urlencode($r['title']);
        endforeach; 
        if(!empty($list_img)){
            
            $xml = getXmlFromUrl(GetQueryUrlListaFileImage($list_img));
            
            if(empty($xml->query->pages->page)){
                // nada
            }else{
                foreach ($xml->query->pages->page as $r):
                   if($r['imagerepository']=="shared"){
                        $post_wiki = new Post_Wiki();
                        $post_wiki->ds_titulo=$r->imageinfo->ii['thumburl'];
                        $lista_obj -> append($post_wiki); 
                   }	
                endforeach; 
            }
        }
    }
    
    return  $lista_obj;
}

function GetObjPrincipalPesquisa($pesquisa){
    $xml_principal = getXmlFromUrl(GetQueryPrincipalPesquisa($pesquisa));
    $post_wiki = new Post_Wiki();
    if(empty($xml_principal->query)){
		$post_wiki->id = -1;
    } else{
	    $ie_imprimir = true;
	    foreach ($xml_principal->query->pages->page as $r): 	
	    if($ie_imprimir){
		    if ($r['_idx']=='-1'){
				    $post_wiki->id = -1;
		    }else{
                $post_wiki->id = $r['pageid'];
                $post_wiki->ds_titulo=$r['title'];
                $post_wiki->ds_url_image= $r->thumbnail['source'];
                $post_wiki->ds_conteudo = $r->extract;	
                Atualiza_Banco($post_wiki->ds_titulo,
                               $post_wiki->ds_url_image,
                               $post_wiki->ds_conteudo,
                               $post_wiki->id);	    
		    }	
	    }
	    endforeach; 
    }
    return $post_wiki;
}


function GetObjListaPesquisa($pesquisa){
     $xml = getXmlFromUrl(GetQueryListaPesquisa($pesquisa));
     $lista_obj = new ArrayObject(); 

    if(empty($xml->query)){	  
        //nada     
    } else{
        foreach ($xml->query->pages->page as $r): 
            $post_wiki = new Post_Wiki();
            $post_wiki->id = $r['pageid'];
            $post_wiki->ds_titulo=$r['title'];

            $lista_obj -> append($post_wiki); 	
        endforeach; 
    }
    return $lista_obj;
}


function GetObjConteudoId($id){
    $xml_principal = getXmlFromUrl(GetQueryConteudoId($id));
    $post_wiki = new Post_Wiki();
    if(empty($xml_principal->query)){
		$post_wiki->id = -1;
    } else{
	    $ie_imprimir = true;
        foreach ($xml_principal->query->pages->page as $r): 	
        if($ie_imprimir){
		    if ($r['_idx']=='-1'){
				    $post_wiki->id = -1;
		    }else{
                $post_wiki->id = $r['pageid'];
                $post_wiki->ds_titulo=$r['title'];
                $post_wiki->ds_url_image= $r->thumbnail['source'];
                $post_wiki->ds_conteudo = $r->extract;

                Atualiza_Banco($post_wiki->ds_titulo,
                               $post_wiki->ds_url_image,
                               $post_wiki->ds_conteudo,
                               $post_wiki->id);		    
		    }	
	    }
	    endforeach; 
    }
    return $post_wiki;
}


function GetPrincipalId($id){
    $row_wiki = RetornaPesquisaId($id);
    if(!empty($row_wiki['id'])){
        $post_wiki = new Post_Wiki();
        $post_wiki->id = $row_wiki['id'];
        $post_wiki->ds_titulo=$row_wiki['ds_titulo'];
        $post_wiki->ds_url_image= $row_wiki['ds_url_image'];
        $post_wiki->ds_conteudo = $row_wiki['ds_conteudo'];
        return $post_wiki;
    }else{
        return GetObjConteudoId($id);
    }
}


function GetPrincipalPesquisa($pesquisa){
    $row_id = RetornaPesquisaTitulo($pesquisa);

    if(!empty($row_id['id'])){
        return GetPrincipalId($row_id['id']);
    }else{
        return GetObjPrincipalPesquisa($pesquisa);
    }
}



?>