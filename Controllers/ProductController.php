<?php
require_once(__DIR__ . "/BaseController.php");
require_once(__DIR__ . '/../Models/Product.php');


class ProductController extends BaseController {
    protected $product;
    public function __construct() {
        $this->product = new Product();
    }

    public function index() {
        $number_page = 1;
        if(!empty($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
         settype($page, "int");
         $from = ($page - 1) * $number_page;
        $products = $this->product->getPageProducts($number_page, $from);

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            echo json_encode($products);
        } else {
        $this->view('products/index.php', $products);
        }
    }
    public function detail() {
       
        $this->view('products/detail.php');
    }

    public function edit($params = []) {
        $id = $params['id'];
        $product = $this->product->getProduct($id);
        if (count($product) == 0) {
            echo 'Product not found!';
            die;
        }
        $this->view('products/edit.php', $product[0]);
    }

    public function validate_form() {

        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }
        if(isset($_GET["ten_sp"])) {
            $ten_sp = $_GET["ten_sp"];
        }
        if(isset($_GET["ma_sp"])) {
            $ma_sp = $_GET["ma_sp"];
        }
        if(isset($_GET["ngay_sx"])) {
            $ngay_sx = $_GET["ngay_sx"];
        }
        if(isset($_POST["ten_sp"])) {
            $ten_sp = $_POST["ten_sp"];
        }
        if(isset($_POST["ma_sp"])) {
            $ma_sp = $_POST["ma_sp"];
        }
        if(isset($_POST["ngay_sx"])) {
            $ngay_sx = $_POST["ngay_sx"];
        }

        $length_ten_sp = strlen($ten_sp);
        $length_ma_sp = strlen($ma_sp);
        $length_ngay_sx = strlen($ngay_sx);
       
        $arrError = [];
        if(!empty($_GET["id"])) {
            if( $length_ma_sp == 0 ) {
            $arrError['ma_sp'] = "Vui long nhap du thong tin";
        } else {
            $product = $this->product->getCodeProduct( $ma_sp, $id);
            if(count($product) != 0) {
            $arrError['ma_sp'] = "Ma san phan ton tai";    
        }
        }
         if($length_ngay_sx == 0) {
            $arrError['ngay_sx'] = "Vui long nhap du thong tin";
        }
         if($length_ten_sp == 0) {
            $arrError['ten_sp'] = "Vui long nhap du thong tin";
        }
        echo json_encode($arrError); 
        } else {
            if( $length_ma_sp == 0 ) {
            $arrError['ma_sp'] = "Vui long nhap du thong tin";
        } else {
            $product = $this->product->checkCodeProduct($ma_sp);
            if(count($product) != 0) {
            $arrError['ma_sp'] = "Ma san phan ton tai";    
        }
        }
         if($length_ngay_sx == 0) {
            $arrError['ngay_sx'] = "Vui long nhap du thong tin";
        }
         if($length_ten_sp == 0) {
            $arrError['ten_sp'] = "Vui long nhap du thong tin";
        }
        echo json_encode($arrError); 
        }
         
    }

    public function update() {
        $id =  $_POST["id"];
        $ten_sp = $_POST["ten_sp"];
        $ma_sp = $_POST["ma_sp"];
        $ngay_sx = $_POST["ngay_sx"];
        $this->product->updateProduct($id,$ten_sp, $ma_sp, $ngay_sx);
        header("Location: http://localhost/User/product");
    }

    public function delete($id){
        $id = implode($id);
        $this->product->deleteProduct($id);
        header("Location: http://localhost/User/product");
    }

    public function create() {
        $products = $this->product->createProduct();
        $this->view('products/create.php', $products);
    }

    public function postProduct() {
        $ten_sp = $_POST["ten_sp"];
        $ma_sp = $_POST["ma_sp"];
        $ngay_sx = $_POST["ngay_sx"];
        $ma_nsx = $_POST["ma_nsx"];
        var_dump($ma_nsx);
        $this->product->postProduct($ten_sp, $ma_sp,$ngay_sx,$ma_nsx);
        header("Location: http://localhost/User/product");
    }
}