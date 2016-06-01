<?php
class Chiragdodia_Mymodule_Model_Mysql4_Contacts_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{ 
    public function _construct()
    {
		$this->_init('contacts/contacts');
    }
}