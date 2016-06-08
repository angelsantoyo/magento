<?php


class Foo_Bar_Block_Adminhtml_Baz_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        // Set some defaults for our grid
        $this->setDefaultSort('guest_id');
        $this->setId('foo_bar_baz_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'foo_bar/baz_collection';
    }

    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'guest_id'
            )
        );

        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'guest_name'
            )
        );

        $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'index' => 'guest_email'
            )
        );

        $this->addColumn('phone',
            array(
                'header'=> $this->__('Telephone'),
                'index' => 'guest_phone'
            )
        );

        $this->addColumn('comments',
            array(
                'header'=> $this->__('Comment'),
                'index' => 'guest_comments'
            )
        );

        $this->addColumn('created',
            array(
                'header'=> $this->__('Created at'),
                'index' => 'guest_created_at'
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}