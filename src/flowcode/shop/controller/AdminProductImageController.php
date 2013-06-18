<?php

namespace flowcode\shop\controller;

use flowcode\shop\domain\ProductImage;
use flowcode\shop\service\ProductImageService;
use flowcode\shop\service\ProductService;
use flowcode\shop\domain\Product;
use flowcode\wing\mvc\Controller;
use flowcode\wing\mvc\HttpRequest;
use flowcode\wing\mvc\View;

/**
 * Description of AdminProductImage
 *
 * @author juanma
 */
class AdminProductImageController extends Controller {

    private $productImageService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission("admin-login");
        $this->productImageService = new ProductImageService();
    }

    function index(HttpRequest $httpRequest) {

        $viewData["filter"] = $httpRequest->getParameter("search");
        $viewData["page"] = $httpRequest->getParameter("page");
        if (is_null($viewData["page"]) || empty($viewData["page"])) {
            $viewData["page"] = 1;
        }
        $viewData["pager"] = $this->productImageService->findByFilter($viewData["filter"], $viewData["page"]);

        return View::getControllerView($this, "shop/view/admin/productImageList", $viewData);
    }

    function create(HttpRequest $HttpRequest) {
        $viewData["productImage"] = new ProductImage();
        $productSrv = new ProductService();
        $viewData["products"] = $productSrv->findAll();
        
        return View::getControllerView($this, "shop/view/admin/productImageForm", $viewData);
    }

    function save(HttpRequest $httpRequest) {

        /* creo la nueva instancia y seteo valores */
        $productImage = new ProductImage();
        $productImage->setId($httpRequest->getParameter("id"));
        $productImage->setName($httpRequest->getParameter("name"));
        $productImage->setDescription($httpRequest->getParameter("description"));
        $productImage->setPath($httpRequest->getParameter("path"));
        
        $products = array();
        if (isset($_POST["products"])) {
            foreach ($_POST["products"] as $idproduct) {
                $product = new Product();
                $product->setId($idproduct);
                $products[] = $product;
            }
        }
        $productImage->setProducts($products);
        // la guardo
        $id = $this->productImageService->save($productImage);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

    function edit(HttpRequest $HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $viewData["productImage"] = $this->productImageService->findById($id);
        $productSrv = new ProductService();
        $viewData["products"] = $productSrv->findAll();

        return View::getControllerView($this, "shop/view/admin/productImageForm", $viewData);
    }

    function delete($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $productImage = $this->productImageService->findById($id);
        $this->productImageService->delete($productImage);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

}
?>
