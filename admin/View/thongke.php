<?php
include "./model/dungchung.php";

$successMessage = '';


if (isset($_POST['export_excel'])) {
    
    $conn = connectDB();
    if (!$conn) {
        die("Failed to connect to the database.");
    }
    exportExcelTotalOrdersByMonth($conn);
    mysqli_close($conn);
    $successMessage = 'Xuất Excel thành công.';
}
?>
<?php
$totalEmployees = getTotalEmployees();
$totalCustomers = getTotalCustomers();
$totalAccountTypes = getTotalAccountTypes();
$totalOrders = getTotalOrders();
$totalServices = getTotalServices();
$totalRevenue= calculateTotalRevenue();

// Display the counts in the HTML structure
?>



<div class="contenttk">
<div class="admin-page">
        <div class="dashboard-summary">
            <div class="summary-item">
                <div class="summary-label">NHÂN VIÊN</div>
                <i class="fas fa-user summary-icon"></i>
                <div class="summary-value"><?php echo $totalEmployees; ?></div>
            </div>
            <div class="summary-item">
                <div class="summary-label">KHÁCH HÀNG</div>
                <i class="fas fa-users summary-icon"></i>
                <div class="summary-value"><?php echo $totalCustomers; ?></div>
            </div>
            <div class="summary-item">
                <div class="summary-label">TÀI KHOẢN</div>
                <i class="fas fa-wallet summary-icon"></i>
                <div class="summary-value"><?php echo $totalAccountTypes; ?></div>
            </div>
            <div class="summary-item">
                <div class="summary-label">ĐƠN HÀNG</div>
                <i class="fas fa-shopping-cart summary-icon"></i>
                <div class="summary-value"><?php echo $totalOrders; ?></div>
            </div>
            <div class="summary-item">
                <div class="summary-label">DỊCH VỤ</div>
                <i class="fas fa-cogs summary-icon"></i>
                <div class="summary-value"><?php echo $totalServices; ?></div>
            </div>
            <div class="summary-item">
                <div class="summary-label">DOANH THU</div>
                <i class="fas fa-chart-bar summary-icon"></i>
                <div class="summary-value"><?php echo $totalRevenue ;  ?></div>
            </div>
        </div>
    </div>
    <div class="thongke-container">

    <div class="chart-container">
            <canvas id="orderChart" class="chart"></canvas>
            <h2 class="chart-title">Đơn Hàng Theo Tháng</h2>
    <form action="#" method="post">
    <button type="submit" name="export_excel">Export</button>
    </form>
    </div>
    
        <div class="chart-container">
            <canvas id="statusChart" class="chart"></canvas>
            <h2 class="chart-title">Trạng Thái Đơn Hàng</h2>
        </div>
        
        <script>
            // Lấy dữ liệu từ PHP để tạo biểu đồ
            var orderData = <?php echo json_encode(getOrderDataForChart()); ?>;
            var statusData = <?php echo json_encode(getStatusDataForChart()); ?>;

            // Tạo biểu đồ cột cho đơn hàng theo tháng
            var orderCtx = document.getElementById('orderChart').getContext('2d');
            var orderChart = new Chart(orderCtx, {
                type: 'bar',
                data: {
                    labels: orderData.months,
                    datasets: [{
                        label: 'Số Lượng Đơn Hàng',
                        data: orderData.orders,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Tạo biểu đồ tròn cho trạng thái đơn hàng
            var statusCtx = document.getElementById('statusChart').getContext('2d');
            var statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: statusData.labels,
                    datasets: [{
                        data: statusData.values,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                    }]
                }
            });
        </script>
    </div>
</div>
<style>
    .contenttk {
        width: 1300px;
        margin: 0 auto;
    }

    .thongke-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .chart-container {
        width: 49%;
        box-sizing: border-box;
        padding: 20px;
        /* border: 1px solid #ccc; */
        /* border-radius: 8px; */
        background-color: #fff;
        margin-bottom: 20px;
        height: 600px;
    }

    .chart {
        width: 100%;
        height: auto;
    }

    .chart-title {
        text-align: center;
        margin-top: 10px;
        color: #333;
    }
    
    button[name="export_excel"] {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin-left: 20px;
        text-decoration: none;
        background-color:rgba(75, 192, 192, 0.2); 
        border: 1px solid #4CAF50;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[name="export_excel"]:hover {
        background-color: #45a049; 
    }

</style>
