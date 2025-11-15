<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    public function Home()
    {
        require_once './views/trangchu.php';
    }
    public function Login(){
        require_once './views/login/login.php';
    }
    public function Register(){
        require_once './views/login/register.php';
    }
    
    
    
}
