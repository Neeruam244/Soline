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
        $filePath = _ROOTPATH_.'/templates/'.$path.'.php';

        try{
            if (!file_exists($filePath)){
                //Générer erreur
                throw new \Exception("Fichier non trouvé :".$path);
            } 

            extract($params);
            require_once $filePath;
            
        } catch (\Exception $e) {
            error_log("Erreur de rendu : " . $e->getMessage());
            echo "Erreur : " . $e->getMessage();
        }
    }

}