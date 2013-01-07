<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nomad
 * Date: 2012/12/27
 * Time: 12:34 PM
 */

class APIController
{

    var $wineModel;
    var $utilities;
    var $app;

    function __construct($App){

        $this->wineModel = new WineModel();
        $utilities = new Utilities();
        $this->utilities = $utilities;
        $this->app = $App;

    }

    public function getWines() {
        if($this->app->request()->isAjax()){
            $result = $this->wineModel->getWines();
            $this->wineModel->disconnectFromDB();
            $this->wineModel = null;
            echo $result;
        }else{
            $this->redirectToWelcome();
        }
    }
    public function getWine($id) {
        if($this->app->request()->isAjax()){
            $result = $this->wineModel->getWine($id);
            $this->wineModel->disconnectFromDB();
            $this->wineModel = null;
            echo $result;
        }else{
            $this->redirectToWelcome();
        }
    }

    public function addWine() {
        if($this->app->request()->isAjax()){
            $request = $this->app->request();
            $wine = ($request->getBody());
            $requestArray = $this->utilities->urldecode_to_array($wine);
            $requestObject = $this->utilities->array_to_object($requestArray);
            $result = $this->wineModel->addWine($requestObject);
            $this->wineModel->disconnectFromDB();
            $this->wineModel = null;
            echo $result;
        }else{
            $this->redirectToWelcome();
        }
    }

    public function updateWine($id) {
        if($this->app->request()->isAjax()){
            $request = $this->app->request();
            $wine = ($request->getBody());
            $requestArray = $this->utilities->urldecode_to_array($wine);
            $requestObject = $this->utilities->array_to_object($requestArray);
            $result = $this->wineModel->updateWine($requestObject,$id);
            $this->wineModel->disconnectFromDB();
            $this->wineModel = null;
            echo $result;
        }else{
            $this->redirectToWelcome();
        }
    }

    public function deleteWine($id) {
        if($this->app->request()->isAjax()){
            $result = $this->wineModel->deleteWine($id);
            $this->wineModel->disconnectFromDB();
            $this->wineModel = null;
            echo $result;
        }else{
            $this->redirectToWelcome();
        }
    }

    public function findByName($query) {
        if($this->app->request()->isAjax()){
            $result = $this->wineModel->findByName($query);
            $this->wineModel->disconnectFromDB();
            $this->wineModel = null;
            echo $result;
        }else{
            $this->redirectToWelcome();
        }
    }

    private function redirectToWelcome(){
        $this->app->redirect($this->app->request()->getRootUri()."/");
    }

}
