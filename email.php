<?php
 
 session_start();



if($_POST['captcha']<>$_SESSION["code"]){
    echo '<script language= "JavaScript">
            alert("I realized that you are a robo. Sorry, only humans can send a message :c ");
            location.href="index.php";
           </script>';
    exit;
}

if(((!isset($_POST['name'])) or (!isset($_POST['email']))) or  (!isset($_POST['message']))){
     echo '<script language= "JavaScript">
            alert("Sorry, your post was not sent, some information is missing :c ");
            location.href="index.php";
           </script>';
    exit;
}

if((($_POST['name']=="") or ($_POST['email']=="")) or  ($_POST['message']=="")){
     echo '<script language= "JavaScript">
            alert("Sorry, your post was not sent, some information is missing :c ");
            location.href="index.php";
           </script>';
    exit;
}


$message = "Contato de: ".strip_tags($_POST['name'])."<br/>";
$message.= "Email: ".strip_tags($_POST['email'])."<br/>";
$message.= "Mensagem: ".strip_tags($_POST['message'])."<br/><br/>";
$message.= "Url: ".$_POST['url'];



// Inclui o arquivo class.phpmailer.php localizado na pasta class
require_once("dinamico/lib/PHPMailer_5.2.0/class.phpmailer.php");
 
// Inicia a classe PHPMailer
$mail = new PHPMailer(true);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
 
try {
     $mail->Host = '#smtp.servidor.com.br#'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     $mail->Port       = 587; //  Usar 587 porta SMTP
     $mail->Username = '#Username#'; // Usuário do servidor SMTP (endereço de email)
     $mail->Password = '#Password#'; // Senha do servidor SMTP (senha do email usado)
 
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
     $mail->SetFrom('felipeantonow7@gmail.com', 'Mundo Extremo'); //Seu e-mail
    // $mail->AddReplyTo('seu@e-mail.com.br', 'Nome'); //Seu e-mail
     $mail->Subject = 'Contao do Site';//Assunto do e-mail
 
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $mail->AddAddress('felipeantonow7@gmail.com', 'Felipe Antonow');
 
     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
     //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
     //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
 
 
     //Define o corpo do email
     $mail->MsgHTML($message); 
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();

    echo '<script language= "JavaScript">
            alert("Thank you for the contact");
            location.href="index.php";
           </script>';
 
    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
          echo '<script language= "JavaScript">
            alert("Sorry, your post was not sent, please try again later");
            location.href="index.php";
           </script>';
    }
?>