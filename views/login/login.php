<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/styleLogin.css">
</head>
<body>

    <div class="main-wrapper">
        <!-- <h1 class="form-title  text-uppercase mb-5 " id="h1">BƯỚC CHÂN MỞ ƯỚC MƠ</h1> -->

        <div class="login-form-container bg-white p-0 rounded shadow-lg">
            
            <div class="login-header bg-info text-white text-uppercase py-3 text-center">
                ĐĂNG NHẬP
            </div>

            <form class="p-4">
                
                <div class="mb-3">
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" required>
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
                </div>
                
                <button type="submit" class="btn btn-danger btn-lg w-100 mt-2 mb-3 submit-btn">
                    Đăng nhập
                </button>
            </form>

            <div class="social-login text-center px-4 pb-4">
                <p class="text-uppercase fw-bold text-secondary">HOẶC</p>
                <div class="social-icons mb-3">
                    <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>

                    <a href="#" class="social-icon google"><i class="fab fa-google-plus-g"></i></a>
                </div>
                
                <p class="mb-1">
                    Bạn chưa có tài khoản ? <a href="?act=register" class="link-info text-decoration-none fw-bold">ĐĂNG KÝ</a>
                </p>
                
            </div>

        </div>

        <footer class="form-footer text-white text-center mt-5">
            &copy; 2025 DU AN 1 . FPT POLYTECHNIC | Design by Group 2
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>