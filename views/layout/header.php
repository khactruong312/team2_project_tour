<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .img {
            width: 100%;
        }

        #header {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .language-select {
            border: none;
        }

        .separator {
            width: 1px;
            height: 15px;
            background-color: #E0E2EA;
            margin: 5px 10px;
        }

        .language-select {
            margin-bottom: 16px;
        }

        .list-separator {
            width: 100%;
            height: 1px;
            background-color: #E0E2EA;
            margin: auto;
        }

        .container {
            display: flex;
        }

        .container img {
            width: 25%;
        }

        .nav-main {
            padding: 15px 0;
        }

        .nav-main .logo-img {
            width: 180px;
        }

        .nav-main .menu ul {
            list-style: none;
            margin-bottom: 0;
        }

        .nav-main .menu ul li a {
            text-decoration: none;
            color: #212529;
            padding: 0 15px;
            font-weight: 500;
            white-space: nowrap;
            display: block;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .nav-main .menu ul li a:hover {
            color: #0d6efd;
        }
    </style>

</head>

<body>
    <header id="header">
        <div class="d-flex justify-content-center justify-content-between">
            <div class="phone d-flex mt-2">
                <p><span class="phone_icon"><i class="bi bi-telephone-fill"></i></span>Hotline:1900 96 96 00</p>
                <div class="separator"></div>
                <select class="language-select">
                    <option value="1">VI</option>
                    <option value="1">EN</option>
                </select>
            </div>
            <div>
                <div class="login d-flex">
                    <a href="#"><i class="bi bi-person-circle"></i>Đăng ký</a>/
                    <a href="#">Đăng nhập</a>
                </div>
            </div>
        </div>
        <div class="list-separator"></div>

        <div class="nav-main d-flex justify-content-between align-items-center">

            <div>
                <img src="uploads/imgproduct/logo-cong-ty-du-lich-SPencil-Agency-10.png" alt="Travel Logo"
                    class="logo-img">
            </div>

            <div class="menu">
                <ul class="d-flex p-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">TOUR DU LỊCH</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">DU LỊCH TỰ CHỌN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">BOOK KHÁCH SẠN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">VÉ MÁY BAY</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">CẨM NANG DU LỊCH</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">VỀ TRAVEL</a></li>
                </ul>
            </div>
        </div>

    </header>