// JavaScript cho hệ thống quản lý thanh toán

// Biến toàn cục
let currentPage = 1;
let isLoading = false;
let paymentData = [];
let detailModal;

// Khởi tạo khi trang đã load
document.addEventListener('DOMContentLoaded', () => {
  // Khởi tạo Bootstrap modal
  detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
  
  // Load dữ liệu ban đầu
  loadPayments();
  
  // Thêm sự kiện cho các phần tử
  setupEventListeners();
  
  // Kiểm tra URL để hiển thị đúng phần
  checkUrlForSection();
});

// Thiết lập các event listener
function setupEventListeners() {
  // Nút tìm kiếm
  document.getElementById('searchInput').addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
      loadPayments();
    }
  });
  
  // Chọn menu sidebar
  document.querySelectorAll('.sidebar-menu a').forEach(item => {
    item.addEventListener('click', handleMenuClick);
  });
  
  // Nút xuất báo cáo
  document.getElementById('exportLink').addEventListener('click', exportPaymentReport);
}

// Xử lý khi click vào menu
function handleMenuClick(e) {
  e.preventDefault();
  
  // Xóa class active từ tất cả các mục
  document.querySelectorAll('.sidebar-menu a').forEach(item => {
    item.classList.remove('active');
  });
  
  // Thêm class active cho mục được chọn
  this.classList.add('active');
  
  // Hiển thị section tương ứng
  const targetId = this.id;
  
  if (targetId === 'paymentLink') {
    document.getElementById('paymentSection').style.display = 'block';
    window.history.pushState({}, '', '#payments');
  } else if (targetId === 'exportLink') {
    exportPaymentReport();
  }
}

// Kiểm tra URL để hiển thị đúng section
function checkUrlForSection() {
  const hash = window.location.hash;
  if (hash === '#payments' || hash === '') {
    document.getElementById('paymentLink').classList.add('active');
    document.getElementById('paymentSection').style.display = 'block';
  }
}

// Hàm tải dữ liệu thanh toán
async function loadPayments() {
  if (isLoading) return;
  
  isLoading = true;
  const tableContainer = document.querySelector('.table-container');
  tableContainer.classList.add('table-loading');
  
  const search = document.getElementById('searchInput').value;
  const status = document.getElementById('filterStatus').value;
  
  try {
    const response = await fetch(`/api/payments?page=${currentPage}&search=${encodeURIComponent(search)}&status=${status}`);
    if (!response.ok) {
      throw new Error('Lỗi khi tải dữ liệu từ máy chủ');
    }
    
    const data = await response.json();
    paymentData = data.payments || [];
    
    renderPaymentTable(paymentData);
    updatePagination(data.totalPages || 1);
    
  } catch (error) {
    console.error('Lỗi tải dữ liệu:', error);
    showNotification('Không thể tải dữ liệu thanh toán.', 'danger');
  } finally {
    isLoading = false;
    tableContainer.classList.remove('table-loading');
  }
}

