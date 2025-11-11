<?php
namespace App\Controllers;
use App\Models\Schedule;
class GuideController {
    public function mySchedules(){
        $user = $_SESSION['user'] ?? null;
        // find guide id by user_id (simple query)
        $pdo = \App\Core\DB::pdo();
        $stmt = $pdo->prepare('SELECT g.* FROM guides g WHERE g.user_id = :u'); $stmt->execute(['u'=>$user['user_id']]); $guide = $stmt->fetch();
        $schedules = [];
        if ($guide) {
            $stmt = $pdo->prepare('SELECT s.*, t.name as tour_name FROM tour_schedule s LEFT JOIN tours t ON s.tour_id=t.tour_id WHERE s.guide_id = :g');
            $stmt->execute(['g'=>$guide['guide_id']]); $schedules = $stmt->fetchAll();
        }
        require __DIR__ . '/../../views/guide/my_schedules.php';
    }
}
