<?php

class Example_Helloworld_IndexController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
        //echo 'Hello Index!';
        $this->loadLayout();
        $this->renderLayout();
    }

    public function goodbyeAction() {
        echo 'Hello Index!';
        //$this->loadLayout();
        //$this->renderLayout();
    }
}