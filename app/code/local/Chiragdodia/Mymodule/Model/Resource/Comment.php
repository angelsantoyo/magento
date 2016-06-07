<?php
class Chiragdodia_Mymodule_Model_Resource_Comment extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('chiragdodia_mymodule/comment', 'guest_id');
    }
    
}