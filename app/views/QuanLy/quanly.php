<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hệ thống Quản lý Thanh toán</title>
  <!-- Bootstrap CSS (tùy chọn, dùng để tối ưu giao diện) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Quan_Ly_Su_Kien/public/assets/CSS/quanly.css">
  
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
          <span>Admin</span>
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
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Đã thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody id="paymentData">
                  <!-- Dữ liệu sẽ được load bằng JavaScript -->
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

  <!-- Bootstrap JS Bundle (bao gồm Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="/public/assets/JS/quanly.js"></script>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hệ thống Quản lý Sự kiện</title>
    <link rel="stylesheet" href="/public/assets/CSS/quanly.css" />
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
            <a href="#" class="active" id="dashboardLink">
              <i>📊</i>
              <span>Tổng quan</span>
            </a>
          </li>
          <li>
            <a href="#" id="eventLink">
              <i>📅</i>
              <span>Sự kiện</span>
            </a>
          </li>
          <li>
            <a href="#" id="paymentLink">
              <i>💰</i>
              <span>Thanh toán</span>
            </a>
          </li>
          <li>
            <a href="#" id="analyticsLink">
              <i>📈</i>
              <span>Thống kê</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i>⚙️</i>
              <span>Cài đặt</span>
            </a>
          </li>
        </ul>
      </aside>

      <!-- Main Content -->
      <main class="main-content">
        <div class="header">
          <h1>Hệ thống Quản lý Sự kiện</h1>
          <div class="user-info">
            <img src="/api/placeholder/40/40" alt="Avatar" />
            <span>Admin</span>
          </div>
        </div>

        <!-- Dashboard Section -->
        <section id="dashboardSection">
          <div class="stats-container">
            <div class="stat-card">
              <h3>Tổng số sự kiện</h3>
              <div class="value">152</div>
              <div class="change positive">+12% so với tháng trước</div>
            </div>
            <div class="stat-card">
              <h3>Tổng doanh thu</h3>
              <div class="value">125.6M VND</div>
              <div class="change positive">+8% so với tháng trước</div>
            </div>
            <div class="stat-card">
              <h3>Sự kiện chưa thanh toán</h3>
              <div class="value">28</div>
              <div class="change negative">+5% so với tháng trước</div>
            </div>
            <div class="stat-card">
              <h3>Khách hàng VIP</h3>
              <div class="value">36</div>
              <div class="change positive">+15% so với tháng trước</div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Sự kiện sắp tới</h2>
              <button class="btn btn-primary" id="addEventBtn">Thêm sự kiện</button>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên sự kiện</th>
                    <th>Ngày</th>
                    <th>Khách hàng</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#SK001</td>
                    <td>Hội nghị Doanh nghiệp 2025</td>
                    <td>12/04/2025</td>
                    <td>
                      Công ty ABC <span class="badge badge-info">VIP</span>
                    </td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK002</td>
                    <td>Tiệc cưới Anh Nguyễn &amp; Chị Minh</td>
                    <td>15/04/2025</td>
                    <td>Gia đình Anh Nguyễn</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-danger">Chưa thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK003</td>
                    <td>Khai trương Chi nhánh XYZ</td>
                    <td>20/04/2025</td>
                    <td>
                      Công ty XYZ <span class="badge badge-info">VIP</span>
                    </td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK004</td>
                    <td>Hội thảo Công nghệ</td>
                    <td>25/04/2025</td>
                    <td>Học viện Tech</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK005</td>
                    <td>Tiệc Sinh nhật</td>
                    <td>30/04/2025</td>
                    <td>Chị Lan</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-danger">Chưa thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Event Management Section -->
        <section id="eventSection">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Quản lý Sự kiện</h2>
              <button class="btn btn-primary" id="addEventBtn2">Thêm sự kiện</button>
            </div>
            <div class="toolbar">
              <div class="search-box">
                <input type="text" placeholder="Tìm kiếm sự kiện..." />
                <button>🔍</button>
              </div>
              <div>
                <select class="form-control" aria-label="trangThai">
                  <option>Tất cả trạng thái</option>
                  <option>Đang chuẩn bị</option>
                  <option>Đang diễn ra</option>
                  <option>Đã hoàn thành</option>
                  <option>Đã hủy</option>
                </select>
              </div>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên sự kiện</th>
                    <th>Ngày</th>
                    <th>Khách hàng</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#SK001</td>
                    <td>Hội nghị Doanh nghiệp 2025</td>
                    <td>12/04/2025</td>
                    <td>
                      Công ty ABC <span class="badge badge-info">VIP</span>
                    </td>
                    <td>Hội nghị</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                      <button class="btn btn-success btn-sm">Xác nhận</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK002</td>
                    <td>Tiệc cưới Anh Nguyễn &amp; Chị Minh</td>
                    <td>15/04/2025</td>
                    <td>Gia đình Anh Nguyễn</td>
                    <td>Tiệc cưới</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-danger">Chưa thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                      <button class="btn btn-success btn-sm">Xác nhận</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK003</td>
                    <td>Khai trương Chi nhánh XYZ</td>
                    <td>20/04/2025</td>
                    <td>
                      Công ty XYZ <span class="badge badge-info">VIP</span>
                    </td>
                    <td>Khai trương</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                      <button class="btn btn-success btn-sm">Xác nhận</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK004</td>
                    <td>Hội thảo Công nghệ</td>
                    <td>25/04/2025</td>
                    <td>Học viện Tech</td>
                    <td>Hội thảo</td>
                    <td>
                      <span class="badge badge-warning">Đang chuẩn bị</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                      <button class="btn btn-success btn-sm">Xác nhận</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK006</td>
                    <td>Hội nghị Khách hàng</td>
                    <td>05/03/2025</td>
                    <td>Công ty DEF</td>
                    <td>Hội nghị</td>
                    <td>
                      <span class="badge badge-success">Đã hoàn thành</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK007</td>
                    <td>Sinh nhật 18 tuổi</td>
                    <td>10/03/2025</td>
                    <td>Gia đình Anh Hải</td>
                    <td>Tiệc sinh nhật</td>
                    <td>
                      <span class="badge badge-success">Đã hoàn thành</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                  <tr>
                    <td>#SK008</td>
                    <td>Workshop Marketing</td>
                    <td>15/03/2025</td>
                    <td>
                      Công ty GHI <span class="badge badge-info">VIP</span>
                    </td>
                    <td>Workshop</td>
                    <td>
                      <span class="badge badge-success">Đã hoàn thành</span>
                    </td>
                    <td>
                      <span class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm">Chi tiết</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="pagination">
              <button>Trước</button>
              <button class="active">1</button>
              <button>2</button>
              <button>3</button>
              <button>Sau</button>
            </div>
          </div>
        </section>

        <!-- Payment Section -->
        <section id="paymentSection">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Quản lý Thanh toán</h2>
              <button class="btn btn-primary">Xuất báo cáo</button>
            </div>
            <div class="toolbar">
              <div class="search-box">
                <input type="text" placeholder="Tìm kiếm thanh toán..." />
                <button>🔍</button>
              </div>
              <div>
                <select class="form-control" aria-label="trangThaiThanhToan">
                  <option>Tất cả trạng thái</option>
                  <option>Đã thanh toán</option>
                  <option>Chưa thanh toán</option>
                  <option>Đã hoàn tiền</option>
                </select>
              </div>
            </div>
            <!-- Các tab hiển thị dữ liệu thanh toán -->
            <div class="tabs">
              <div class="tab-item active" data-tab="allPayments">Tất cả</div>
              <div class="tab-item" data-tab="pendingPayments">Chưa thanh toán</div>
              <div class="tab-item" data-tab="completedPayments">Đã thanh toán</div>
            </div>
            <div class="tab-content active" id="allPayments">
              <div class="table-container">
                <table>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Sự kiện</th>
                      <th>Khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Đã thanh toán</th>
                      <th>Còn lại</th>
                      <th>Trạng thái</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#TT001</td>
                      <td>Hội nghị Doanh nghiệp 2025</td>
                      <td>
                        Công ty ABC <span class="badge badge-info">VIP</span>
                      </td>
                      <td>50,000,000 VND</td>
                      <td>50,000,000 VND</td>
                      <td>0 VND</td>
                      <td>
                        <span class="badge badge-success">Đã thanh toán</span>
                      </td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT002</td>
                      <td>Tiệc cưới Anh Nguyễn &amp; Chị Minh</td>
                      <td>Gia đình Anh Nguyễn</td>
                      <td>35,000,000 VND</td>
                      <td>10,000,000 VND</td>
                      <td>25,000,000 VND</td>
                      <td>
                        <span class="badge badge-danger">Chưa thanh toán</span>
                      </td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-warning btn-sm">Nhắc nhở</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT003</td>
                      <td>Khai trương Chi nhánh XYZ</td>
                      <td>
                        Công ty XYZ <span class="badge badge-info">VIP</span>
                      </td>
                      <td>45,000,000 VND</td>
                      <td>45,000,000 VND</td>
                      <td>0 VND</td>
                      <td>
                        <span class="badge badge-success">Đã thanh toán</span>
                      </td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT004</td>
                      <td>Hội thảo Công nghệ</td>
                      <td>Học viện Tech</td>
                      <td>30,000,000 VND</td>
                      <td>30,000,000 VND</td>
                      <td>0 VND</td>
                      <td>
                        <span class="badge badge-success">Đã thanh toán</span>
                      </td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT005</td>
                      <td>Tiệc Sinh nhật</td>
                      <td>Chị Lan</td>
                      <td>20,000,000 VND</td>
                      <td>5,000,000 VND</td>
                      <td>15,000,000 VND</td>
                      <td>
                        <span class="badge badge-danger">Chưa thanh toán</span>
                      </td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-warning btn-sm">Nhắc nhở</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-content" id="pendingPayments">
              <div class="table-container">
                <table>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Sự kiện</th>
                      <th>Khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Đã thanh toán</th>
                      <th>Còn lại</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#TT002</td>
                      <td>Tiệc cưới Anh Nguyễn &amp; Chị Minh</td>
                      <td>Gia đình Anh Nguyễn</td>
                      <td>35,000,000 VND</td>
                      <td>10,000,000 VND</td>
                      <td>25,000,000 VND</td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-warning btn-sm">Nhắc nhở</button>
                        <button class="btn btn-success btn-sm">Cập nhật</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT005</td>
                      <td>Tiệc Sinh nhật</td>
                      <td>Chị Lan</td>
                      <td>20,000,000 VND</td>
                      <td>5,000,000 VND</td>
                      <td>15,000,000 VND</td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-warning btn-sm">Nhắc nhở</button>
                        <button class="btn btn-success btn-sm">Cập nhật</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-content" id="completedPayments">
              <div class="table-container">
                <table>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Sự kiện</th>
                      <th>Khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Ngày thanh toán</th>
                      <th>Phương thức</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#TT001</td>
                      <td>Hội nghị Doanh nghiệp 2025</td>
                      <td>
                        Công ty ABC <span class="badge badge-info">VIP</span>
                      </td>
                      <td>50,000,000 VND</td>
                      <td>01/04/2025</td>
                      <td>Chuyển khoản</td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-info btn-sm">Hóa đơn</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT003</td>
                      <td>Khai trương Chi nhánh XYZ</td>
                      <td>
                        Công ty XYZ <span class="badge badge-info">VIP</span>
                      </td>
                      <td>45,000,000 VND</td>
                      <td>28/03/2025</td>
                      <td>Chuyển khoản</td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-info btn-sm">Hóa đơn</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#TT004</td>
                      <td>Hội thảo Công nghệ</td>
                      <td>Học viện Tech</td>
                      <td>30,000,000 VND</td>
                      <td>25/03/2025</td>
                      <td>Chuyển khoản</td>
                      <td>
                        <button class="btn btn-primary btn-sm">Chi tiết</button>
                        <button class="btn btn-info btn-sm">Hóa đơn</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>

        <!-- Analytics Section -->
        <section id="analyticsSection">
          <div class="stats-container">
            <div class="stat-card">
              <h3>Tổng doanh thu năm 2025</h3>
              <div class="value">352.5M VND</div>
              <div class="change positive">+22% so với cùng kỳ năm trước</div>
            </div>
            <div class="stat-card">
              <h3>Tổng số sự kiện năm 2025</h3>
              <div class="value">48</div>
              <div class="change positive">+15% so với cùng kỳ năm trước</div>
            </div>
            <div class="stat-card">
              <h3>Khách hàng VIP</h3>
              <div class="value">36</div>
              <div class="change positive">+20% so với cùng kỳ năm trước</div>
            </div>
            <div class="stat-card">
              <h3>Doanh thu trung bình/sự kiện</h3>
              <div class="value">7.3M VND</div>
              <div class="change positive">+5% so với cùng kỳ năm trước</div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Thống kê doanh thu</h2>
              <select class="form-control" aria-label="Chọn sản phẩm">
                <option>Năm 2025</option>
                <option>Năm 2024</option>
                <option>Năm 2023</option>
              </select>
            </div>
            <div class="chart-container">
              <canvas id="revenueChart"></canvas>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Thống kê theo loại sự kiện</h2>
            </div>
            <div class="chart-container">
              <canvas id="eventTypeChart"></canvas>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Thống kê khách hàng</h2>
            </div>
            <div class="tabs">
              <div class="tab-item active" data-tab="customerRevenue">Doanh thu</div>
              <div class="tab-item" data-tab="customerType">Loại khách hàng</div>
            </div>
            <div class="tab-content active" id="customerRevenue">
              <div class="chart-container">
                <canvas id="customerRevenueChart"></canvas>
              </div>
            </div>
            <div class="tab-content" id="customerType">
              <div class="chart-container">
                <canvas id="customerTypeChart"></canvas>
              </div>
              <div class="table-container">
                <table>
                  <thead>
                    <tr>
                      <th>Loại khách hàng</th>
                      <th>Số lượng</th>
                      <th>Tổng doanh thu</th>
                      <th>% Doanh thu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Khách hàng VIP</td>
                      <td>36</td>
                      <td>210.5M VND</td>
                      <td>59.7%</td>
                    </tr>
                    <tr>
                      <td>Khách hàng thường</td>
                      <td>86</td>
                      <td>142.0M VND</td>
                      <td>40.3%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>

        <!-- Add Event Modal -->
        <div class="modal" id="addEventModal">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Thêm sự kiện mới</h3>
              <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
              <form id="addEventForm">
                <div class="form-group">
                  <label for="eventName">Tên sự kiện</label>
                  <input type="text" id="eventName" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="eventDate">Ngày</label>
                  <input type="date" id="eventDate" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="eventCustomer">Khách hàng</label>
                  <input type="text" id="eventCustomer" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="eventTypeModal">Loại sự kiện</label>
                  <select id="eventTypeModal" class="form-control" required>
                    <option value="">Chọn loại sự kiện</option>
                    <option value="hoinghi">Hội nghị</option>
                    <option value="tiec_cuoi">Tiệc cưới</option>
                    <option value="khai_truong">Khai trương</option>
                    <option value="hoi_thao">Hội thảo</option>
                    <option value="sinh_nhat">Tiệc sinh nhật</option>
                    <option value="workshop">Workshop</option>
                    <option value="khac">Khác</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="eventTotal">Tổng tiền</label>
                  <input type="number" id="eventTotal" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="eventPaid">Đã thanh toán</label>
                  <input type="number" id="eventPaid" class="form-control" required />
                </div>
                <div class="form-group">
                  <label for="eventStatus">Trạng thái</label>
                  <select id="eventStatus" class="form-control" required>
                    <option value="pending">Đang chuẩn bị</option>
                    <option value="in_progress">Đang diễn ra</option>
                    <option value="completed">Đã hoàn thành</option>
                    <option value="canceled">Đã hủy</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="customerTypeModal">Loại khách hàng</label>
                  <select id="customerTypeModal" class="form-control" required>
                    <option value="regular">Khách thường</option>
                    <option value="vip">Khách VIP</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" id="closeModal">Hủy</button>
              <button class="btn btn-primary" id="saveEventBtn">Lưu</button>
            </div>
          </div>
        </div>
      </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  </body>
</html>