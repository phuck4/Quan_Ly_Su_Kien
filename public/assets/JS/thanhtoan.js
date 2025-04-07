<<<<<<< HEAD
document.addEventListener("DOMContentLoaded", () => {
  // Xử lý chọn phương thức thanh toán
  const options = document.querySelectorAll(".payment-option");

  options.forEach((option) => {
    option.addEventListener("click", function () {
      options.forEach((opt) => opt.classList.remove("selected"));
      this.classList.add("selected");
    });
  });

  // Xử lý xác nhận thanh toán
  const confirmBtn = document.getElementById("confirmPayment");
  confirmBtn.addEventListener("click", function () {
    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

    setTimeout(() => {
      new bootstrap.Modal(document.getElementById("successModal")).show();
      this.innerHTML =
        '<i class="fas fa-check-circle me-2"></i>Xác nhận thanh toán';
    }, 2000);
  });

  // Hiệu ứng loading cho QR code
  const qr = document.querySelector(".qr-code");
  if (qr) {
    qr.addEventListener("load", () => {
      qr.style.opacity = "1";
    });
    qr.style.opacity = "0";
  }
});
=======
document.addEventListener("DOMContentLoaded", () => {
  // Xử lý chọn phương thức thanh toán
  const options = document.querySelectorAll(".payment-option");

  options.forEach((option) => {
    option.addEventListener("click", function () {
      options.forEach((opt) => opt.classList.remove("selected"));
      this.classList.add("selected");
    });
  });

  // Xử lý xác nhận thanh toán
  const confirmBtn = document.getElementById("confirmPayment");
  confirmBtn.addEventListener("click", function () {
    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

    setTimeout(() => {
      new bootstrap.Modal(document.getElementById("successModal")).show();
      this.innerHTML =
        '<i class="fas fa-check-circle me-2"></i>Xác nhận thanh toán';
    }, 2000);
  });

  // Hiệu ứng loading cho QR code
  const qr = document.querySelector(".qr-code");
  if (qr) {
    qr.addEventListener("load", () => {
      qr.style.opacity = "1";
    });
    qr.style.opacity = "0";
  }
});
>>>>>>> 923f71330b0d1a3a553fc695c5da77ba6ebea7f5
