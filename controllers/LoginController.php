<?php

require_once './models/UserModel.php';

// Bạn cần đảm bảo session_start() được gọi ở đâu đó trước khi sử dụng $_SESSION
// Nếu chưa, hãy thêm session_start() vào đầu file index.php hoặc nơi khởi tạo ứng dụng.

class LoginController {
// session_start();
    public function showLogin() {
        include './views/login/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Tạm thời, tôi bỏ qua vấn đề bảo mật (như hash mật khẩu)
            $user = UserModel::checkLogin($username, $password);

            if ($user) {
                // Lưu session
                // Lưu ý: session_start() phải được gọi trước!
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];

                // Chuyển hướng theo role
                if ($user['role'] == 'admin') {
                    header("Location: index.php?act=admin-home");
                    exit;
                } else {
                    header("Location: index.php?act=guide-home");
                    exit;
                }
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
                include './views/login/login.php';
            }
        }
    }

   

    public function logout() {
        // Đảm bảo session_start() được gọi nếu nó chưa được gọi ở nơi khác
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
    header("Location: index.php?act=login");
    exit;
}

        session_unset();
        session_destroy();

        // 🌟 CÁC LỆNH BỔ SUNG ĐỂ NGĂN BỘ NHỚ CACHE CỦA TRÌNH DUYỆT 🌟
        // Các lệnh này ngăn trình duyệt lưu trang này, buộc nó phải tải lại
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        header("Location: ?act=login");
        exit;
    }
}