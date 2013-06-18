<?php

namespace flowcode\shop\service;

use flowcode\shop\dao\ProductDao;
use flowcode\shop\domain\Product;

/**
 * Description of ProductService
 *
 * @author juanma
 */
class ProductService {

    private $productDao;

    public function __construct() {
        $this->productDao = new ProductDao();
    }

    public function findAll() {
        return $this->productDao->findAll();
    }

    public function save(Product $product) {
        $productImageSrv = new ProductImageService();
        foreach ($product->getImages() as $productImage) {
            if (is_null($productImage->getId())) {
                $productImageSrv->save($productImage);
            }
        }
        $this->productDao->save($product);
    }

    public function delete(Product $product) {
        $this->productDao->delete($product);
    }

    public function findById($id) {
        return $this->productDao->findById($id);
    }

    /**
     * Find all products by filter.
     * @return \flowcode\wing\utils\Pager. 
     */
    public function findByFilter($filter = null, $page = 1) {
        $pager = $this->productDao->findByFilter($filter, $page);
        return $pager;
    }

    public function findCategorys(Product $product) {
        return $this->productDao->findCategorys($product);
    }

    public function findImages(Product $product) {
        return $this->productDao->findImages($product);
    }

}

?>
