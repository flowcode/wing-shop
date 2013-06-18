<?php

namespace flowcode\shop\dao;

use flowcode\shop\domain\Product;
use flowcode\orm\EntityManager;

/**
 * Description of ProductDao
 *
 * @author juanma
 */
class ProductDao {

    public function __construct() {
        
    }

    public function save(Product $product) {
        EntityManager::getInstance()->save($product);
    }

    public function findAll() {
        return EntityManager::getInstance()->findAll("product");
    }

    public function delete(Product $product) {
        EntityManager::getInstance()->delete($product);
    }

    public function findById($id) {
        return EntityManager::getInstance()->findById("product", $id);
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("product", $filter, $page);
        return $pager;
    }
    
    public function findCategorys(Product $product) {
        $em = EntityManager::getInstance();
        $entitys = $em->findRelation($product, "Categorys");
        return $entitys;
    }

    public function findImages(Product $product) {
        $em = EntityManager::getInstance();
        $entitys = $em->findRelation($product, "Images");
        return $entitys;
    }


}

?>
