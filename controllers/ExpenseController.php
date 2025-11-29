<?php
require_once './models/ExpenseModel.php';
require_once './models/TourModel.php';

class ExpenseController
{
    private $expenseModel;
    private $tourModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
        $this->tourModel = new TourModel();
    }

    public function index()
    {
        $expenses = $this->expenseModel->getAll();

        require_once './views/admin/expenses/list.php';
    }

    public function create()
    {
        $tours = $this->tourModel->getAll();
        require_once './views/admin/expenses/create.php';
    }

     public function store() {
        $this->expenseModel->create(
            $_POST['tour_id'],
            $_POST['type'],
            $_POST['amount'],
            $_POST['date'],
            $_POST['note']
        );

        $_SESSION['success'] = "Thêm chi phí thành công!";
        header("Location: index.php?act=expense-list");
    }

    
    public function edit() {
        $expense = $this->expenseModel->getById($_GET['id']);
        $tours = $this->tourModel->getAll();
        require_once './views/admin/expenses/edit.php';
    }

    public function update() {
        $this->expenseModel->update(
            $_POST['expense_id'],
            $_POST['tour_id'],
            $_POST['type'],
            $_POST['amount'],
            $_POST['date'],
            $_POST['note']
        );

        $_SESSION['success'] = "Cập nhật chi phí thành công!";
        header("Location: index.php?act=expense-list");
    }

     public function delete() {
        $this->expenseModel->delete($_GET['id']);
        $_SESSION['success'] = "Xóa chi phí thành công!";
        header("Location: index.php?act=expense-list");
    }
}
?>