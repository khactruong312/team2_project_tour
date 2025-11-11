<?php
namespace App\Controllers;
use App\Models\Schedule;
use App\Models\Guide;
use App\Models\Tour;
class ScheduleController {
    public function index(){ $m=new Schedule(); $schedules=$m->all(); require __DIR__ . '/../../views/admin/schedules/index.php'; }
    public function create(){ $g=new Guide(); $guides=$g->all(); $t=new Tour(); $tours=$t->all(); require __DIR__ . '/../../views/admin/schedules/create.php'; }
    public function assign(){ $m=new Schedule(); $data=['tour_id'=>$_POST['tour_id'],'guide_id'=>$_POST['guide_id'],'start_date'=>$_POST['start_date'],'end_date'=>$_POST['end_date'],'vehicle'=>$_POST['vehicle'],'hotel'=>$_POST['hotel'],'status'=>'Chưa khởi hành']; $m->create($data); header('Location: /schedules'); }
}
