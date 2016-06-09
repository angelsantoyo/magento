<?php

$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();
$tableName = $installer->getTable('chiragdodia_mymodule_comments');

$installer->getConnection()
    ->addColumn($tableName,
        'fk_product_id',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
            'nullable' => true,
            'default' => null,
            'comment' => 'fk_product_id'
        )
    );
$installer->endSetup();
