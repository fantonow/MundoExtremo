<?php


function GetConexao(){
	$server="mysql.servidor.com.br"; //Servidor banco de dados
    $user="banco_user"; //Usuario banco de dados
    $password="banco_password"; //Senha banco de dados
    $dbname="banco_name"; //Nome do  banco de dados
    $porta="3306";

    $conn = @new mysqli($server, $user, $password, $dbname,$porta);
    if ($conn->connect_error) {
        try{
            require_once("email_erro.php");
            EmailAlert($conn->connect_error);
        }catch (phpmailerException $e) {
            
        }
        die("<h3>Sorry, we are currently in maintenance</h3> <h1>Code 01</h1>");
    } 

    return $conn;
}



function Atualiza_Banco($ds_titulo,$ds_url_image,$ds_conteudo,$id_wiki){
     $conn = GetConexao();
     
     
     $sql = sprintf("REPLACE INTO wiki (ds_titulo, ds_url_image, ds_conteudo, dt_atualizacao, id) VALUES ('%s','%s','%s',NOW(),'%s')",
                    mysqli_real_escape_string($conn,$ds_titulo),
                    mysqli_real_escape_string($conn,$ds_url_image),
                    mysqli_real_escape_string($conn,$ds_conteudo),
                    mysqli_real_escape_string($conn,$id_wiki));

     $conn->query($sql);
     $conn->close();
}

function RetornaPesquisaTitulo($ds_titulo){
    $conn = GetConexao();

	$sql= sprintf("SELECT max(id) as id FROM wiki WHERE upper(ds_titulo) = upper('%s') ",
                   mysqli_real_escape_string($conn,$ds_titulo));	
	
    $result=$conn->query($sql);
    return $result->fetch_assoc();
    $conn->close();
}

function RetornaPesquisaId($id){
    $conn = GetConexao(); 

	$sql="SELECT *  FROM wiki WHERE id = '$id' ";	
	
    $result=$conn->query($sql);

    $sql="CALL SET_VIEW_ID ('$id') ";	
    $conn->query($sql);   

    return $result->fetch_assoc();
    $conn->close();
}

function GravaViewImgId($id){
    $conn = GetConexao(); 
    $sql="CALL SET_VIEW_IMG_ID ('$id') ";	
    $conn->query($sql);   
    $conn->close();
}

function GravaLog($ds_log,$tipo){
     $conn = GetConexao();
     
     $sql = sprintf("INSERT INTO log(ds_log, dt_atualizacao,ds_tipo) VALUES ('%s',NOW(),'%s')",
                    mysqli_real_escape_string($conn,$ds_log),
                    mysqli_real_escape_string($conn,$tipo));
     $conn->query($sql);
     $conn->close();
}


function GravaPalavraPesquisada($ds_palavra){
     $conn = GetConexao();
     
     $sql = sprintf("INSERT INTO word_search(ds_word, dt_atualizacao) VALUES ('%s',NOW())",
                    mysqli_real_escape_string($conn,$ds_palavra));
     $conn->query($sql);
     $conn->close();
}


//////////////////votar////////////////////////////////

function DbGetVotes($id){
    $conn = GetConexao();
    $sql = sprintf("SELECT vote_up,vote_down FROM voting_count WHERE unique_content_id='%s' LIMIT 1",
                    mysqli_real_escape_string($conn,$id));
    $result=$conn->query($sql);
    return $result->fetch_assoc();
    $conn->close();
}

function DbSetVoteUp($id,$update_down){
     $conn = GetConexao();
     
     $sql = sprintf("UPDATE voting_count SET vote_up=vote_up+1, dt_atualizacao=now() WHERE unique_content_id='%s' ",
                    mysqli_real_escape_string($conn,$id));
     $conn->query($sql);
     if($update_down==true){
        $sql = sprintf("UPDATE voting_count SET vote_down=vote_down-1, dt_atualizacao=now() WHERE vote_down >0 and unique_content_id='%s' ",
                    mysqli_real_escape_string($conn,$id));
        $conn->query($sql);    
     }
     $conn->close();
}

function DbSetVoteDown($id,$update_up){
     $conn = GetConexao();
     
     $sql = sprintf("UPDATE voting_count SET vote_down=vote_down+1, dt_atualizacao=now() WHERE unique_content_id='%s' ",
                    mysqli_real_escape_string($conn,$id));
     $conn->query($sql);
     if($update_up==true){
        $sql = sprintf("UPDATE voting_count SET vote_up=vote_up-1, dt_atualizacao=now() WHERE vote_up >0 and unique_content_id='%s' ",
                    mysqli_real_escape_string($conn,$id));
        $conn->query($sql);    
     }
     $conn->close();
}

function DbInsertVote($id,$up,$down){
     $conn = GetConexao();
     
     $sql = sprintf("INSERT INTO voting_count (unique_content_id, vote_down, vote_up) value('%s','%s','%s')",
                    mysqli_real_escape_string($conn,$id),
                    mysqli_real_escape_string($conn,$down),
                    mysqli_real_escape_string($conn,$up)
                    );

     $conn->query($sql);
     $conn->close();
}

?>