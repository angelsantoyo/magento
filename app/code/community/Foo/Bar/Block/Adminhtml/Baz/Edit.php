<?php
class Foo_Bar_Block_Adminhtml_Baz_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        $this->_blockGroup = 'foo_bar';
        $this->_controller = 'adminhtml_baz';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Baz'));
        $this->_updateButton('delete', 'label', $this->__('Delete Baz'));
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('foo_bar')->getId()) {
            return $this->__('Edit Baz');
        }
        else {
            return $this->__('New Baz');
        }
    }
}