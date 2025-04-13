<?php
// Kiểm tra session (đã được kiểm tra trong index.php, nhưng để an toàn có thể giữ lại)
if (!isset($_SESSION['user']) || $_SESSION['user']['vaiTro'] !== 'Customer') {
    header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Trang Người Dùng</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/Quan_Ly_Su_Kien/public/assets/css/user.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-calendar-check me-2"></i>Quản lý Sự kiện
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#viewEvents">
                            <i class="fas fa-list me-1"></i> Sự kiện đã đăng ký
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="user-welcome text-white me-3">
                        <i class="fas fa-user-circle me-1"></i> Xin chào, <?php echo htmlspecialchars($_SESSION['user']['tenDangNhap']); ?>
                    </span>
                    <a href="/Quan_Ly_Su_Kien/index.php?action=dangXuat" class="btn btn-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container mt-4">
        <div class="tab-content">
            <!-- Đăng ký sự kiện -->
            <div class="tab-pane fade show active" id="registerEvent">
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade" id="successAlert" role="alert" style="display: none;">
                        <i class="fas fa-check-circle me-2"></i> Đăng ký sự kiện thành công! Bạn sẽ được chuyển đến trang thanh toán.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade" id="errorAlert" role="alert" style="display: none;">
                        <i class="fas fa-exclamation-circle me-2"></i> <span id="errorMessage"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Đăng ký sự kiện mới</h5>
                        </div>
                        <div class="card-body">
                            <form id="eventRegistrationForm" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tên người đăng ký</label>
                                        <input type="text" name="tenNguoiDangKy" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="tel" name="soDienThoai" class="form-control" pattern="[0-9]{10}" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nơi tổ chức</label>
                                        <input type="text" name="diaDiem" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tên sự kiện</label>
                                        <input type="text" name="tenSuKien" class="form-control" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Thời gian bắt đầu</label>
                                        <input type="datetime-local" name="ngayBatDau" class="form-control" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Thời gian kết thúc</label>
                                        <input type="datetime-local" name="ngayKetThuc" class="form-control" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Loại sự kiện</label>
                                        <select name="maLoai" class="form-select" id="eventType" required>
                                            <option value="">-- Chọn loại sự kiện --</option>
                                            <option value="1" data-price="15000000">Hội nghị</option>
                                            <option value="2" data-price="45000000">Tiệc cưới</option>
                                            <option value="3" data-price="5000000">Sinh nhật</option>
                                            <option value="4" data-price="8500000">Workshop</option>
                                            <option value="5" data-price="12000000">Hội thảo</option>
                                            <option value="6" data-price="20000000">Team Building</option>
                                            <option value="7" data-price="30000000">Ra mắt sản phẩm</option>
                                            <option value="8" data-price="10000000">Khác</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số lượng người tham dự (dự kiến)</label>
                                        <input type="number" name="soNguoiThamGia" class="form-control" id="attendees" min="1" required />
                                    </div>
                                </div>
                                <div class="mb-3" id="priceInfoContainer" style="display: none">
                                    <div class="alert alert-info">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Chi phí dự kiến:</h6>
                                                <p class="mb-0" id="priceDetails">
                                                    Giá cơ bản: <span id="basePrice">0</span> VNĐ
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="mb-0 text-primary" id="totalPrice">0 VNĐ</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mô tả chi tiết sự kiện</label>
                                    <textarea name="moTaChiTietSuKien" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="reset" class="btn btn-light"><i class="fas fa-redo me-1"></i> Làm mới</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Đăng ký sự kiện</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Xem sự kiện đã đăng ký -->
            <div class="tab-pane fade" id="viewEvents">
                <div class="container">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Danh sách sự kiện đã đăng ký</h5>
                            <select class="form-select form-select-sm" aria-label="DSSK">
                                <option value="all">Tất cả sự kiện</option>
                                <option value="pending">Chờ xác nhận</option>
                                <option value="confirmed">Đã xác nhận</option>
                                <option value="completed">Đã hoàn thành</option>
                                <option value="canceled">Đã hủy</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Mã sự kiện</th>
                                            <th>Tên sự kiện</th>
                                            <th>Loại</th>
                                            <th>Thời gian</th>
                                            <th>Địa điểm</th>
                                            <th>Giá</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($suKienList)): ?>
                                            <?php foreach ($suKienList as $suKien): ?>
                                                <tr>
                                                    <td>SK<?php echo htmlspecialchars($suKien['maSK']); ?></td>
                                                    <td><?php echo htmlspecialchars($suKien['tenSuKien'] ?? 'Không có tên'); ?></td>
                                                    <td><?php echo htmlspecialchars($suKien['maLoai']); ?></td>
                                                    <td><?php echo htmlspecialchars($suKien['ngayBatDau'] . ' - ' . $suKien['ngayKetThuc']); ?></td>
                                                    <td><?php echo htmlspecialchars($suKien['diaDiem']); ?></td>
                                                    <td>Chưa có</td>
                                                    <td><span class="event-status status-pending">Chờ xác nhận</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#eventDetailModal">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Không có sự kiện nào.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#eventRegistrationForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn form submit mặc định

                $.ajax({
                    url: '/Quan_Ly_Su_Kien/index.php?action=dangKySuKien',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Hiển thị thông báo thành công
                            $('#successAlert').addClass('show').css('display', 'block');
                            // Chuyển hướng sau 2 giây
                            setTimeout(function() {
                                window.location.href = '/Quan_Ly_Su_Kien/app/views/ThanhToan/thanhtoan.php?maSK=' + response.maSK;
                            }, 2000);
                        } else {
                            // Hiển thị thông báo lỗi
                            $('#errorMessage').text(response.message);
                            $('#errorAlert').addClass('show').css('display', 'block');
                        }
                    },
                    error: function() {
                        // Hiển thị thông báo lỗi nếu AJAX thất bại
                        $('#errorMessage').text('Có lỗi xảy ra. Vui lòng thử lại.');
                        $('#errorAlert').addClass('show').css('display', 'block');
                    }
                });
            });
        });
    </script>
</body>
</html>