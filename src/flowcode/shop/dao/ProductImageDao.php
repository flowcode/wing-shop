<?php

namespace flowcode\shop\dao;

use flowcode\shop\domain\ProductImage;
use flowcode\orm\EntityManager;

/**
 * Description of ProductImageDao
 *
 * @author juanma
 */
class ProductImageDao {

    public function __construct() {
        
    }

    public function save(ProductImage $productImage) {
        EntityManager::getInstance()->save($productImage);
    }

    public function findAll() {
        return EntityManager::getInstance()->findAll("productImage");
    }

    public function delete(ProductImage $productImage) {
        EntityManager::getInstance()->delete($productImage);
    }

    public function findById($id) {
        return EntityManager::getInstance()->findById("productImage", $id);
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("productImage", $filter, $page);
        return $pager;
    }
    
    public function findProducts(ProductImage $productImage) {
        $em = EntityManager::getInstance();
        $entitys = $em->findRelation($productImage, "Products");
        return $entitys;
    }


}

?>
