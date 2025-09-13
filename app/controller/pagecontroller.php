<?php

namespace app\Controller;

use app\Model\ContactForm;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class pagecontroller extends Controller
{
    public function route(): void
    {
        try{
            if (isset ($_GET['action'])){
                switch ($_GET['action']) {
                    case 'home': 
                        $this->home();
                        break;
                    case 'about': 
                        $this->about();
                        break;
                    case 'actions': 
                        $this->actions();
                        break;
                    case 'soutenir': 
                        $this->soutenir();
                        break;
                    case 'contact': 
                        $this->contact();
                        break;
                    default : 
                        throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

        
    }

    protected function home()
    {

        $this->render('page/home', [ 
        ]);
    }

    protected function about()
    {
        $this->render('page/about', [ 
        ]);
    }

    protected function actions()
    {
        $this->render('page/actions', [ 
        ]);
    }

        protected function soutenir()
    {
        $this->render('page/soutenir', [ 
        ]);
    }

        public function contact(): void
{
    $success = null;
    $errors = [];
    $form = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        error_log("POST reçu : " . print_r($_POST, true));
        $form = new \app\Model\ContactForm($_POST);

        if ($form->validate()) {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            try {
                // Configuration SMTP depuis le .env
                $mail->isSMTP();
                $mail->Host       = $_ENV['MAIL_HOST'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $_ENV['MAIL_USERNAME'];
                $mail->Password   = $_ENV['MAIL_PASSWORD'];
                $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
                $mail->Port       = $_ENV['MAIL_PORT'];

                $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
                $mail->addAddress($_ENV['MAIL_TO']);

                $mail->isHTML(false);
                $mail->Subject = 'Nouveau message du formulaire de contact';
                $mail->Body    = "Nom: {$form->getName()}\nPrénom: {$form->getSurname()}\nEmail: {$form->getEmail()}\nObjet: {$form->getObject()}\nMessage:\n{$form->getMessage()}";

                $mail->send();
                $success = "Message envoyé avec succès !";

            } catch (\PHPMailer\PHPMailer\Exception $e) {
                $errors[] = "Erreur lors de l'envoi : " . $mail->ErrorInfo;
            }
        } else {
            $errors = $form->getErrors();
        }
    }

    // Rendu du template contact
    error_log("form: " . ($form ? "ok" : "null") . ", success: " . ($success ?? 'null'));

    $this->render('page/contact', [
        'form' => $form,
        'success' => $success,
        'errors' => $errors
    ]);
    }
}