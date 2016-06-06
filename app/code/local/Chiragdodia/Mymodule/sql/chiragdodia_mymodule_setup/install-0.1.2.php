<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('chiragdodia_mymodule/comment'))
    ->addColumn('guest_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('guest_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
    ), 'Name')
    ->addColumn('guest_email', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ), 'Email')
    ->addColumn('guest_phone', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => true,
    ), 'Phone Number')
    ->addColumn('guest_comments', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ), 'Comments')
    ->addColumn('guest_created_at',Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            'nullable' => false,
            'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
    ), 'created at') ;
$installer->getConnection()->createTable($table);

$installer->endSetup();