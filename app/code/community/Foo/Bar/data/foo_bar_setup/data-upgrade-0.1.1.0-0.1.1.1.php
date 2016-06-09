<?php

//get Actuall collection of
$comments = Mage::getModel('foo_bar/baz')
    ->getCollection();

foreach ($comments as $comment) {
    //Get product Random id
    $productCollection = Mage::getModel('catalog/product')
        ->getCollection();
    $productCollection
        ->addStoreFilter()
        ->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
    $productCollection->getSelect()->order('RAND()');

    $rand_id = $productCollection->getFirstItem()->getData('entity_id');

    $comment->setFkProductId($rand_id);
    $comment->save();
}
