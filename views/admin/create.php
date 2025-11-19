<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tour Mới</title>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff; /* Màu xanh dương */
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2><i class="bi bi-house-add-fill"></i> Thêm Tour Mới</h2>

        <form action="index.php?act=tour-store" method="POST">

            <div class="mb-3">
                <label for="tourName" class="form-label">Tên tour:</label>
                <input type="text" name="name" id="tourName" required class="form-control" placeholder="Nhập tên tour du lịch...">
            </div>

            <div class="mb-3">
                <label for="tourName" class="form-label">Ảnh tour:</label>
                <input type="file" name="image" id="tourName" class="form-control" required placeholder="Nhập ảnh tour du lịch...">
            </div>

            <div class="mb-3">
                <label for="tourType" class="form-label">Loại tour:</label>
                <select  name="type" id="tourType" class="form-select">
                    <option value="Trong nước">Trong nước 🇻🇳</option>
                    <option value="Quốc tế">Quốc tế 🌍</option>
                    <option value="Theo yêu cầu">Theo yêu cầu 💡</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tourPrice" class="form-label">Giá (VNĐ):</label>
                <input type="number" name="price" id="tourPrice" class="form-control" required min="0" placeholder="Chỉ nhập số, ví dụ: 5000000">
            </div>

            <div class="mb-3">
                <label for="tourDuration" class="form-label">Thời lượng (Ngày):</label>
                <input type="number" name="duration" id="tourDuration" class="form-control" min="1" placeholder="Số ngày du lịch, ví dụ: 3">
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Mô tả chi tiết:</label>
                <textarea name="description" id="tourDescription" class="form-control" rows="4" placeholder="Mô tả các điểm nổi bật, lịch trình tóm tắt của tour..."></textarea>
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Trạng thái:</label>
                <select  name="status" id="status" class="form-select">
                    <option value="Chưa khởi hành">Active</option>
                    <option value="Đang khởi hành">Inactive</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="tourDescription" class="form-label">Thời gian:</label>
                <input type="date" name="created_at" id="tourDescription" class="form-control" rows="4" placeholder="Thời gian tour..."></input>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-house-add-fill"></i> Lưu Tour</button>
            </div>
            <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-danger btn-lg"><i class="bi bi-chevron-bar-left"></i> <a class="text-decoration-none text-white" href="index.php?act=tour-list">Hủy</a></button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>