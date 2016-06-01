<?php
class Chiragdodia_Mymodule_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function testAction()
    {
        echo "test action";
    }
}