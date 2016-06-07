<?php
class Chiragdodia_Mymodule_Model_Resource_Comment_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('chiragdodia_mymodule/comment');
    }
}