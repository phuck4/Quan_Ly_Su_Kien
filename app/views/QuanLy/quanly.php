<?php
// Kiểm tra session (đã được kiểm tra trong index.php, nhưng để an toàn có thể giữ lại)
if (!isset($_SESSION['user']) || $_SESSION['user']['vaiTro'] !== 'Admin') {
    header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Trang Quản Lý</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/Quan_Ly_Su_Kien/public/assets/css/quanly.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <aside class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="sidebar-header text-white p-3">
                    <h2>Quản lý Sự kiện</h2>
                </div>
                <ul class="sidebar-menu list-unstyled p-3">
                    <li>
                        <a href="#" id="paymentLink" class="active text-white d-block p-2">
                            <i>💰</i>
                            <span>Quản lý Thanh toán</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="exportLink" class="text-white d-block p-2">
                            <i>📤</i>
                            <span>Xuất báo cáo</span>
                        </a>
                    </li>
                    <li>
                        <a href="/Quan_Ly_Su_Kien/index.php?action=dangXuat" class="text-white d-block p-2">
                            <i>🚪</i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="header d-flex justify-content-between align-items-center py-3 border-bottom">
                    <h1>Hệ thống Quản lý Thanh toán</h1>
                    <div class="user-info d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Avatar" class="rounded-circle me-2">
                        <span><?php echo htmlspecialchars($_SESSION['user']['tenDangNhap']); ?></span>
                    </div>
                </div>

                <!-- Payment Management Section -->
                <section id="paymentSection" class="mt-4">
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
                                        <?php if (!empty($thanhToanList)): ?>
                                            <?php foreach ($thanhToanList as $thanhToan): ?>
                                                <tr>
                                                    <td>SK<?php echo htmlspecialchars($thanhToan['maSK']); ?></td>
                                                    <td><?php echo htmlspecialchars($thanhToan['tenSuKien']); ?></td>
                                                    <td><?php echo htmlspecialchars($thanhToan['tenLoai']); ?></td>
                                                    <td><?php echo htmlspecialchars($thanhToan['tenNguoiDangKy']); ?></td>
                                                    <td><?php echo number_format($thanhToan['tongTien']); ?> VNĐ</td>
                                                    <td><?php echo htmlspecialchars($thanhToan['trangThaiThanhToan']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Không có thanh toán nào.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination mt-3">
                                <button class="btn btn-secondary" onclick="changePage(-1)">Trước</button>
                                <span id="currentPage">1</span>
                                <button class="btn btn-secondary" onclick="changePage(1)">Sau</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
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

    <script src="/Quan_Ly_Su_Kien/public/assets/JS/quanly.js"></script>
</body>
</html>