// Hiển thị dữ liệu lên bảng
function renderPaymentTable(payments) {
  const tbody = document.getElementById('paymentData');
  
  if (!payments || payments.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="text-center">Không có dữ liệu thanh toán.</td>
      </tr>
    `;
    return;
  }
  
  tbody.innerHTML = payments.map(payment => `
    <tr data-id="${payment.id}">
      <td>${sanitizeHTML(payment.event_id)}</td>
      <td>${sanitizeHTML(payment.event_name)}</td>
      <td>${sanitizeHTML(payment.customer_name)}</td>
      <td>${Number(payment.total_amount).toLocaleString()} VND</td>
      <td>${Number(payment.paid_amount).toLocaleString()} VND</td>
      <td>
        <span class="badge ${payment.status === 'paid' ? 'badge-success' : 'badge-danger'}">
          ${payment.status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán'}
        </span>
      </td>
      <td>
        <button class="btn btn-primary btn-sm me-1" onclick="viewDetail('${payment.id}')">
          <i class="fas fa-info-circle"></i> Chi tiết
        </button>
        ${payment.status === 'unpaid' ? 
          `<button class="btn btn-success btn-sm" onclick="markAsPaid('${payment.id}')">
            <i class="fas fa-check-circle"></i> Đánh dấu đã thanh toán
          </button>` 
          : ''
        }
      </td>
    </tr>
  `).join('');
  
  // Thêm hiệu ứng khi hover
  document.querySelectorAll('#paymentData tr').forEach(row => {
    row.addEventListener('mouseover', () => {
      row.style.transition = 'background-color 0.3s';
      row.style.backgroundColor = 'rgba(52, 152, 219, 0.1)';
    });
    
    row.addEventListener('mouseout', () => {
      row.style.backgroundColor = '';
    });
  });
}

// Cập nhật phân trang
function updatePagination(totalPages) {
  document.getElementById('currentPage').textContent = currentPage;
  
  // Disable/enable nút Trước và Sau
  const prevButton = document.querySelector('.pagination button:first-child');
  const nextButton = document.querySelector('.pagination button:last-child');
  
  prevButton.disabled = currentPage <= 1;
  nextButton.disabled = currentPage >= totalPages;
}

// Đổi trang
function changePage(delta) {
  const newPage = currentPage + delta;
  if (newPage < 1) return;
  
  currentPage = newPage;
  loadPayments();
}

// Xem chi tiết thanh toán
async function viewDetail(paymentId) {
  if (isLoading) return;
  
  isLoading = true;
  try {
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = '<div class="text-center"><div class="loader"></div><p>Đang tải...</p></div>';
    
    detailModal.show();
    
    const response = await fetch(`/api/payments/${paymentId}`);
    if (!response.ok) {
      throw new Error('Lỗi tải chi tiết thanh toán');
    }
    
    const payment = await response.json();
    
    // Hiển thị thông tin chi tiết
    modalContent.innerHTML = `
      <div class="payment-details">
        <div class="row mb-3">
          <div class="col-md-6">
            <p><strong>Mã sự kiện:</strong> ${sanitizeHTML(payment.event_id)}</p>
            <p><strong>Tên sự kiện:</strong> ${sanitizeHTML(payment.event_name)}</p>
            <p><strong>Ngày sự kiện:</strong> ${payment.event_date ? new Date(payment.event_date).toLocaleDateString('vi-VN') : 'N/A'}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Khách hàng:</strong> ${sanitizeHTML(payment.customer_name)}</p>
            <p><strong>Email:</strong> ${sanitizeHTML(payment.customer_email || 'N/A')}</p>
            <p><strong>Số điện thoại:</strong> ${sanitizeHTML(payment.customer_phone || 'N/A')}</p>
          </div>
        </div>
        
        <hr>
        
        <div class="row">
          <div class="col-md-6">
            <p><strong>Tổng tiền:</strong> ${Number(payment.total_amount).toLocaleString()} VND</p>
            <p><strong>Đã thanh toán:</strong> ${Number(payment.paid_amount).toLocaleString()} VND</p>
            <p><strong>Còn lại:</strong> ${Number(payment.total_amount - payment.paid_amount).toLocaleString()} VND</p>
          </div>
          <div class="col-md-6">
            <p><strong>Trạng thái:</strong> 
              <span class="badge ${payment.status === 'paid' ? 'badge-success' : 'badge-danger'}">
                ${payment.status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán'}
              </span>
            </p>
            <p><strong>Phương thức thanh toán:</strong> ${sanitizeHTML(payment.payment_method || 'N/A')}</p>
            <p><strong>Ngày thanh toán:</strong> ${payment.payment_date ? new Date(payment.payment_date).toLocaleDateString('vi-VN') : 'N/A'}</p>
          </div>
        </div>
        
        ${payment.notes ? `
        <hr>
        <div class="row">
          <div class="col-12">
            <p><strong>Ghi chú:</strong></p>
            <p>${sanitizeHTML(payment.notes)}</p>
          </div>
        </div>
        ` : ''}
        
        ${payment.status === 'unpaid' ? `
        <hr>
        <div class="row">
          <div class="col-12 text-center">
            <button class="btn btn-success" onclick="markAsPaid('${payment.id}')">
              <i class="fas fa-check-circle"></i> Đánh dấu đã thanh toán
            </button>
          </div>
        </div>
        ` : ''}
      </div>
    `;
    
  } catch (error) {
    console.error(error);
    showNotification('Không thể tải chi tiết thanh toán.', 'danger');
  } finally {
    isLoading = false;
  }
}

// Đánh dấu đã thanh toán
async function markAsPaid(paymentId) {
  if (isLoading) return;
  
  if (!confirm('Bạn có chắc chắn muốn đánh dấu khoản thanh toán này là "Đã thanh toán"?')) {
    return;
  }
  
  isLoading = true;
  try {
    const response = await fetch(`/api/payments/${paymentId}/mark-paid`, { 
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });
    
    if (!response.ok) {
      throw new Error('Lỗi cập nhật trạng thái');
    }
    
    // Đóng modal nếu đang mở
    if (document.getElementById('detailModal').classList.contains('show')) {
      detailModal.hide();
    }
    
    // Tải lại dữ liệu
    await loadPayments();
    showNotification('Cập nhật trạng thái thành công!', 'success');
  } catch (error) {
    console.error(error);
    showNotification('Có lỗi xảy ra khi cập nhật trạng thái!', 'danger');
  } finally {
    isLoading = false;
  }
}

// Xuất báo cáo thanh toán
async function exportPaymentReport() {
  if (isLoading) return;
  
  isLoading = true;
  try {
    showNotification('Đang chuẩn bị báo cáo...', 'info');
    
    const response = await fetch('/api/export-payments');
    if (!response.ok) {
      throw new Error('Lỗi khi xuất báo cáo');
    }
    
    const blob = await response.blob();
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `bao-cao-thanh-toan-${new Date().toISOString().slice(0, 10)}.xlsx`;
    document.body.appendChild(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(url);
    
    showNotification('Xuất báo cáo thành công!', 'success');
  } catch (error) {
    console.error(error);
    showNotification('Lỗi xuất file!', 'danger');
  } finally {
    isLoading = false;
  }
}

// Hiển thị thông báo
function showNotification(message, type = 'info') {
  // Kiểm tra nếu đã có thông báo, xóa đi
  const existingAlert = document.querySelector('.alert-notification');
  if (existingAlert) {
    existingAlert.remove();
  }
  
  // Tạo phần tử thông báo
  const alert = document.createElement('div');
  alert.className = `alert alert-${type} alert-dismissible fade show alert-notification`;
  alert.style.position = 'fixed';
  alert.style.top = '20px';
  alert.style.right = '20px';
  alert.style.zIndex = '9999';
  alert.style.maxWidth = '300px';
  alert.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
  
  alert.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
  `;
  
  document.body.appendChild(alert);
  
  // Tự động đóng sau 3 giây
  setTimeout(() => {
    const bsAlert = new bootstrap.Alert(alert);
    bsAlert.close();
  }, 3000);
}

// Sanitize HTML (bảo mật) 
function sanitizeHTML(text) {
  if (!text) return '';
  
  return String(text)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

// Responsive sidebar toggle
function toggleSidebar() {
  const sidebar = document.querySelector('.sidebar');
  const mainContent = document.querySelector('.main-content');
  
  sidebar.classList.toggle('collapsed');
  mainContent.classList.toggle('expanded');
}