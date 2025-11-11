<?php
namespace App\Controllers;
use App\Models\Tour;
use App\Models\TourDestination;
class TourController {
    public function index(){ $m = new Tour(); $tours = $m->all(); require __DIR__ . '/../../views/admin/tours/index.php'; }
    public function create(){ require __DIR__ . '/../../views/admin/tours/create.php'; }
    public function store(){
        $m = new Tour();
        $data = ['n'=>$_POST['name'],'t'=>$_POST['type'],'p'=>$_POST['price'],'d'=>$_POST['duration_days'],'desc'=>$_POST['description'],'s'=>$_POST['status']];
        $m->create($data); header('Location: /tours');
    }
    public function edit(){ $id=$_GET['id']??0; $m=new Tour(); $tour=$m->find($id); $destModel=new TourDestination(); $destinations=$destModel->forTour($id); require __DIR__ . '/../../views/admin/tours/edit.php'; }
    public function update(){ $m=new Tour(); $id=$_POST['tour_id']; $data=['n'=>$_POST['name'],'t'=>$_POST['type'],'p'=>$_POST['price'],'d'=>$_POST['duration_days'],'desc'=>$_POST['description'],'s'=>$_POST['status']]; $m->update($id,$data); header('Location: /tours'); }
    public function delete(){ $id=$_GET['id']??0; $m=new Tour(); $m->delete($id); header('Location: /tours'); }
}
