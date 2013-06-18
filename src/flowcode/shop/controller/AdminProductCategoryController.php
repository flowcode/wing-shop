<?php

namespace flowcode\shop\controller;

use flowcode\shop\domain\ProductCategory;
use flowcode\shop\service\ProductCategoryService;
use flowcode\shop\service\ProductService;
use flowcode\shop\domain\Product;
use flowcode\wing\mvc\Controller;
use flowcode\wing\mvc\HttpRequest;
use flowcode\wing\mvc\View;

/**
 * Description of AdminProductCategory
 *
 * @author juanma
 */
class AdminProductCategoryController extends Controller {

    private $productCategoryService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission("admin-login");
        $this->productCategoryService = new ProductCategoryService();
    }

    function index(HttpRequest $httpRequest) {

        $viewData["filter"] = $httpRequest->getParameter("search");
        $viewData["page"] = $httpRequest->getParameter("page");
        if (is_null($viewData["page"]) || empty($viewData["page"])) {
            $viewData["page"] = 1;
        }
        $viewData["pager"] = $this->productCategoryService->findByFilter($viewData["filter"], $viewData["page"]);

        return View::getControllerView($this, "shop/view/admin/productCategoryList", $viewData);
    }

    function create(HttpRequest $HttpRequest) {
        $viewData["productCategory"] = new ProductCategory();
        $productSrv = new ProductService();
        $viewData["products"] = $productSrv->findAll();
        
        return View::getControllerView($this, "shop/view/admin/productCategoryForm", $viewData);
    }

    function save(HttpRequest $httpRequest) {

        /* creo la nueva instancia y seteo valores */
        $productCategory = new ProductCategory();
        $productCategory->setId($httpRequest->getParameter("id"));
        $productCategory->setName($httpRequest->getParameter("name"));
        $productCategory->setDescription($httpRequest->getParameter("description"));
        
        $products = array();
        if (isset($_POST["products"])) {
            foreach ($_POST["products"] as $idproduct) {
                $product = new Product();
                $product->setId($idproduct);
                $products[] = $product;
            }
        }
        $productCategory->setProducts($products);
        // la guardo
        $id = $this->productCategoryService->save($productCategory);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

    function edit(HttpRequest $HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $viewData["productCategory"] = $this->productCategoryService->findById($id);
        $productSrv = new ProductService();
        $viewData["products"] = $productSrv->findAll();

        return View::getControllerView($this, "shop/view/admin/productCategoryForm", $viewData);
    }

    function delete($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $productCategory = $this->productCategoryService->findById($id);
        $this->productCategoryService->delete($productCategory);

        $viewData["response"] = "success";
        return View::getControllerView($this, "cms/view/admin/form-response", $viewData);
    }

}
?>
