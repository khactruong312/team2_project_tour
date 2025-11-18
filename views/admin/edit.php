<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tour</title>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/logo-cong-ty-du-lich-SPencil-Agency-10.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Shadow nổi bật hơn */
            background-color: #f8f9fa; /* Nền màu xám nhạt */
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #17a2b8; /* Màu xanh teal/info */
            border-bottom: 2px solid #17a2b8;
            padding-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>✏️ Chỉnh Sửa Thông Tin Tour</h2>

        <form action="index.php?act=tour-update" method="POST">
            <input type="hidden" name="id" value="<?= $tour['tour_id'] ?>">

            <div class="mb-3">
                <label for="tourId" class="form-label text-muted">ID Tour:</label>
                <input type="text" id="tourId" value="<?= $tour['tour_id'] ?>" class="form-control" readonly disabled>
            </div>

            <div class="mb-3">
                <label for="tourName" class="form-label">Tên tour:</label>
                <input type="text" name="name" id="tourName" value="<?= $tour['name'] ?>" class="form-control" required placeholder="Nhập tên tour du lịch...">
            </div>

            <div class="mb-3">
                <label for="tourType" class="form-label">Loại tour:</label>
                <select name="type" id="tourType" class="form-select">
                    <option value="Trong nước" <?= $tour['type']=='Trong nước'?'selected':'' ?>>Trong nước 🇻🇳</option>
                    <option value="Quốc tế" <?= $tour['type']=='Quốc tế'?'selected':'' ?>>Quốc tế 🌍</option>
                    <option value="Theo yêu cầu" <?= $tour['type']=='Theo yêu cầu'?'selected':'' ?>>Theo yêu cầu 💡</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tourPrice" class="form-label">Giá (VNĐ):</label>
                <input type="number" name="price" id="tourPrice" value="<?= $tour['price'] ?>" class="form-control" required min="0" placeholder="Chỉ nhập số, ví dụ: 5000000">
            </div>

            <div class="mb-3">
                <label for="tourDuration" class="form-label">Thời lượng (Ngày):</label>
                <input type="number" name="duration_days" id="tourDuration" value="<?= $tour['duration_days'] ?>" class="form-control" min="1" placeholder="Số ngày du lịch, ví dụ: 3">
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Mô tả chi tiết:</label>
                <textarea name="description" id="tourDescription" class="form-control" value="<?= $tour['description'] ?>" rows="4" placeholder="Mô tả các điểm nổi bật, lịch trình tóm tắt của tour..."><?= $tour['description'] ?></textarea>
            </div>
            <div class="mb-4">
                <label for="tourDescription" class="form-label">Trạng thái:</label>
                <select  name="status" id="status" class="form-select">
                    <option value="Chưa khởi hành"<?= $tour['status']=='Active'?'selected':'' ?>>Active</option>
                    <option value="Đang khởi hành"<?= $tour['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Thời gian:</label>
                <input type="date" name="created_at" id="tourDescription" value="<?= $tour['created_at']?>" class="form-control" rows="4" placeholder="Thời gian tour..."><?= $tour['created_at']?></input>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">🔄 Cập Nhật Thông Tin</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>