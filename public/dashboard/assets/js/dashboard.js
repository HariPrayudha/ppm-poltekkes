/**
 * Dashboard JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Sidebar, Modal System, Floating Toast Notifications, User Profile Dropdown, and Global Utilities
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Initialize Feather Icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  // 2. Sidebar Toggle Logic
  initSidebar();

  // 3. Modal System
  initModals();

  // 4. Toast System from server session
  initToasts();

  // 5. Form Submitting State Helper
  initFormSubmits();

  // 6. User Profile Dropdown
  initUserProfileDropdown();

  // 7. Global Image Lightbox Preview Modal
  initImagePreviewModal();
});

/* ==========================================================================
   Sidebar Management
   ========================================================================== */
function initSidebar() {
  const sidebar = document.getElementById('admin-sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const toggleBtn = document.getElementById('btn-sidebar-toggle');
  const closeBtn = document.getElementById('btn-sidebar-close');

  if (!sidebar) return;

  const openSidebar = () => {
    sidebar.classList.remove('-translate-x-full');
    if (overlay) overlay.classList.remove('hidden');
    document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
  };

  const closeSidebar = () => {
    sidebar.classList.add('-translate-x-full');
    if (overlay) overlay.classList.add('hidden');
    document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
  };

  if (toggleBtn) {
    toggleBtn.addEventListener('click', openSidebar);
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', closeSidebar);
  }

  if (overlay) {
    overlay.addEventListener('click', closeSidebar);
  }
}

/* ==========================================================================
   Modal System
   ========================================================================== */
function initModals() {
  // Open modal buttons
  document.addEventListener('click', (e) => {
    const openBtn = e.target.closest('[data-modal-open]');
    if (openBtn) {
      e.preventDefault();
      const modalId = openBtn.getAttribute('data-modal-open');
      openModal(modalId, openBtn);
      return;
    }

    // Close modal buttons
    const closeBtn = e.target.closest('[data-modal-close]');
    if (closeBtn) {
      e.preventDefault();
      const modal = closeBtn.closest('.dashboard-modal');
      if (modal) {
        closeModal(modal);
      }
      return;
    }

    // Backdrop click
    if (e.target.classList.contains('dashboard-modal')) {
      closeModal(e.target);
    }
  });

  // ESC key listener
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const activeModal = document.querySelector('.dashboard-modal.modal-open');
      if (activeModal) {
        closeModal(activeModal);
      }
    }
  });
}

function openModal(modalId, triggerBtn = null) {
  const modal = document.getElementById(modalId);
  if (!modal) return;

  // Handle data-fill-* attributes if present on trigger
  if (triggerBtn) {
    const formSelector = triggerBtn.getAttribute('data-fill-form');
    const form = formSelector ? document.querySelector(formSelector) : modal.querySelector('form');

    if (form) {
      Array.from(triggerBtn.attributes).forEach((attr) => {
        if (attr.name.startsWith('data-fill-') && attr.name !== 'data-fill-form') {
          const fieldName = attr.name.replace('data-fill-', '');
          const input = form.querySelector(`[name="${fieldName}"]`);
          if (input) {
            if (input.type === 'checkbox') {
              input.checked = attr.value === '1' || attr.value === 'true';
            } else {
              input.value = attr.value;
            }
          }
        }
      });
    }
  }

  modal.classList.remove('hidden');
  document.body.classList.add('overflow-hidden');

  // Trigger smooth entrance animation in next animation frames
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      modal.classList.add('modal-open');
    });
  });

  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  // Focus first input
  const firstInput = modal.querySelector('input:not([type="hidden"]), select, textarea');
  if (firstInput) {
    setTimeout(() => firstInput.focus(), 150);
  }
}

function closeModal(modal) {
  if (!modal) return;
  if (modal.classList.contains('is-closing')) return;

  modal.classList.add('is-closing');
  modal.classList.remove('modal-open');

  // Wait for transition before hiding
  setTimeout(() => {
    modal.classList.add('hidden');
    modal.classList.remove('is-closing');

    // If no other modals are open, restore body scroll
    const hasOpenModals = document.querySelector('.dashboard-modal.modal-open');
    if (!hasOpenModals) {
      document.body.classList.remove('overflow-hidden');
    }
  }, 220);
}

