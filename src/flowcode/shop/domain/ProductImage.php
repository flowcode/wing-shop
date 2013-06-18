<?php

namespace flowcode\shop\domain;

use flowcode\shop\service\ProductImageService;
use flowcode\wing\mvc\Entity;

/**
 * Description of ProductImage
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class ProductImage extends Entity {
    
            
    private $name;
    private $description;
    private $path;
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
    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }
                
    public function getProducts() {
        if ($this->products == NULL) {
            $productImageSrv = new ProductImageService();
            $this->products = $productImageSrv->findProducts($this);
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

