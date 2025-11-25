<?php
class GuideController{
    private $guideModel;

    public function __construct()
    {
        $this->guideModel = new GuideModel();
    }
    // Trang chủ hướng dẫn viên

    public function guideHome()
    {
        // $totalTours = $this->guideModel->countTours();
        require_once './views/guide/trangchu.php';
    }
    public function list()
    {
        $guides = $this->guideModel->getAll();
        require_once './views/guide/list.php';
    }
}