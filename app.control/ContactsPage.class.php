<?php

include_once('app.phpmailer/PHPMailer.class.php');
include_once('app.phpmailer/Exception.class.php');
include_once('app.phpmailer/SMTP.class.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactsPage extends AdoPage{
	private $form;
	function __construct(){
		parent::__construct();
		$this->class = "container";

		/*Contactos*/
		$article = new AdoArticle();
		$article->class = 'contacts';

		$section = new AdoSection();

		$obj = new AdoParagraph('Tasca da Rosa - Valpaços', 'h2');
		$article->add($obj);

		$obj = new AdoParagraph('Email:', 'h3');
		$section->add($obj);

		$obj = new AdoParagraph('tascadarosa@gmail.com');
		$section->add($obj);

		$obj = new AdoParagraph('Telemovel:', 'h3');
		$section->add($obj);

		$obj = new AdoParagraph('931 846 764 / 912 937 789');
		$section->add($obj);

		$obj = new AdoParagraph('Telefone', 'h3');
		$section->add($obj);

		$obj = new AdoParagraph('278 711 123');
		$section->add($obj);

		$article->add($section);
		parent::add($article);
		
		/*Localização fisica*/
		$aside = new AdoAside();

		$fname = 'gmaps.txt';
		$fid = fopen($fname, 'r');
		$src = fread($fid, filesize($fname));
		fclose($fid);

		$obj = new AdoIFrame($src);
		$aside->add($obj);

		$article->add($aside);

		/*form email*/
		$this->form = new AdoForm('tascaform');
		$this->form->setClass('tascaform');
		$this->form->setAction(new AdoAction(array($this, 'onSubmit')));
		$this->form->setOnSubmit('formValidation');

		$article = new AdoArticle();

		$section = new AdoSection();

		$obj = new AdoParagraph('Fale connosco', 'h2');
		$article->add($obj);

		$name = new AdoEntry('name');
		$name->setPlaceholder('Nome Completo');
		$email = new AdoMail('email');
		$email->setPlaceholder('exemplo@exm.com');
		$subject = new AdoCombo('subject');
		$message = new AdoText('message');
		$message->setPlaceholder('Descrição');
		$message->setId('message');

		$section->add(new AdoLabel('Nome', 'name'));
		$section->add($name);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Email', 'email'));
		$section->add($email);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Assunto', 'subject'));
		$subject->addItems(array('Informações','Sugestões', 'Reclamações'));
		$section->add($subject);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Mensagem', 'message'));
		$section->add($message);
		$article->add($section);

		$section = new AdoSection();
		$button = new AdoSubmit('submitb');
		$button->setLabel('Enviar');
		$button->setProperty('disabled', '1');

		$section->add($button);

		$this->form->setFields(array($name, $email, $subject, $message, $button));

		$article->add($section);
		$this->form->add($article);

		parent::add($this->form);
	}

	function onSubmit(){
		if(count($_POST) == 5){
			$sender = 'tascadarosa@gmail.com';
			$message = $_POST['message'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$subjectlist = ['Informações', 'Sugestões', 'Reclamações'];
			$subject = $subjectlist[$_POST['subject']+1];

			$message = nl2br("From: {$email}\n" . $message);

			$mail = new PHPMailer(true);
			try {
			    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
			    $mail->isSMTP();
			    $mail->CharSet = 'UTF-8';
			    $mail->Encoding = 'base64';
			    $mail->SMTPAuth = true;
			    $mailSMTPSecure = 'tls';
			    $mail->Host = 'smtp.gmail.com';
			    $mail->Port = 587;
			    $mail->isHTML(true);
			##################### DADOS #########################
			    $mail->Username = '';
			    $mail->Password = '';
			#####################################################
			    $mail->setFrom($email, 'Correio Automático');
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			    $mail->AddAddress($sender);
			    $mail->Subject = $subject;
			    $mail->Body = $message;
			    $mail->AltBody = $message;

			    $mail->send();
				new AdoMessage('sucess', 'Email enviado com sucesso!');
			} catch (Exception $e) {
				new AdoMessage('erro', "Email enviado sem sucesso!<br>{$mail->ErrorInfo}");
			}
		}
		else{
			new AdoMessage('info', 'Falta de dados para envio de Email');
		}
	}
}
?>
