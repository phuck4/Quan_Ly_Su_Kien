<<<<<<< HEAD
// JavaScript để xử lý các tính năng
document.addEventListener("DOMContentLoaded", function () {
  // 1. Xử lý hiển thị giá khi chọn loại sự kiện
  const eventTypeSelect = document.getElementById("eventType");
  const priceInfoContainer = document.getElementById("priceInfoContainer");
  const basePriceElement = document.getElementById("basePrice");
  const totalPriceElement = document.getElementById("totalPrice");
  const attendeesInput = document.getElementById("attendees");

  // Hàm định dạng số tiền
  function formatPrice(price) {
    return new Intl.NumberFormat("vi-VN").format(price);
  }

  // Cập nhật giá khi chọn loại sự kiện
  function updatePrice() {
    const selectedOption =
      eventTypeSelect.options[eventTypeSelect.selectedIndex];
    const basePrice = selectedOption.dataset.price
      ? parseInt(selectedOption.dataset.price)
      : 0;
    const attendees = parseInt(attendeesInput.value) || 0;

    if (basePrice > 0) {
      // Hiển thị thông tin giá
      priceInfoContainer.style.display = "block";
      basePriceElement.textContent = formatPrice(basePrice);

      // Tính tổng giá (đơn giản hóa, có thể thêm logic phức tạp hơn)
      const totalPrice = basePrice;
      totalPriceElement.textContent = formatPrice(totalPrice) + " VNĐ";
    } else {
      priceInfoContainer.style.display = "none";
    }
  }

  // Thêm event listeners
  eventTypeSelect.addEventListener("change", updatePrice);
  attendeesInput.addEventListener("input", updatePrice);

  // 2. Xử lý đăng ký sự kiện và chuyển đến trang thanh toán
  const eventForm = document.getElementById("eventRegistrationForm");
  const successAlert = document.getElementById("successAlert");

  eventForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Hiển thị thông báo thành công
    successAlert.classList.add("show");

    // Sau 2 giây chuyển sang tab thanh toán
    setTimeout(function () {
      // Cập nhật thông tin thanh toán
      document.getElementById("paymentEventName").textContent =
        "Sự kiện mới đăng ký";
      document.getElementById("paymentTotalAmount").textContent =
        totalPriceElement.textContent;
      document.getElementById("paymentAmount").textContent =
        formatPrice(
          parseInt(totalPriceElement.textContent.replace(/[^\d]/g, "")) / 2
        ) + " VNĐ";

      // Chuyển sang tab thanh toán
      document.querySelector('a[data-bs-target="#payment"]').click();
    }, 2000);
  });
});
=======
// JavaScript để xử lý các tính năng
document.addEventListener("DOMContentLoaded", function () {
  // 1. Xử lý hiển thị giá khi chọn loại sự kiện
  const eventTypeSelect = document.getElementById("eventType");
  const priceInfoContainer = document.getElementById("priceInfoContainer");
  const basePriceElement = document.getElementById("basePrice");
  const totalPriceElement = document.getElementById("totalPrice");
  const attendeesInput = document.getElementById("attendees");

  // Hàm định dạng số tiền
  function formatPrice(price) {
    return new Intl.NumberFormat("vi-VN").format(price);
  }

  // Cập nhật giá khi chọn loại sự kiện
  function updatePrice() {
    const selectedOption =
      eventTypeSelect.options[eventTypeSelect.selectedIndex];
    const basePrice = selectedOption.dataset.price
      ? parseInt(selectedOption.dataset.price)
      : 0;
    const attendees = parseInt(attendeesInput.value) || 0;

    if (basePrice > 0) {
      // Hiển thị thông tin giá
      priceInfoContainer.style.display = "block";
      basePriceElement.textContent = formatPrice(basePrice);

      // Tính tổng giá (đơn giản hóa, có thể thêm logic phức tạp hơn)
      const totalPrice = basePrice;
      totalPriceElement.textContent = formatPrice(totalPrice) + " VNĐ";
    } else {
      priceInfoContainer.style.display = "none";
    }
  }

  // Thêm event listeners
  eventTypeSelect.addEventListener("change", updatePrice);
  attendeesInput.addEventListener("input", updatePrice);

  // 2. Xử lý đăng ký sự kiện và chuyển đến trang thanh toán
  const eventForm = document.getElementById("eventRegistrationForm");
  const successAlert = document.getElementById("successAlert");

  eventForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Hiển thị thông báo thành công
    successAlert.classList.add("show");

    // Sau 2 giây chuyển sang tab thanh toán
    setTimeout(function () {
      // Cập nhật thông tin thanh toán
      document.getElementById("paymentEventName").textContent =
        "Sự kiện mới đăng ký";
      document.getElementById("paymentTotalAmount").textContent =
        totalPriceElement.textContent;
      document.getElementById("paymentAmount").textContent =
        formatPrice(
          parseInt(totalPriceElement.textContent.replace(/[^\d]/g, "")) / 2
        ) + " VNĐ";

      // Chuyển sang tab thanh toán
      document.querySelector('a[data-bs-target="#payment"]').click();
    }, 2000);
  });
});
>>>>>>> 923f71330b0d1a3a553fc695c5da77ba6ebea7f5
