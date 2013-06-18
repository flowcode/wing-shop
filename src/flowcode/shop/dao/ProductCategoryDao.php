<?php

namespace flowcode\shop\dao;

use flowcode\shop\domain\ProductCategory;
use flowcode\orm\EntityManager;

/**
 * Description of ProductCategoryDao
 *
 * @author juanma
 */
class ProductCategoryDao {

    public function __construct() {
        
    }

    public function save(ProductCategory $productCategory) {
        EntityManager::getInstance()->save($productCategory);
    }

    public function findAll() {
        return EntityManager::getInstance()->findAll("productCategory");
    }

    public function delete(ProductCategory $productCategory) {
        EntityManager::getInstance()->delete($productCategory);
    }

    public function findById($id) {
        return EntityManager::getInstance()->findById("productCategory", $id);
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("productCategory", $filter, $page);
        return $pager;
    }
    
    public function findProducts(ProductCategory $productCategory) {
        $em = EntityManager::getInstance();
        $entitys = $em->findRelation($productCategory, "Products");
        return $entitys;
    }


}

?>
