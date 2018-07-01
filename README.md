## Author:
	Felipe Antonow (felipeantonow7@gmail.com)
	Please send a email if the project has been useful in any way :)

## Goal:
	Study application to integrate with wikipedia


## Config:
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
		 
## Donation
	[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7CTB5ENWGHZAQ)
