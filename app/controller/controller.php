<?php

namespace app\Controller;

use app\db\Mysql;
use app\controller\PageController;

class Controller 
{
    private $db;

    public function __construct() {
        $this->db = Mysql::getInstance()->getPDO();
    }

    public function route(): void
    {
        try{
            if (isset ($_GET['controller'])){
                switch ($_GET['controller']) {
                    case 'page': 
                        $pageController = new pagecontroller();
                        $pageController->route();
                        break;
                    default : 
                        throw new \Exception("Le controleur n'existe pas");
                        break;
                }
            } else {
                $pageController = new pagecontroller();
                $pageController->home();
            }
        } catch (\Exception $e){
            $this->render('error/default', [
                'error' => $e->getMessage()
            ]);
        }
       
    }

    protected function render(string $path, array $params = []): void
{
    // Calcul du chemin relatif depuis ce fichier Controller.php
    $filePath = __DIR__ . '/../../templates/' . $path . '.php';


    try {
        if (!file_exists($filePath)) {
            // Générer erreur si le fichier n'existe pas
            throw new \Exception("Fichier non trouvé : " . $path);
        }

        // Extraire les variables du tableau $params pour le template
        extract($params);

        // Inclure le template
        require $filePath;

    } catch (\Exception $e) {
        // Journaliser l'erreur
        error_log("Erreur de rendu : " . $e->getMessage());
        // Afficher un message d'erreur simple à l'utilisateur
        echo "Erreur : " . $e->getMessage();
    }
}


}