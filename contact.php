<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


const ERROR_REQUIRED = 'Ce champ est requis';
const ERROR_EMAIL = 'Veuillez entrer une adresse email valide';
const ERROR_LENGTH_NAME = 'Votre nom doit faire entre 2 et 50 caractères';
const ERROR_LENGTH_SUBJECT = 'Votre sujet doit faire entre 2 et 15 caractères';
const ERROR_LENGTH_MESSAGE = 'Votre message doit faire entre 2 et 500 caractères';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $errors = [];

    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $subject = cleanInput($_POST['subject']);
    $message = cleanInput($_POST['message']);

    if (empty($name)) {
        $errors['name'] = ERROR_REQUIRED;
    } elseif (strlen($name) < 2 || strlen($name) > 50) {
        $errors['name'] = ERROR_LENGTH_NAME;
    }

    if (empty($email)) {
        $errors['email'] = ERROR_REQUIRED;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ERROR_EMAIL;
    }

    if (empty($subject)) {
        $errors['subject'] = ERROR_REQUIRED;
    } elseif (strlen($subject) < 2 || strlen($subject) > 15) {
        $errors['subject'] = ERROR_LENGTH_SUBJECT;
    }

    if (empty($message)) {
        $errors['message'] = ERROR_REQUIRED;
    } elseif (strlen($message) < 2 || strlen($message) > 500) {
        $errors['message'] = ERROR_LENGTH_MESSAGE;
    }

    if (empty($errors)) {
        $to = $email;

        $mail = new PHPMailer(true);
        try {
            // Paramètres du serveur
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mortimerproton@gmail.com';
            $mail->Password = 'ouerhwfsctkpxubj';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinataires
            $mail->setFrom($email, $name);
            $mail->addAddress($to);

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo "<span style='color: green;'>Votre message a bien été envoyé !</span>";
        } catch (Exception $e) {
            echo "<span style='color: red;'>ERREUR message non envoyé !</span>";
        }
    }
}
?>

<h2 class="h1-responsive font-weight-bold text-center my-4">Me contacter</h2>
<!--Section description-->
<p class="text-center w-responsive mx-auto mb-5">Vous voulez me contacter ? juste ici !</p>

<div class="row">

    <!--Grid column-->
    <div class="col-md-9 mb-md-0 mb-5 mx-auto">
        <form id="contact-form" name="contact-form" action="index.php" method="POST">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="name" class="">Votre nom</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <?= !empty($errors['name']) ? "<span style='color: red;'>" . $errors['name'] . "</span>" : "" ?>
                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="email" class="">Votre email</label>
                        <input type="text" id="email" name="email" class="form-control">
                        <?= !empty($errors['email']) ? "<span style='color: red;'>" . $errors['email'] . "</span>" : "" ?>
                    </div>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <label for="subject" class="">Sujet</label>
                        <input type="text" id="subject" name="subject" class="form-control">
                        <?= !empty($errors['subject']) ? "<span style='color: red;'>" . $errors['subject'] . "</span>" : "" ?>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <label for="message">Votre message</label>
                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        <?= !empty($errors['message']) ? "<span style='color: red;'>" . $errors['message'] . "</span>" : "" ?>
                    </div>

                </div>
            </div>
            <!--Grid row-->

        </form>

        <div class="text-center text-md-left">
            <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Envoyer</a>
        </div>
        <div class="status"></div>
    </div>
    <!--Grid column-->


</div>