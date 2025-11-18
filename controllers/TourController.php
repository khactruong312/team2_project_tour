<?php
class TourController
{
    private $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
    }

    // Trang chủ
    public function home()
    {
        require_once './views/trangchu.php';
    }

    public function list()
    {
        $tours = $this->tourModel->getAll();
        require_once './views/admin/list.php';
    }

      public function create()
    {
        require_once './views/admin/create.php';
    }

    // Login
    public function store()
    {
        $this->tourModel->create($_POST);
        header("Location: index.php?mod=tour&act=list");
    }

    // Register
     public function edit()
    {
        $id = $_GET['id'];
        $tour = $this->tourModel->getById($id);

        require_once './views/admin/edit.php';
    }
    public function update()
    {
        $id = $_POST['id'];
        $this->tourModel->update($id, $_POST);

        header("Location: index.php?mod=tour&act=list");
    }

     public function delete()
    {
        $id = $_GET['id'];
        $this->tourModel->delete($id);

        header("Location: index.php?mod=tour&act=list");
    }
}
