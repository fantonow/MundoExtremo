<?php


 if(!isset($_GET['search'])){
     $_GET['search'] = '';
 }
   $current_page = $_GET['search'];

    switch ($current_page) {
        case ('search'):
            include 'dinamico/pesquisar/index_localizar_texto.php';
            break;
        case ('exact'):
            include 'dinamico/existente/index_buscar_texto.php';
            break;
        default:
            include 'dinamico/default/page_default.php';
    }

?>