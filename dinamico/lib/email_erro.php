<?php
 
function EmailAlert($erro){


$message ='Olá mestre, <br> Estou tendo problemas aqui, pode me ajudar? <br> <br>Esta ocorrendo isso:<Br> '.$erro;
// Inclui o arquivo class.phpmailer.php localizado na pasta class

 require_once("PHPMailer_5.2.0/class.phpmailer.php");
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
     $mail->Subject = 'Problema com o servidor';//Assunto do e-mail
 	 $mail->IsHTML(true);
	 $mail->CharSet = "UTF-8";
 
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

    }catch (phpmailerException $e) {
        
    }
}
?>