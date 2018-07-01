Author: Felipe Antonow (felipeantonow7@gmail.com)
		Please send a email if the project has been useful in any way :)

Goal:Study application to integrate with wikipedia


Config:
	Path: /estrutura_base_dados.sql
		Script base dados mysql

	Path: /dinamico/lib/db_evento.php
		$server="mysql.servidor.com.br"; //Servidor banco de dados
		$user="banco_user"; //Usuario banco de dados
		$password="banco_password"; //Senha banco de dados
		$dbname="banco_name"; //Nome do  banco de dados
		$porta="3306";

	Path: /email.php
		$mail->Host = '#smtp.servidor.com.br#'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Port       = 587; //  Usar 587 porta SMTP
		$mail->Username = '#Username#'; // Usuário do servidor SMTP (endereço de email)
		$mail->Password = '#Password#'; // Senha do servidor SMTP (senha do email usado)
		 
		
	Path: /dinamico/lib/email_erro.php
		$mail->Host = '#smtp.servidor.com.br#'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Port       = 587; //  Usar 587 porta SMTP
		$mail->Username = '#Username#'; // Usuário do servidor SMTP (endereço de email)
		$mail->Password = '#Password#'; // Senha do servidor SMTP (senha do email usado)
		 
	 
	 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>