window.openDashboardModal = openModal;
window.closeDashboardModal = closeModal;

/* ==========================================================================
   Floating Toast Notification System (Auto-Dismiss 5s with Progress Bar)
   ========================================================================== */
function initToasts() {
  const container = document.getElementById('toast-container');
  if (!container) return;

  const successMsg = container.getAttribute('data-toast-success');
  const errorMsg = container.getAttribute('data-toast-error');
  const warningMsg = container.getAttribute('data-toast-warning');
  const infoMsg = container.getAttribute('data-toast-info');

  if (successMsg) showToast(successMsg, 'success');
  if (errorMsg) showToast(errorMsg, 'error');
  if (warningMsg) showToast(warningMsg, 'warning');
  if (infoMsg) showToast(infoMsg, 'info');
}

/**
 * Show a floating toast notification
 * @param {string} message
 * @param {'success'|'error'|'warning'|'info'} type
 * @param {string} [title]
 * @param {number} [duration=5000]
 */
function showToast(message, type = 'success', title = '', duration = 5000) {
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed right-4 top-4 z-[9999] flex flex-col gap-2 pointer-events-none';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = 'toast-item pointer-events-auto flex w-80 sm:w-96 items-start gap-3 overflow-hidden rounded-2xl bg-white p-4 shadow-xl ring-1 ring-slate-900/5 transition-all';

  let config = {
    title: title || 'Berhasil!',
    bgIcon: 'bg-emerald-100',
    textIcon: 'text-emerald-600',
    barColor: 'bg-emerald-500',
    iconName: 'check',
  };

  if (type === 'error') {
    config = {
      title: title || 'Terjadi Kesalahan!',
      bgIcon: 'bg-rose-100',
      textIcon: 'text-rose-600',
      barColor: 'bg-rose-500',
      iconName: 'alert-circle',
    };
  } else if (type === 'warning') {
    config = {
      title: title || 'Peringatan',
      bgIcon: 'bg-amber-100',
      textIcon: 'text-amber-600',
      barColor: 'bg-amber-500',
      iconName: 'alert-triangle',
    };
  } else if (type === 'info') {
    config = {
      title: title || 'Informasi',
      bgIcon: 'bg-sky-100',
      textIcon: 'text-sky-600',
      barColor: 'bg-sky-500',
      iconName: 'info',
    };
  }

  toast.innerHTML = `
    <div class="mt-0.5 shrink-0 rounded-full ${config.bgIcon} p-2 flex items-center justify-center">
      <i data-feather="${config.iconName}" class="h-4 w-4 ${config.textIcon}"></i>
    </div>
    <div class="min-w-0 flex-1">
      <p class="text-sm font-semibold text-slate-900">${config.title}</p>
      <p class="mt-0.5 text-xs text-slate-600 leading-relaxed">${message}</p>
      <div class="mt-2.5 h-1 w-full overflow-hidden rounded-full bg-slate-100">
        <div class="toast-progress-bar h-full rounded-full ${config.barColor}" style="width: 100%; transition: width ${duration}ms linear;"></div>
      </div>
    </div>
    <button type="button" class="toast-close-btn -mr-1 -mt-1 p-1 text-slate-400 hover:text-slate-600 rounded-lg">
      <i data-feather="x" class="h-4 w-4"></i>
    </button>
  `;

  container.appendChild(toast);

  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  const progressBar = toast.querySelector('.toast-progress-bar');
  // Trigger transition on next frame
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      if (progressBar) progressBar.style.width = '0%';
    });
  });

  const dismiss = () => {
    toast.classList.add('toast-leave');
    setTimeout(() => toast.remove(), 300);
  };

  const timer = setTimeout(dismiss, duration);

  const closeBtn = toast.querySelector('.toast-close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      clearTimeout(timer);
      dismiss();
    });
  }
}

window.showToast = showToast;

/* ==========================================================================
   Form Submit Loading State
   ========================================================================== */
