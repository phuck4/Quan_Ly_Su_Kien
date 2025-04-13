<?php
// Kiểm tra session (đã được kiểm tra trong index.php, nhưng để an toàn có thể giữ lại)
if (!isset($_SESSION['user']) || $_SESSION['user']['vaiTro'] !== 'Customer') {
    header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
    exit();
}

// Kiểm tra dữ liệu sự kiện và thanh toán
if (!isset($suKien) || !isset($thanhToan)) {
    echo "<script>alert('Không tìm thấy thông tin sự kiện!'); window.location.href='/Quan_Ly_Su_Kien/index.php?action=user';</script>";
    exit();
}

// Tính tổng tiền dựa trên loại sự kiện (nếu chưa có trong thanhToan)
$eventPrices = [
    1 => 15000000, // Hội nghị
    2 => 45000000, // Tiệc cưới
    3 => 5000000,  // Sinh nhật
    4 => 8500000,  // Workshop
    5 => 12000000, // Hội thảo
    6 => 20000000, // Team Building
    7 => 30000000, // Ra mắt sản phẩm
    8 => 10000000  // Khác
];
$tongTien = isset($thanhToan['tongTien']) ? $thanhToan['tongTien'] : ($eventPrices[$suKien['maLoai']] ?? 45000000);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thanh Toán</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .payment-status.text-warning {
            color: #ffc107 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/Quan_Ly_Su_Kien/index.php">
                <i class="fas fa-calendar-check me-2"></i>Quản lý Sự kiện
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Quan_Ly_Su_Kien/index.php?action=user">
                            <i class="fas fa-plus-circle me-1"></i>Đăng ký sự kiện
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Quan_Ly_Su_Kien/index.php?action=user#viewEvents">
                            <i class="fas fa-list me-1"></i>Sự kiện đã đăng ký
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-credit-card me-1"></i>Thanh toán
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="user-welcome me-2 text-white">
                        <i class="fas fa-user-circle me-1"></i>Xin chào, <?php echo htmlspecialchars($_SESSION['user']['tenDangNhap']); ?>
                    </span>
                    <a href="/Quan_Ly_Su_Kien/index.php?action=dangXuat" class="btn btn-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Nội dung thanh toán -->
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    <i class="fas fa-credit-card me-2"></i>Thanh toán sự kiện
                </h3>
            </div>
            <div class="card-body">
                <!-- Thông tin sự kiện -->
                <div class="alert alert-info mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Mã sự kiện:</strong> SK<?php echo htmlspecialchars($suKien['maSK']); ?></p>
                            <p class="mb-1"><strong>Tên sự kiện:</strong> <?php echo htmlspecialchars($suKien['tenSuKien']); ?></p>
                            <p class="mb-1"><strong>Thời gian:</strong> <?php echo htmlspecialchars($suKien['ngayBatDau'] . ' - ' . $suKien['ngayKetThuc']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Tổng số tiền:</strong> <?php echo number_format($tongTien); ?> VNĐ</p>
                            <p class="mb-1"><strong>Cần thanh toán:</strong> <?php echo number_format($tongTien / 2); ?> VNĐ</p>
                            <p class="mb-1"><strong>Trạng thái:</strong> <span class="payment-status text-warning"><?php echo htmlspecialchars($thanhToan['trangThaiThanhToan'] ?? 'Chưa thanh toán'); ?></span></p>
                        </div>
                    </div>
                </div>

                <!-- Progress bar -->
                <div class="mb-4">
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                </div>

                <!-- Phương thức thanh toán -->
                <h4 class="mb-4">
                    <i class="fas fa-wallet me-2"></i>Chọn phương thức thanh toán
                </h4>
                <form id="paymentForm" method="POST">
                    <input type="hidden" name="maSK" value="<?php echo htmlspecialchars($suKien['maSK']); ?>" />
                    <input type="hidden" name="tenNguoiDangKy" value="<?php echo htmlspecialchars($suKien['tenNguoiDangKy']); ?>" />
                    <input type="hidden" name="tongTien" value="<?php echo $tongTien; ?>" />
                    <div class="row">
                        <!-- Tiền mặt -->
                        <div class="col-md-6">
                            <div class="card border-primary mb-3">
                                <div class="card-header">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="cashMethod" value="Tiền mặt" checked />
                                        <label class="form-check-label" for="cashMethod">
                                            <i class="fas fa-money-bill-wave me-2"></i>Tiền mặt
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-map-marker-alt me-2"></i>Thanh toán trực tiếp
                                    </h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-building me-2"></i>Số 123 Đường ABC, Quận 1, TP.HCM</li>
                                        <li><i class="fas fa-clock me-2"></i>Thứ 2 - Thứ 6: 8:00 - 17:00</li>
                                        <li><i class="fas fa-phone me-2"></i>028 1234 5678</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Chuyển khoản -->
                        <div class="col-md-6">
                            <div class="card border-primary mb-3">
                                <div class="card-header">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="bankMethod" value="Chuyển khoản" />
                                        <label class="form-check-label" for="bankMethod">
                                            <i class="fas fa-university me-2"></i>Chuyển khoản
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><i class="fas fa-info-circle me-2"></i>Thông tin tài khoản</h5>
                                            <ul class="list-unstyled">
                                                <li>Ngân hàng: Vietcombank</li>
                                                <li>Số TK: 123456789</li>
                                                <li>Chủ TK: Công Ty XYZ</li>
                                                <li>Nội dung: SK<?php echo htmlspecialchars($suKien['maSK']); ?>_ABC</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <h5><i class="fas fa-qrcode me-2"></i>QR Code</h5>
                                            <img src="/Quan_Ly_Su_Kien/public/assets/images/QRcode.png" alt="QR Code" class="img-fluid mb-2" style="max-width: 150px;" />
                                            <p class="small text-muted">Quét mã để thanh toán</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nút hành động thanh toán -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-secondary btn-lg" id="cancelPayment">
                            <i class="fas fa-times me-2"></i>Hủy bỏ
                        </button>
                        <button type="submit" class="btn btn-success btn-lg" id="confirmPayment">
                            <i class="fas fa-check-circle me-2"></i>Xác nhận thanh toán
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Thanh toán thành công -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>Thanh toán thành công
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-check-circle text-success mb-4" style="font-size: 60px"></i>
                    <h4>Đã thanh toán thành công!</h4>
                    <p class="text-muted">Mã giao dịch: <span id="maGiaoDich">#PAY123456</span></p>
                </div>
                <div class="modal-footer">
                    <a href="/Quan_Ly_Su_Kien/index.php?action=user" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Xử lý form thanh toán
            $('#paymentForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn form submit mặc định

                $.ajax({
                    url: '/Quan_Ly_Su_Kien/index.php?action=xuLyThanhToan',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật mã giao dịch
                            $('#maGiaoDich').text(response.maGiaoDich);
                            // Hiển thị modal thành công
                            $('#successModal').modal('show');
                        } else {
                            alert('Thanh toán thất bại: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            });

            // Xử lý nút Hủy bỏ
            $('#cancelPayment').on('click', function() {
                if (confirm('Bạn có chắc muốn hủy thanh toán?')) {
                    window.location.href = '/Quan_Ly_Su_Kien/index.php?action=user';
                }
            });
        });
    </script>
</body>
</html>