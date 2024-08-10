<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';

$nombre= $_POST['name'];
$email= $_POST['email'];
$asunto= $_POST['subject'];
$mensaje= $_POST['message'];


$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
/*
Enable SMTP debugging
0 = off (for production use)
1 = client messages
2 = client and server messages
*/
$mail->SMTPDebug = 0;
$mail->Host = 'mail.xn--esosaosdorados-unb.com '; //servidor de correo
$mail->Port = 26; //puerto de correo
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "info@xn--esosaosdorados-unb.com"; //correo del hosting - donde llegan y envia los correos
$mail->Password = "L)5v#}Sf7#8t"; //contrase単a del correo de arriba
$mail->setFrom('info@xn--esosaosdorados-unb.com', 'Pagina Web'); //indica de donde se envia el correo
$mail->addAddress('info@xn--esosaosdorados-unb.com', 'Años Dorados - De '.$nombre); // $correo_cli
$mail->Subject = 'Consulta Cliente';
$mail->Body = "<div style='padding:5px;'> <br> Nombre de Cliente : ".$nombre."<br><br>Correo: ".$email."  <br><br>  Asunto: ".$asunto." <br> <br>   Mensaje: ".$mensaje." <br> </div>";
//$mail->addAttachment('/levox2.png', 'My uploaded file'); <img src='/levox2.png' width='150' height='110'>
$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
$mail->IsHTML(true);

if (!$mail->send())
{
	echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
}
else
{
	header("Location:../../index.php");
}
?>