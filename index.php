
<!doctype html>
<html>
    <head>
        <title>Contacto Brayan Rojas</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
    <?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';
		$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
		$mensaje = isset( $_POST['message'] ) ? $_POST['message'] : '';
		$mail = new PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->Host = 'sandbox.smtp.mailtrap.io'; 
			$mail->SMTPAuth = true;
			$mail->Username = 'fb3a7c0e06c979';
            $mail->Password = '9df314138321d6'; 
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 2525;
			$mail->setFrom('nirock6@gmail.com', 'Formulario de contacto'); 
			$mail->addAddress('destinatario@dominio.com', 'Destinatario'); 
			$mail->isHTML(true);
			$mail->Subject = 'Formulario de contacto';
			$mail->Body = "<br>Email: $email<br>Mensaje: $mensaje";
			$mail->AltBody = "\nEmail: $email\nMensaje: $mensaje";
			$mail->send();
			echo '<p>El mensaje ha sido enviado correctamente.</p>';
		} catch (Exception $e) {
			echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
		}
$user ='root';
$pass ='';
$host ='localhost';

$connect = mysqli_connect($host, $user, $pass,'contact');
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';

$email_error = '';
$message_error = '';

if (count($_POST))
{ 
    $errors = 0;

    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }

    if ($errors == 0)
    {

        $query = 'INSERT INTO contact (
                email,
                message
            ) VALUES (
                "'.addslashes($_POST['email']).'",
                "'.addslashes($_POST['message']).'"
            )';
        mysqli_query($connect, $query);

        $message = 'You have received a contact form submission:
            
Email: '.$_POST['email'].'
Message: '.$_POST['email'];

        mail( 'poveda.geovanny@hotmail.com', 
            'Contact Form Cubmission',
            $message );

        header('Location: thankyou.html');
        die();

    }
}

?>
    
        <h1>Contacto Brayan Rojas</h1>

        <form method="post" action="">
        
            Email Address:
            <br>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <?php echo $email_error; ?>

            <br><br>

            Message:
            <br>
            <textarea name="message"><?php echo $message; ?></textarea>
            <?php echo $message_error; ?>

            <br><br>

            <input type="submit" value="Submit">
        
        </form>
    
    </body>
</html>
