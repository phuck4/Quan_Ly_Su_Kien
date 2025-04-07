document.addEventListener("DOMContentLoaded", function () {
  // 1. Khai báo biến
  const eventTypeSelect = document.getElementById("eventType");
  const priceInfoContainer = document.getElementById("priceInfoContainer");
  const basePriceElement = document.getElementById("basePrice");
  const totalPriceElement = document.getElementById("totalPrice");
  const attendeesInput = document.getElementById("attendees");
  const eventForm = document.getElementById("eventRegistrationForm");
  const successAlert = document.getElementById("successAlert");

  // Hàm định dạng số tiền
  function formatPrice(price) {
    return new Intl.NumberFormat("vi-VN").format(price);
  }

  // Cập nhật giá khi chọn loại sự kiện hoặc thay đổi số lượng người tham dự
  function updatePrice() {
    const selectedOption = eventTypeSelect.options[eventTypeSelect.selectedIndex];
    const basePrice = selectedOption.dataset.price ? parseInt(selectedOption.dataset.price) : 0;
    // Sử dụng biến attendees nếu cần logic tính giá dựa trên số lượng
    const attendees = parseInt(attendeesInput.value) || 0;

    if (basePrice > 0) {
      priceInfoContainer.style.display = "block";
      basePriceElement.textContent = formatPrice(basePrice);
      // Tính tổng giá, có thể thay đổi logic tính nếu cần
      const totalPrice = basePrice;
      totalPriceElement.textContent = formatPrice(totalPrice) + " VNĐ";
    } else {
      priceInfoContainer.style.display = "none";
    }
  }

  // Gán sự kiện thay đổi giá
  eventTypeSelect.addEventListener("change", updatePrice);
  attendeesInput.addEventListener("input", updatePrice);

  // Xử lý form submit (đăng ký sự kiện)
  eventForm.addEventListener("submit", function (e) {
    e.preventDefault();
    successAlert.classList.add("show");

    // Sau 2 giây chuyển sang tab thanh toán và cập nhật thông tin thanh toán
    setTimeout(function () {
      document.getElementById("paymentEventName").textContent = "Sự kiện mới đăng ký";
      document.getElementById("paymentTotalAmount").textContent = totalPriceElement.textContent;
      document.getElementById("paymentAmount").textContent =
        formatPrice(
          parseInt(totalPriceElement.textContent.replace(/[^\d]/g, "")) / 2
        ) + " VNĐ";

      document.querySelector('a[data-bs-target="#payment"]').click();
    }, 2000);
  });

  // Xử lý reset form để làm mới thông tin chi phí
  eventForm.addEventListener("reset", function () {
    priceInfoContainer.style.display = "none";
    basePriceElement.textContent = "0";
    totalPriceElement.textContent = "0 VNĐ";
  });
});
