<?php

for ($x = 0; $x <= 800; $x++) {
    //Get product Random id
    $productCollection = Mage::getModel('catalog/product')
        ->getCollection();
    $productCollection
        ->addStoreFilter()
        ->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
    $productCollection->getSelect()->order('RAND()');

    $rand_id = $productCollection->getFirstItem()->getData('entity_id');

    $comment =
        array(
            'guest_name' => 'test'.$rand_id,
            'guest_email'=> 'test'.$rand_id.'@test.com',
            'guest_phone'=> '123'.$rand_id.'1234',
            'guest_comments' => 'Unable to add items to cart.'.$rand_id.'blablabla',
            'guest_created_at' => strftime('%Y-%m-%d %H:%M:%S', time()),
            'fk_product_id' => $rand_id,
        );

    Mage::getModel('foo_bar/baz')
        ->setData($comment)
        ->save();
}