function initFormSubmits() {
  document.addEventListener('submit', (e) => {
    const form = e.target;
    if (form.hasAttribute('data-no-loading')) return;

    const submitBtn = form.querySelector('button[type="submit"]:not([data-no-loading])');
    if (submitBtn && !submitBtn.disabled) {
      const originalHtml = submitBtn.innerHTML;
      submitBtn.setAttribute('data-original-html', originalHtml);
      submitBtn.disabled = true;
      submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

      // Conditional loading label
      let loadingText = submitBtn.getAttribute('data-loading-text') || form.getAttribute('data-loading-text');

      if (!loadingText) {
        const text = (submitBtn.innerText || submitBtn.textContent || '').trim().toLowerCase();
        if (text.includes('masuk') || text.includes('login')) {
          loadingText = 'Memproses masuk...';
        } else if (text.includes('perbarui') || text.includes('update') || text.includes('ubah')) {
          loadingText = 'Memperbarui...';
        } else if (text.includes('hapus') || text.includes('delete')) {
          loadingText = 'Menghapus...';
        } else if (text.includes('unggah') || text.includes('upload')) {
          loadingText = 'Mengunggah...';
        } else if (text.includes('keluar') || text.includes('logout')) {
          loadingText = 'Keluar...';
        } else if (text.includes('simpan') || text.includes('tambah')) {
          loadingText = 'Menyimpan...';
        } else {
          loadingText = 'Memproses...';
        }
      }

      submitBtn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        <span>${loadingText}</span>
      `;
    }
  });
}

/* ==========================================================================
   SweetAlert2 Delete Confirmation Helper
   ========================================================================== */
window.confirmDelete = function(formId, itemName = 'data ini') {
  if (typeof Swal === 'undefined') {
    if (confirm(`Apakah Anda yakin ingin menghapus ${itemName}?`)) {
      document.getElementById(formId).submit();
    }
    return;
  }

  Swal.fire({
    title: 'Konfirmasi Hapus',
    text: `Apakah Anda yakin ingin menghapus ${itemName}? Tindakan ini tidak dapat dibatalkan.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal',
    reverseButtons: true,
    customClass: {
      popup: 'rounded-2xl',
      confirmButton: 'rounded-xl px-4 py-2 font-semibold',
      cancelButton: 'rounded-xl px-4 py-2 font-semibold',
    }
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(formId).submit();
    }
  });
};

/* ==========================================================================
   Header User Profile Dropdown (Mobile Click Toggle & Outside Click)
   ========================================================================== */
function initUserProfileDropdown() {
  const profileMenu = document.getElementById('user-profile-menu');
  const profileBtn = document.getElementById('user-profile-btn');

  if (!profileMenu || !profileBtn) return;

  profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = profileMenu.classList.toggle('open');
    profileBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  // Close dropdown on click outside
  document.addEventListener('click', (e) => {
    if (!profileMenu.contains(e.target)) {
      profileMenu.classList.remove('open');
      profileBtn.setAttribute('aria-expanded', 'false');
    }
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && profileMenu.classList.contains('open')) {
      profileMenu.classList.remove('open');
      profileBtn.setAttribute('aria-expanded', 'false');
    }
  });
}

/* ==========================================================================
   Global Image Lightbox Preview Modal
   ========================================================================== */
function initImagePreviewModal() {
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-preview-image]');
    if (trigger) {
      e.preventDefault();
      const imageUrl = trigger.getAttribute('data-preview-image');
      const imageTitle = trigger.getAttribute('data-preview-title') || 'Pratinjau Gambar';
      openImagePreviewModal(imageUrl, imageTitle);
    }
  });
}

function openImagePreviewModal(imageUrl, title = 'Pratinjau Gambar') {
  if (!imageUrl) return;

  const imgElem = document.getElementById('global-image-modal-img');
  const titleElem = document.getElementById('global-image-modal-title');
  const linkElem = document.getElementById('global-image-modal-link');

  if (imgElem) {
    imgElem.src = imageUrl;
    imgElem.alt = title;
  }
  if (titleElem) {
    titleElem.textContent = title;
  }
  if (linkElem) {
    linkElem.href = imageUrl;
  }

  openModal('modal-global-image-preview');
}

window.openImagePreviewModal = openImagePreviewModal;
