<?php 
require_once _ROOTPATH_.'\templates\header.php'; 

require_once 'ContactForm.php';

$successMessage = '';
$errors = [];
$form = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = new ContactForm($_POST);

    if ($form->validate()) {
        if ($form->sendEmail()) {
            $successMessage = 'Votre message a été envoyé avec succès.';
        } else {
            $errors['send'] = 'Erreur lors de l’envoi du message. Veuillez réessayer plus tard.';
        }
    } else {
        $errors = $form->getErrors();
    }
}

?>

<?php if ($successMessage): ?>
    <p style="color: green;"><?= $successMessage ?></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<section class="bg-contact">
    <h1 class="title-contact">Envie d'en savoir plus ?</h1>
        <p class="para-contact">N"hésitez pas à nous contacter sur les réseaux sociaux ou de nous laisser un message ci-dessous.</p>

            <div class="icons">
                <ul class="nav-icons">
                    <li class="para-icon"><img src="/assets/photos/facebook.png" class="icon-facebook" alt="icone facebook"></li><p class="para-li">Soline</p>
                    <li class="para-icon"><img src="/assets/photos/instagram1.png" class="icon-instagram" alt="icone instagram"></li><p class="para-li">association_soline</p>
                    <li class="para-icon"><img src="/assets/photos/linkedin1.png" class="icon-linkedin" alt="icone linkedin"></li><p class="para-li">Association Soline</p>
                </ul>
            </div>

    
    <aside>
        <img src="assets/photos/contact" alt="contact" class="img-contact">
    </aside>    

        <form method="post" action="" id="myForm">
            <div class="body-form">
                <div>
                    <div class="input-group">
                        <input required="" type="text" name="name" autocomplete="off" class="input" id="nom" value="<?= $form ? $form->getName() : '' ?>"> 
                        <label class="user-label" for="nom">Vote nom</label> 
                    </div>
                    <div class="input-group">
                        <input required="" type="text" name="surname" autocomplete="off" class="input" id="prenom" value="<?= $form ? $form->getSurname() : '' ?>"> 
                        <label class="user-label" for="prenom">Votre prénom</label> 
                    </div>
                    <div class="input-group">
                        <input required="" type="email" name="email" autocomplete="off" class="input" id="courriel" value="<?= $form ? $form->getEmail() : '' ?>"> 
                        <label class="user-label" for="courriel">Votre adresse mail</label> 
                    </div>
                    <div class="input-group">
                        <input required="" type="text" name="object" autocomplete="off" class="input" id="objet" value="<?= $form ? $form->getObject() : '' ?>"> 
                        <label class="user-label" for="objet">Objet</label> 
                    </div>
                    <div class="input-group">
                      <textarea rows="7" cols="30" required="" type="message" name="message" autocomplete="off" class="input" id="message"><?= $form ? $form->getMessage() : '' ?></textarea>
                        <label  class="user-label" for="message">Message</label>
                    </div>
                        <button type="submit" class="button1">Envoyer</button>
                </div>
            </div>  
        </form>       

        <div id="confirmationMessage" style="display:none; color:green; margin-top:10px;">
            Merci, votre message a bien été envoyé !
        </div>
</section>
    

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>