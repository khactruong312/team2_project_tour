// Đảm bảo mã này chỉ chạy sau khi toàn bộ trang HTML đã tải xong
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Dữ liệu mẫu cho Biểu đồ Doanh thu
    const labels = ['Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11'];
    const data = {
      labels: labels,
      datasets: [{
        label: 'Doanh thu (Triệu VNĐ)',
        backgroundColor: 'rgba(0, 123, 255, 0.5)',
        borderColor: 'rgb(0, 123, 255)',
        data: [120, 190, 80, 250, 150, 300], 
        borderWidth: 1,
        borderRadius: 5,
      }]
    };

    // 2. Cấu hình biểu đồ
    const config = {
      type: 'bar', // Loại biểu đồ cột
      data: data,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // 3. Khởi tạo và vẽ biểu đồ lên thẻ canvas
    // Chỉ tạo biểu đồ nếu thẻ canvas tồn tại
    const chartElement = document.getElementById('revenueChart');
    if (chartElement) {
        const revenueChart = new Chart(chartElement, config);
    }
    
    // Mã Toggle Sidebar cũng nên được chuyển vào đây
    document.getElementById("menu-toggle").onclick = function() {
        document.getElementById("wrapper").classList.toggle("toggled");
    };
});