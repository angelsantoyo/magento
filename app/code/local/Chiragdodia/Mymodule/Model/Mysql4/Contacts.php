<?php

class Chiragdodia_Mymodule_Model_Mysql4_Contacts extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
    	
        $this->_init('contacts/contacts', 'guest_id'); // guest_id -> your table's primary key

    }
}