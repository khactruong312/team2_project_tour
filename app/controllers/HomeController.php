<?php
class HomeController extends Controller {
    public function index() {
        $homeModel = $this->model('HomeModel');
        $data = $homeModel->getWelcomeMessage();
        $this->view('home', ['message' => $data]);
    }
}
