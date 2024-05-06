<?php

    require "config.php";

    require "./bibliotecas/PHPMailer/Exception.php";
    require "./bibliotecas/PHPMailer/OAuth.php";
    require "./bibliotecas/PHPMailer/PHPMailer.php";
    require "./bibliotecas/PHPMailer/POP3.php";
    require "./bibliotecas/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array('codigo_status' => null, 'descricao_status' => null);

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            return $this->$atributo = $valor;

        }

        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }

            return true;
        }
    }

    $mensagem = new Mensagem();

    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);


    //if (!$mensagem->mensagemValida()) {
        
       // Header('Location: index.php');
        //echo '<script src="script.js" defer></script>';
    //} 

    $mail = new PHPMailer(true);

    try {

        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication                                      
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->Host = SMTP_HOST;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($mensagem->__get('para'));     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody = 'Necessário um browser que suporte conteudos HTML';

        $mail->send();

        $mensagem->status['codigo_status'] = 1;
        $mensagem->status['descricao_status'] = 'Email enviado com sucesso!';
        

    } catch (Exception $e) {

        $mensagem->status['codigo_status'] = 2;
        $mensagem->status['descricao_status'] = 'Email não foi enviado' . $mail->ErrorInfo;

    }
?>

<html>
    <head>
        <meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>

        <div class="container">  

            <div class="py-3 text-center">
                <img class="d-block mx-auto mb-2" src="images/logo.png" alt="" width="72" height="72">
                <h2>Send Mail</h2>
                <p class="lead">Seu app de envio de e-mails particular!</p>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-md-12 text-center">
                    <?php if($mensagem->status['codigo_status'] == 1) { ?>
                        <div class="container">
                            <h1 class="display-4 text-sucess">Operação bem sucedida!</h1>
                            <p> <?php $mensagem->status['descricao_status']; ?> </p>
                            <a href="index.php" class="btn btn-success btn-lg mt-5 text-white">voltar</a>
                        </div>

                    <?php }  ?>  
                    
                    <?php if($mensagem->status['codigo_status'] == 2) { ?>
                        <div class="container">
                            <h1 class="display-4 text-danger">Operação falhou!</h1>
                            <p> <?php $mensagem->status['descricao_status']; ?> </p>
                            <a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">voltar</a>
                        </div>

                    <?php }  ?> 

                </div>
            </div>

        </div>
        
    </body>
</html>