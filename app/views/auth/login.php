<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng Nhập</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Liên kết đến file CSS -->
    <link rel="stylesheet" href="/Quan_Ly_Su_Kien/public/assets/CSS/phanquyen.css" />
    <!-- Liên kết Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Liên kết Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-3">
        <!-- Form khách hàng -->
        <div class="form-customer active"> <!-- Thêm class active để hiển thị mặc định -->
            <!-- Chỉ gắn sự kiện onclick vào tiêu đề h2 để toggle form -->
            <h2 onclick="toggleForm('customer')">Khách hàng</h2>
            <div class="customer">
                <!-- Form đăng nhập cho khách hàng, gửi dữ liệu đến AuthController -->
                <form action="/Quan_Ly_Su_Kien/index.php?action=dangNhap" method="POST">
                    <!-- Input ẩn để gửi vai trò là Customer -->
                    <input type="hidden" name="vaiTro" value="Customer">
                    <div class="mb-3 mt-3">
                        <label for="emailCustomer">Email:</label>
                        <!-- Input email với name="email" để backend nhận dữ liệu -->
                        <input type="email" class="form-control" id="emailCustomer" placeholder="Enter email" name="email" required />
                    </div>
                    <div class="mb-3">
                        <label for="pwdCustomer">Password:</label>
                        <!-- Input mật khẩu với name="pswd" để backend nhận dữ liệu -->
                        <input type="password" class="form-control" id="pwdCustomer" placeholder="Enter password" name="pswd" required />
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" /> Remember me
                        </label>
                    </div>
                    <!-- Nút submit để gửi form -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Form quản lý -->
        <div class="form-admin">
            <!-- Chỉ gắn sự kiện onclick vào tiêu đề h2 để toggle form -->
            <h2 onclick="toggleForm('admin')">Quản Lý</h2>
            <div class="admin">
                <!-- Form đăng nhập cho quản lý, gửi dữ liệu đến AuthController -->
                <form action="/Quan_Ly_Su_Kien/index.php?action=dangNhap" method="POST">
                    <!-- Input ẩn để gửi vai trò là Admin -->
                    <input type="hidden" name="vaiTro" value="Admin">
                    <div class="mb-3 mt-3">
                        <label for="emailAdmin">Email:</label>
                        <!-- Input email với name="email" để backend nhận dữ liệu -->
                        <input type="email" class="form-control" id="emailAdmin" placeholder="Enter email" name="email" required />
                    </div>
                    <div class="mb-3">
                        <label for="pwdAdmin">Password:</label>
                        <!-- Input mật khẩu với name="pswd" để backend nhận dữ liệu -->
                        <input type="password" class="form-control" id="pwdAdmin" placeholder="Enter password" name="pswd" required />
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" /> Remember me
                        </label>
                    </div>
                    <!-- Nút submit để gửi form -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script để toggle form khách hàng/quản lý -->
    <script>
        function toggleForm(formType) {
            // Lấy các phần tử form
            var customerForm = document.querySelector(".form-customer");
            var adminForm = document.querySelector(".form-admin");

            // Nếu nhấp vào "Khách hàng"
            if (formType === 'customer') {
                customerForm.classList.add("active"); // Hiển thị form khách hàng
                adminForm.classList.remove("active"); // Ẩn form quản lý
            }
            // Nếu nhấp vào "Quản Lý"
            else if (formType === 'admin') {
                adminForm.classList.add("active"); // Hiển thị form quản lý
                customerForm.classList.remove("active"); // Ẩn form khách hàng
            }
        }
    </script>
</body>
</html>