<?php

$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();
$installer->run("
	ALTER TABLE {$this->getTable('chiragdodia_mymodule_comments')}
	ADD CONSTRAINT `FK_ENTITY_PARENT` FOREIGN KEY (`fk_product_id`)
    REFERENCES {$this->getTable('catalog_product_entity')} (`entity_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE;
	");
$installer->endSetup();
