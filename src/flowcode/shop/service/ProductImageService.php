<?php

namespace flowcode\shop\service;

use flowcode\shop\dao\ProductImageDao;
use flowcode\shop\domain\ProductImage;

/**
 * Description of ProductImageService
 *
 * @author juanma
 */
class ProductImageService {
    private $productImageDao;
    
    public function __construct() {
        $this->productImageDao = new ProductImageDao();
    }
    
    public function findAll(){
        return $this->productImageDao->findAll();
    }
    
    public function save(ProductImage $productImage){
        $this->productImageDao->save($productImage);
    }
    
    public function delete(ProductImage $productImage){
        $this->productImageDao->delete($productImage);
    }
    
    
    public function findById($id){
        return $this->productImageDao->findById($id);
    }
    
    /**
     * Find all productImages by filter.
     * @return \flowcode\wing\utils\Pager. 
     */
    public function findByFilter($filter = null, $page = 1) {
        $pager = $this->productImageDao->findByFilter($filter, $page);
        return $pager;
    }
    
    public function findProducts(ProductImage $productImage) {
        return $this->productImageDao->findProducts($productImage);
    }

    
}

?>
