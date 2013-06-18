<?php

namespace flowcode\shop\domain;

use flowcode\shop\service\ProductCategoryService;
use flowcode\wing\mvc\Entity;

/**
 * Description of ProductCategory
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class ProductCategory extends Entity {
    
            
    private $name;
    private $description;
    private $products;
            
    function __construct() {
        parent::__construct();
        
        $this->products = NULL;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
                
    public function getProducts() {
        if ($this->products == NULL) {
            $productCategorySrv = new ProductCategoryService();
            $this->products = $productCategorySrv->findProducts($this);
        }
        return $this->products;
    }

    public function setProducts($products) {
        $this->products = $products;
    }
                
    public function __toString() {
        return $this->name;
    }

}
?>

