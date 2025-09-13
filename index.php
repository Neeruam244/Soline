<?php 
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use app\Controller\PageController;

// Charger les variables d’environnement depuis la racine
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Router très simple
$page = $_GET['page'] ?? 'contact';

// Instancier le contrôleur
$controller = new PageController();

switch ($page) {
    case 'contact':
        $controller->contact();
        break;
    default:
        echo "404 - Page introuvable";
}

define('_ROOTPATH_', __DIR__); //



