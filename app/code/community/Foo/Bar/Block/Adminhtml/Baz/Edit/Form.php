<?php
class Foo_Bar_Block_Adminhtml_Baz_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('foo_bar_baz_form');
        $this->setTitle($this->__('Baz Information'));
    }

    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('foo_bar');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('guest_id' => $this->getRequest()->getParam('guest_id'))),
            'method'    => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('checkout')->__('Baz Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('guest_id', 'hidden', array(
                'name' => 'guest_id',
            ));
        }

        $fieldset->addField('guest_name', 'text', array(
            'name'      => 'guest_name',
            'label'     => Mage::helper('checkout')->__('Name'),
            'title'     => Mage::helper('checkout')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('guest_email', 'text', array(
            'name'      => 'guest_email',
            'label'     => Mage::helper('checkout')->__('Email'),
            'title'     => Mage::helper('checkout')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('guest_phone', 'text', array(
            'name'      => 'guest_phone',
            'label'     => Mage::helper('checkout')->__('Telephone'),
            'title'     => Mage::helper('checkout')->__('Telephone'),
            'required'  => true,
        ));

        $fieldset->addField('guest_comments', 'text', array(
            'name'      => 'guest_comments',
            'label'     => Mage::helper('checkout')->__('Comments'),
            'title'     => Mage::helper('checkout')->__('Comments'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}