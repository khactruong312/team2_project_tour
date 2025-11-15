<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/styleLogin.css">
    
    <style>
        /* Tùy chỉnh nhỏ cho form Đăng ký rộng hơn một chút nếu cần thiết */
        .login-form-container {
            max-width: 400px; /* Tăng chiều rộng form một chút để chứa nhiều trường */
        }
        /* Đảm bảo trường input nhỏ hơn vẫn đồng bộ */
        .form-control-lg {
             font-size: 1rem; /* Giữ kích thước input phù hợp với form rộng */
        }
    </style>
</head>
<body>

    <div class="main-wrapper">
        

        <div class="login-form-container bg-white p-0 rounded shadow-lg">
            
            <div class="login-header bg-info text-white text-uppercase py-3 text-center">
                ĐĂNG KÝ
            </div>

            <form class="p-4">
                
                <div class="mb-3">
                    <input type="text" class="form-control form-control-lg" id="fullName" placeholder="Họ và Tên" required>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" required>
                </div>
                
                <div class="mb-3">
                    <input type="tel" class="form-control form-control-lg" id="phone" placeholder="Số điện thoại" required>
                </div>
                
                
                <div class="mb-3">
                    <input type="text" class="form-control form-control-lg" id="cccd" placeholder="Căn cước công dân" required>
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Mật khẩu" required>
                </div>

                 <div class="mb-3">
                    <input type="password" class="form-control form-control-lg" id="confirmPassword" placeholder="Xác nhận mật khẩu" required>
                </div>
                
                <button type="submit" class="btn btn-danger btn-lg w-100 mt-2 mb-3 submit-btn">
                    Đăng Ký
                </button>
            </form>

            <div class="social-login text-center px-4 pb-4">
                <p class="text-uppercase fw-bold text-secondary">HOẶC</p>
                <div class="social-icons mb-3">
                    <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon google"><i class="fab fa-google-plus-g"></i></a>
                </div>
                
                <p class="mb-1">
                    Bạn đã có tài khoản ? <a href="?act=login" class="link-info text-decoration-none fw-bold">ĐĂNG NHẬP</a>
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