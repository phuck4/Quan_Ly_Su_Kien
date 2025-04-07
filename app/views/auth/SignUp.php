<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Ký</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        height: 100vh;
      }

      .form-container {
        width: 400px;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      }

      .form-control:focus {
        border-color: #764ba2;
        box-shadow: 0 0 5px rgba(118, 75, 162, 0.5);
      }

      .btn-dark:hover {
        background-color: #5a3e8a;
        border-color: #5a3e8a;
      }
    </style>
  </head>
  <body class="d-flex justify-content-center align-items-center vh-100">
    <div class="form-container">
      <h2 class="text-center mb-4">Đăng Ký</h2>
      <form>
        <div class="mb-3">
          <label for="reg-username" class="form-label">Tên đăng nhập:</label>
          <input
            type="text"
            id="reg-username"
            class="form-control"
            placeholder="Nhập tên đăng nhập"
            required
          />
        </div>
        <div class="mb-3">
          <label for="reg-password" class="form-label">Mật khẩu:</label>
          <input
            type="password"
            id="reg-password"
            class="form-control"
            placeholder="Nhập mật khẩu"
            required
          />
        </div>
        <div class="mb-3">
          <label for="reg-confirm-password" class="form-label"
            >Xác nhận mật khẩu:</label
          >
          <input
            type="password"
            id="reg-confirm-password"
            class="form-control"
            placeholder="Nhập lại mật khẩu"
            required
          />
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-dark">Đăng ký</button>
        </div>
        <p class="text-center mt-3">
          Đã có tài khoản?
          <a href="#" class="text-decoration-none" style="color: #764ba2"
            >Đăng nhập</a
          >
        </p>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
