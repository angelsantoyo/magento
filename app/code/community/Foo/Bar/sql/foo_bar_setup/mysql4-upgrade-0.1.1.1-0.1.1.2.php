<?php

$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();
$installer->run("
	ALTER TABLE {$this->getTable('chiragdodia_mymodule_comments')}
	CHANGE COLUMN `fk_product_id` `fk_product_id` INTEGER NOT NULL;
	");
$installer->endSetup();
