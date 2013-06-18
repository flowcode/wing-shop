<?php

namespace flowcode\shop\domain;

use flowcode\shop\service\ProductService;
use flowcode\wing\mvc\Entity;

/**
 * Description of Product
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class Product extends Entity {
    
            
    private $name;
    private $description;
    private $status;
    private $categorys;
    private $images;
            
    function __construct() {
        parent::__construct();
        
        $this->categorys = NULL;
        $this->images = NULL;
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
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
                
    public function getCategorys() {
        if ($this->categorys == NULL) {
            $productSrv = new ProductService();
            $this->categorys = $productSrv->findCategorys($this);
        }
        return $this->categorys;
    }

    public function setCategorys($categorys) {
        $this->categorys = $categorys;
    }
                
    public function getImages() {
        if ($this->images == NULL) {
            $productSrv = new ProductService();
            $this->images = $productSrv->findImages($this);
        }
        return $this->images;
    }

    public function setImages($images) {
        $this->images = $images;
    }
                
    public function __toString() {
        return $this->name;
    }

}
?>

