<?php

namespace app\Controller;

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

    protected function contact()
    {
        $this->render('page/contact', [ 
        ]);
    }
}