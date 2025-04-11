<?php
session_start();
require_once __DIR__ . '/../../controllers/ThanhToanController.php';
require_once __DIR__ . '/../../config/database.php';

$thanhToanController = new ThanhToanController($conn);
$thanhToanList = $thanhToanController->layTatCaThanhToan();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <!-- Giữ nguyên phần head -->
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Quản lý Sự kiện</h2>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="#" id="paymentLink" class="active">
                        <i>💰</i>
                        <span>Quản lý Thanh toán</span>
                    </a>
                </li>
                <li>
                    <a href="#" id="exportLink">
                        <i>📤</i>
                        <span>Xuất báo cáo</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Hệ thống Quản lý Thanh toán</h1>
                <div class="user-info d-flex align-items-center">
                    <img src="/api/placeholder/40/40" alt="Avatar" class="rounded-circle me-2">
                    <span><?php echo $_SESSION['user']['tenDangNhap']; ?></span>
                </div>
            </div>

            <!-- Payment Management Section -->
            <section id="paymentSection">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title mb-0">Danh sách Thanh toán</h2>
                        <div class="toolbar d-flex gap-2">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm...">
                                <button class="btn btn-outline-secondary" onclick="loadPayments()">🔍</button>
                            </div>
                            <select id="filterStatus" class="form-select" onchange="loadPayments()">
                                <option value="all">Tất cả trạng thái</option>
                                <option value="paid">Đã thanh toán</option>
                                <option value="unpaid">Chưa thanh toán</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <table id="paymentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã sự kiện</th>
                                        <th>Tên sự kiện</th>
                                        <th>Loại sự kiện</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody id="paymentData">
                                    <?php foreach ($thanhToanList as $thanhToan): ?>
                                        <tr>
                                            <td>SK<?php echo $thanhToan['maSK']; ?></td>
                                            <td><?php echo $thanhToan['tenSuKien']; ?></td>
                                            <td><?php echo $thanhToan['tenLoai']; ?></td>
                                            <td><?php echo $thanhToan['tenNguoiDangKy']; ?></td>
                                            <td><?php echo number_format($thanhToan['tongTien']); ?> VNĐ</td>
                                            <td><?php echo $thanhToan['trangThaiThanhToan']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            <button class="btn btn-secondary" onclick="changePage(-1)">Trước</button>
                            <span id="currentPage">1</span>
                            <button class="btn btn-secondary" onclick="changePage(1)">Sau</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal hiển thị chi tiết thanh toán -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Chi tiết Thanh toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Nội dung chi tiết sẽ được load -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Quan_Ly_Su_Kien/public/assets/JS/quanly.js"></script>
</body>
</html>