<?php

namespace flowcode\shop\controller;

use flowcode\shop\domain\Product;
use flowcode\shop\service\ProductService;
use flowcode\shop\service\ProductCategoryService;
use flowcode\shop\domain\ProductCategory;
use flowcode\shop\service\ProductImageService;
use flowcode\shop\domain\ProductImage;
use flowcode\wing\mvc\Controller;
use flowcode\wing\mvc\HttpRequest;
use flowcode\wing\mvc\View;

/**
 * Description of AdminProduct
 *
 * @author juanma
 */
class AdminProductController extends Controller {

    private $productService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission("admin-login");
        $this->productService = new ProductService();
    }

    function index(HttpRequest $httpRequest) {

        $viewData["filter"] = $httpRequest->getParameter("search");
        $viewData["page"] = $httpRequest->getParameter("page");
        if (is_null($viewData["page"]) || empty($viewData["page"])) {
            $viewData["page"] = 1;
        }
        $viewData["pager"] = $this->productService->findByFilter($viewData["filter"], $viewData["page"]);

        return View::getControllerView($this, "shop/view/admin/productList", $viewData);
    }

    function create(HttpRequest $HttpRequest) {
        $viewData["product"] = new Product();
        $productCategorySrv = new ProductCategoryService();
        $viewData["categorys"] = $productCategorySrv->findAll();
        $productImageSrv = new ProductImageService();
        $viewData["images"] = $productImageSrv->findAll();
        
        return View::getControllerView($this, "shop/view/admin/productForm", $viewData);
    }

    function save(HttpRequest $httpRequest) {

        /* creo la nueva instancia y seteo valores */
        $product = new Product();
        $product->setId($httpRequest->getParameter("id"));
        $product->setName($httpRequest->getParameter("name"));
        $product->setDescription($httpRequest->getParameter("description"));
        $product->setStatus($httpRequest->getParameter("status"));
        
        $categorys = array();
        if (isset($_POST["categorys"])) {
            foreach ($_POST["categorys"] as $idproductCategory) {
                $productCategory = new ProductCategory();
                $productCategory->setId($idproductCategory);
                $categorys[] = $productCategory;
            }
        }
        $product->setCategorys($categorys);
        $images = array();
        if (isset($_POST["images"])) {
            foreach ($_POST["images"] as $idproductImage) {
                $productImage = new ProductImage();
                $productImage->setId($idproductImage);
                $images[] = $productImage;
            }
        }
        $product->setImages($images);
        // la guardo
        $id = $this->productService->save($product);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

    function edit(HttpRequest $HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $viewData["product"] = $this->productService->findById($id);
        $productCategorySrv = new ProductCategoryService();
        $viewData["categorys"] = $productCategorySrv->findAll();
        $productImageSrv = new ProductImageService();
        $viewData["images"] = $productImageSrv->findAll();

        return View::getControllerView($this, "shop/view/admin/productForm", $viewData);
    }

    function delete($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $product = $this->productService->findById($id);
        $this->productService->delete($product);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

}
?>
