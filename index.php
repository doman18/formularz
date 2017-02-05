<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formularz kontaktowy</title>
		<script src="jqvalidation/lib/jquery.js"></script>
		<script src="jqvalidation/dist/jquery.validate.js"></script>
		<link rel="stylesheet" href="css/bootstrap.css">
		<script src="js/skrypty.js"></script>
		<style>
		.error{
			color:red;
		}
		
		.noerror{
			color:green;
		}
		</style>
	</head>
	<body>
            <div class="container">
	<?php
	/*
	if(!empty($_POST)){
		 foreach ($_POST as $key=>$value){
			 echo $key.'='.$value."<br>";
		 }
	}
	*/
	require 'phpmailer/PHPMailerAutoload.php';

	function wyslij($im,$naz,$mail,$tem,$wiad){
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		/*$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		$mail->Username = 'user@example.com';                 // SMTP username
		$mail->Password = 'secret';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                */    // TCP port to connect to
		
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->Username = 'doman180@gmail.com';                 // SMTP username
		$mail->Password = '-------';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//$mail->setFrom($mail,$im.' '.$naz);
		//$mail->addReplyTo($mail,$im.' '.$naz);
		//$mail->setFrom('adres@domena.com','Imie Nazwisko');
		//$mail->addReplyTo($mail,$im.' '.$naz);

		$mail->addAddress('doman18@tlen.pl', 'Dominik Panas');     // Add a recipient
		$mail->addAddress('doman180@gmail.com','Dominik Panas'); 
		
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail -> charSet = "UTF-8";

		$mail->Subject = $tem;
		$mail->Body    = $wiad;
		
		//=============Obejście problemu z wysłaniem z WAMPA=========
		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		//====================================================
		
                $mmsg="";
		if(!$mail->send()) {
			$mmsg = 'Nie wysłano wiadomości.<br>';
			$mmsg .= 'Błąd Mailera: '.$mail->ErrorInfo;
                        $mclass= 'alert-danger';
		} else {
			$mmsg = 'Wiadomość wysłana';
                        $mclass= 'alert-success';
		}
                
                echo '<div class="alert '.$mclass.'">'.$mmsg.'</div>';
		
		unset($mail);
		
	}
	
        $klasa_imie_err = "";
        $klasa_nazwisko_err = "";
        
	if(!empty($_POST)){
		$err=false;
		$msg = '';
                
		 if (ctype_alpha($_POST['imie'])==false){
			 $msg .='Imię zawiera niepoprawne znaki! <br>';
			 $err=true;
                         $klasa_imie_err = "error";
		 }
		  if (ctype_alpha($_POST['nazwisko'])==false){
			 $msg .='Nazwisko zawiera niepoprawne znaki! <br>';
			 $err=true;
                         $klasa_nazwisko_err = "error";
		 }
		 
		 if($err == true) echo '<div class="alert alert-danger">
                                        <strong>Błąd!</strong> '.$msg.'</div>';
                 
		 else {
			 $wiadomosc = '
			 <p>Nadawca: '.$_POST['imie'].' '.$_POST['nazwisko'].'</p>
			 <p>Email: '.$_POST['email'].'</p>
			 <br>
			 <p>'.strip_tags($_POST['wiadomosc']).'</p>
			 <br>
			 <br>
			 <p style="font-style:italic;font-weight:bold">Wiadomość wysłana z formularza kontaktowego<p>
			 ';
			
			wyslij($_POST['imie'],$_POST['nazwisko'],$_POST['email'],strip_tags($_POST['temat']),$wiadomosc);
			//wyslij('Bolek','Lolek','mail@domena.pl','temat','wiadomosc');
		 }
	}

?>
                <div class="col-lg-8 col-lg-offset-2">
                    <form class="formkontakt" id="formularzkontaktowy" method="post" >
                        <fieldset>
                                <legend>Formularz kontaktowy</legend>
                                <div class="form-group">
                                        <label for="cimie">Imię (wymagane)</label>
                                        <input id="cimie" name="imie" type="text" class="form-control input-lg <?php echo $klasa_imie_err ?>" value="<?php echo isset($_POST['imie']) ?$_POST['imie'] :""  ?>">
                                </div>
                                <div class="form-group">
                                        <label for="cnazwisko">Nazwisko (wymagane)</label>
                                        <input id="cnazwisko" name="nazwisko" type="text" class="form-control input-lg <?php echo $klasa_nazwisko_err ?>" value="<?php echo isset($_POST['nazwisko']) ?$_POST['nazwisko'] :""  ?>">
                                </div>
                                <div class="form-group">
                                        <label for="cemail">E-Mail (wymagany)</label>
                                        <input id="cemail" name="email" type="email" class="form-control input-lg" value="<?php echo isset($_POST['email']) ?$_POST['email'] :""  ?>">
                                </div>
                                <div class="form-group">
                                        <label for="ctemat">Temat (wymagany)</label>
                                        <input id="ctemat" name="temat" type="text" class="form-control input-lg" value="<?php echo isset($_POST['temat']) ?$_POST['temat'] :""  ?>">
                                </div>
                                <div class="form-group">
                                        <label for="cwiadomosc">Wiadomość (wymagana)</label>
                                        <textarea id="cwiadomosc" name="wiadomosc" class="form-control"><?php echo isset($_POST['wiadomosc']) ?$_POST['wiadomosc'] :""  ?></textarea>
                                </div>

                                <button class="submit btn btn-primary" type="submit" value="Wyślij">Wyślij</button>

                        </fieldset>
                    </form>
                </div>
            </div>
	</body>
</html>
