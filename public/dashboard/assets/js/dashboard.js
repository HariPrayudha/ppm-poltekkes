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

  // 8. Custom Date Picker
  initCustomDatePicker();
});

/* ==========================================================================
   Sidebar Management
   ========================================================================== */
function initSidebar() {
  const sidebar = document.getElementById('admin-sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const toggleBtn = document.getElementById('btn-sidebar-toggle');
  const closeBtn = document.getElementById('btn-sidebar-close');
  const scrollContainer = document.getElementById('admin-sidebar-scroll') || (sidebar ? sidebar.querySelector('.overflow-y-auto') : null);

  if (!sidebar) return;

  const ensureActiveItemVisible = () => {
    if (!scrollContainer) return;
    const activeItem = sidebar.querySelector('[data-sidebar-active="true"], [aria-current="page"]');
    if (activeItem) {
      requestAnimationFrame(() => {
        const containerRect = scrollContainer.getBoundingClientRect();
        const itemRect = activeItem.getBoundingClientRect();
        if (itemRect.top < containerRect.top || itemRect.bottom > containerRect.bottom) {
          activeItem.scrollIntoView({ block: 'nearest', behavior: 'instant' });
        }
      });
    }
  };

  const openSidebar = () => {
    sidebar.classList.remove('-translate-x-full');
    if (overlay) overlay.classList.remove('hidden');
    document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
    ensureActiveItemVisible();
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

  // Sidebar Scroll Position Persistence & Active Item Visibility
  if (scrollContainer) {
    // 1. Restore scroll position from session storage
    const savedScroll = sessionStorage.getItem('sidebar_scroll_top');
    if (savedScroll !== null) {
      scrollContainer.scrollTop = parseInt(savedScroll, 10);
    }

    // 2. Ensure active menu item is always visible
    ensureActiveItemVisible();

    // 3. Save scroll position on scroll
    scrollContainer.addEventListener('scroll', () => {
      sessionStorage.setItem('sidebar_scroll_top', scrollContainer.scrollTop);
    }, { passive: true });

    // 4. Persist scroll position before navigation
    sidebar.querySelectorAll('a[href]').forEach((link) => {
      link.addEventListener('click', () => {
        sessionStorage.setItem('sidebar_scroll_top', scrollContainer.scrollTop);
      });
    });
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
   Global Image Lightbox Preview Modal with Gesture Zoom & Pan Engine
   (Desktop: Mouse Wheel / Ctrl+Wheel + Click & Drag | Mobile: 2-Finger Pinch + Drag)
   ========================================================================== */
let zoomScale = 1;
let panX = 0;
let panY = 0;
let isDragging = false;
let startDragX = 0;
let startDragY = 0;

function applyImageTransform(animated = false) {
  const wrapper = document.getElementById('img-zoom-wrapper');
  const container = document.getElementById('img-zoom-container');
  if (!wrapper) return;

  if (animated) {
    wrapper.style.transition = 'transform 0.2s cubic-bezier(0.16, 1, 0.3, 1)';
  } else {
    wrapper.style.transition = 'none';
  }

  wrapper.style.transform = `translate3d(${panX}px, ${panY}px, 0) scale(${zoomScale})`;

  if (container) {
    if (zoomScale > 1.05) {
      container.style.cursor = isDragging ? 'grabbing' : 'grab';
    } else {
      container.style.cursor = 'default';
    }
  }
}

function resetImageZoomAndPan(animated = false) {
  zoomScale = 1;
  panX = 0;
  panY = 0;
  isDragging = false;
  applyImageTransform(animated);
}

function initImagePreviewModal() {
  // Trigger from any [data-preview-image]
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-preview-image]');
    if (trigger) {
      e.preventDefault();
      const imageUrl = trigger.getAttribute('data-preview-image');
      const imageTitle = trigger.getAttribute('data-preview-title') || 'Pratinjau Gambar';
      openImagePreviewModal(imageUrl, imageTitle);
    }
  });

  const container = document.getElementById('img-zoom-container');
  if (!container) return;

  // 1. Desktop: Mouse Wheel (with or without Ctrl) to Zoom In/Out
  container.addEventListener(
    'wheel',
    (e) => {
      e.preventDefault();
      const zoomFactor = e.deltaY < 0 ? 1.15 : 0.87;
      const newZoom = Math.min(Math.max(zoomScale * zoomFactor, 1), 4);

      if (newZoom === 1) {
        panX = 0;
        panY = 0;
      } else if (newZoom !== zoomScale) {
        const rect = container.getBoundingClientRect();
        const mouseX = e.clientX - rect.left - rect.width / 2;
        const mouseY = e.clientY - rect.top - rect.height / 2;
        const scaleRatio = newZoom / zoomScale;
        panX = mouseX - (mouseX - panX) * scaleRatio;
        panY = mouseY - (mouseY - panY) * scaleRatio;
      }

      zoomScale = newZoom;
      applyImageTransform(true);
    },
    { passive: false }
  );

  // 2. Desktop: Mouse Drag (Pan) when Zoomed In
  container.addEventListener('mousedown', (e) => {
    if (e.button !== 0) return; // Left click only
    if (zoomScale <= 1.05) return; // Only drag when zoomed in

    isDragging = true;
    startDragX = e.clientX - panX;
    startDragY = e.clientY - panY;
    applyImageTransform(false);
  });

  window.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    panX = e.clientX - startDragX;
    panY = e.clientY - startDragY;
    applyImageTransform(false);
  });

  window.addEventListener('mouseup', () => {
    if (isDragging) {
      isDragging = false;
      applyImageTransform(true);
    }
  });

  // 3. Desktop: Double-Click to Toggle Zoom (1x <-> 2x)
  container.addEventListener('dblclick', (e) => {
    e.preventDefault();
    if (zoomScale > 1.2) {
      resetImageZoomAndPan(true);
    } else {
      zoomScale = 2;
      panX = 0;
      panY = 0;
      applyImageTransform(true);
    }
  });

  // 4. Mobile: Touch Events (2-Finger Pinch Zoom & 1-Finger Pan)
  let initialTouchDist = 0;
  let initialTouchZoom = 1;
  let touchStartX = 0;
  let touchStartY = 0;

  container.addEventListener(
    'touchstart',
    (e) => {
      if (e.touches.length === 2) {
        e.preventDefault();
        isDragging = false;
        initialTouchDist = Math.hypot(
          e.touches[0].clientX - e.touches[1].clientX,
          e.touches[0].clientY - e.touches[1].clientY
        );
        initialTouchZoom = zoomScale;
      } else if (e.touches.length === 1 && zoomScale > 1.05) {
        isDragging = true;
        touchStartX = e.touches[0].clientX - panX;
        touchStartY = e.touches[0].clientY - panY;
      }
    },
    { passive: false }
  );

  container.addEventListener(
    'touchmove',
    (e) => {
      if (e.touches.length === 2) {
        e.preventDefault();
        const currentDist = Math.hypot(
          e.touches[0].clientX - e.touches[1].clientX,
          e.touches[0].clientY - e.touches[1].clientY
        );
        if (initialTouchDist > 0) {
          const factor = currentDist / initialTouchDist;
          zoomScale = Math.min(Math.max(initialTouchZoom * factor, 1), 4);
          if (zoomScale === 1) {
            panX = 0;
            panY = 0;
          }
          applyImageTransform(false);
        }
      } else if (e.touches.length === 1 && isDragging) {
        e.preventDefault();
        panX = e.touches[0].clientX - touchStartX;
        panY = e.touches[0].clientY - touchStartY;
        applyImageTransform(false);
      }
    },
    { passive: false }
  );

  container.addEventListener('touchend', (e) => {
    if (e.touches.length === 0) {
      isDragging = false;
      if (zoomScale <= 1.05) {
        resetImageZoomAndPan(true);
      } else {
        applyImageTransform(true);
      }
    }
  });
}

function openImagePreviewModal(imageUrl, title = 'Pratinjau Gambar') {
  if (!imageUrl) return;

  const imgElem = document.getElementById('global-image-modal-img');
  const titleElem = document.getElementById('global-image-modal-title');
  const linkElem = document.getElementById('global-image-modal-link');

  // Reset zoom & pan on each new open
  resetImageZoomAndPan(false);

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
window.resetImageZoomAndPan = resetImageZoomAndPan;

/* ==========================================================================
   Global Custom Date Picker Modal Logic with Custom Dropdowns
   ========================================================================== */
function initCustomDatePicker() {
  const modal = document.getElementById('global-date-modal');
  if (!modal) return;

  const monthBtn = document.getElementById('cdm-month-btn');
  const monthLabel = document.getElementById('cdm-month-label');
  const monthMenu = document.getElementById('cdm-month-menu');
  const monthChevron = document.getElementById('cdm-month-chevron');

  const yearBtn = document.getElementById('cdm-year-btn');
  const yearLabel = document.getElementById('cdm-year-label');
  const yearMenu = document.getElementById('cdm-year-menu');
  const yearChevron = document.getElementById('cdm-year-chevron');

  const prevBtn = document.getElementById('cdm-prev-month');
  const nextBtn = document.getElementById('cdm-next-month');
  const grid = document.getElementById('cdm-grid');
  const todayBtn = document.getElementById('cdm-today-btn');
  const clearBtn = document.getElementById('cdm-clear-btn');
  
  let currentTargetInput = null;
  let currentDate = new Date();

  const monthNames = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];

  function closeDropdowns() {
    if (monthMenu) monthMenu.classList.add('hidden');
    if (yearMenu) yearMenu.classList.add('hidden');
    if (monthChevron) monthChevron.classList.remove('rotate-180');
    if (yearChevron) yearChevron.classList.remove('rotate-180');
    if (monthBtn) monthBtn.setAttribute('aria-expanded', 'false');
    if (yearBtn) yearBtn.setAttribute('aria-expanded', 'false');
  }

  function renderMonthMenu(selectedMonth) {
    if (!monthMenu) return;
    monthMenu.innerHTML = '';
    monthNames.forEach((name, idx) => {
      const isSelected = idx === selectedMonth;
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = `w-full flex items-center justify-between px-3 py-1.5 rounded-xl text-xs font-semibold transition-all duration-150 cursor-pointer ${
        isSelected 
          ? 'bg-linear-to-r from-[#028DA9] to-[#0BB5CB] text-white shadow-xs' 
          : 'text-slate-700 hover:bg-[#028DA9]/10 hover:text-[#028DA9]'
      }`;
      btn.innerHTML = `
        <span>${name}</span>
        ${isSelected ? '<i data-feather="check" class="w-3.5 h-3.5 stroke-2"></i>' : ''}
      `;
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        currentDate.setDate(1);
        currentDate.setMonth(idx);
        closeDropdowns();
        renderCalendar(currentDate);
      });
      monthMenu.appendChild(btn);
    });
    if (typeof feather !== 'undefined') feather.replace();
  }

  function renderYearMenu(selectedYear) {
    if (!yearMenu) return;
    yearMenu.innerHTML = '';
    const nowYear = new Date().getFullYear();
    const startYear = Math.min(nowYear - 20, selectedYear - 10);
    const endYear = Math.max(nowYear + 10, selectedYear + 10);

    for (let y = startYear; y <= endYear; y++) {
      const isSelected = y === selectedYear;
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = `w-full flex items-center justify-center px-3 py-1.5 rounded-xl text-xs font-semibold transition-all duration-150 cursor-pointer ${
        isSelected 
          ? 'bg-linear-to-r from-[#028DA9] to-[#0BB5CB] text-white shadow-xs' 
          : 'text-slate-700 hover:bg-[#028DA9]/10 hover:text-[#028DA9]'
      }`;
      btn.textContent = y;
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        currentDate.setFullYear(y);
        closeDropdowns();
        renderCalendar(currentDate);
      });
      yearMenu.appendChild(btn);
    }
  }

  // Toggle Month Menu
  if (monthBtn && monthMenu) {
    monthBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isClosed = monthMenu.classList.contains('hidden');
      closeDropdowns();
      if (isClosed) {
        renderMonthMenu(currentDate.getMonth());
        monthMenu.classList.remove('hidden');
        if (monthChevron) monthChevron.classList.add('rotate-180');
        monthBtn.setAttribute('aria-expanded', 'true');
        
        const selected = monthMenu.querySelector('.bg-linear-to-r');
        if (selected) {
          setTimeout(() => selected.scrollIntoView({ block: 'nearest' }), 10);
        }
      }
    });
  }

  // Toggle Year Menu
  if (yearBtn && yearMenu) {
    yearBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isClosed = yearMenu.classList.contains('hidden');
      closeDropdowns();
      if (isClosed) {
        renderYearMenu(currentDate.getFullYear());
        yearMenu.classList.remove('hidden');
        if (yearChevron) yearChevron.classList.add('rotate-180');
        yearBtn.setAttribute('aria-expanded', 'true');

        const selected = yearMenu.querySelector('.bg-linear-to-r');
        if (selected) {
          setTimeout(() => selected.scrollIntoView({ block: 'center' }), 10);
        }
      }
    });
  }

  // Close menus on outside click
  document.addEventListener('click', (e) => {
    if (!e.target.closest('#cdm-month-dropdown') && !e.target.closest('#cdm-year-dropdown')) {
      closeDropdowns();
    }
  });

  function parseDateParts(dateStr) {
    if (!dateStr) return null;
    const parts = dateStr.trim().split('-');
    if (parts.length === 3) {
      const y = parseInt(parts[0], 10);
      const m = parseInt(parts[1], 10) - 1;
      const d = parseInt(parts[2], 10);
      if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m, d);
      }
    }
    const parsed = new Date(dateStr);
    return isNaN(parsed.getTime()) ? null : parsed;
  }

  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    
    if (monthLabel) monthLabel.textContent = monthNames[month] || '';
    if (yearLabel) yearLabel.textContent = year;
    
    closeDropdowns();
    grid.innerHTML = '';
    
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const today = new Date();
    
    // Empty slots before first day
    for (let i = 0; i < firstDay; i++) {
      const emptyDiv = document.createElement('div');
      emptyDiv.className = 'h-8 w-8';
      grid.appendChild(emptyDiv);
    }
    
    // Selected date from target input
    let selectedDate = null;
    if (currentTargetInput && currentTargetInput.value) {
      selectedDate = parseDateParts(currentTargetInput.value);
    }

    for (let i = 1; i <= daysInMonth; i++) {
      const cellDate = new Date(year, month, i);
      const isToday = cellDate.getFullYear() === today.getFullYear() &&
                      cellDate.getMonth() === today.getMonth() &&
                      cellDate.getDate() === today.getDate();

      const isSelected = selectedDate &&
                         cellDate.getFullYear() === selectedDate.getFullYear() &&
                         cellDate.getMonth() === selectedDate.getMonth() &&
                         cellDate.getDate() === selectedDate.getDate();
      
      let classes = 'h-8 w-8 mx-auto flex items-center justify-center rounded-xl cursor-pointer transition-all duration-150 text-xs font-semibold ';
      if (isSelected) {
        classes += 'bg-linear-to-r from-[#028DA9] to-[#0BB5CB] text-white shadow-md shadow-[#028DA9]/25 scale-105';
      } else if (isToday) {
        classes += 'border border-[#028DA9]/40 text-[#028DA9] bg-[#028DA9]/10 font-bold hover:bg-[#028DA9]/20';
      } else {
        classes += 'text-slate-700 hover:bg-slate-100 hover:text-slate-900 active:scale-95';
      }
      
      const dayEl = document.createElement('div');
      dayEl.className = classes;
      dayEl.textContent = i;
      dayEl.addEventListener('click', () => {
        if (currentTargetInput) {
          const m = String(month + 1).padStart(2, '0');
          const d = String(i).padStart(2, '0');
          currentTargetInput.value = `${year}-${m}-${d}`;
          currentTargetInput.dispatchEvent(new Event('change', { bubbles: true }));
          currentTargetInput.dispatchEvent(new Event('input', { bubbles: true }));
        }
        closeDropdowns();
        window.closeDashboardModal(modal);
      });
      
      grid.appendChild(dayEl);
    }

    if (typeof feather !== 'undefined') {
      feather.replace();
    }
  }

  // Event listener for opening the date picker
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('.custom-date-picker') || e.target.closest('[data-date-trigger]');
    if (trigger) {
      e.preventDefault();
      currentTargetInput = trigger.matches('input') ? trigger : trigger.querySelector('input');
      if (!currentTargetInput) return;

      const parsed = parseDateParts(currentTargetInput.value);
      currentDate = parsed ? new Date(parsed.getTime()) : new Date();

      renderCalendar(currentDate);
      window.openDashboardModal('global-date-modal');
    }
  });

  // Month navigation
  if (prevBtn) {
    prevBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      currentDate.setDate(1);
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar(currentDate);
    });
  }
  
  if (nextBtn) {
    nextBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      currentDate.setDate(1);
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar(currentDate);
    });
  }
  
  if (todayBtn) {
    todayBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      if (currentTargetInput) {
        const today = new Date();
        const y = today.getFullYear();
        const m = String(today.getMonth() + 1).padStart(2, '0');
        const d = String(today.getDate()).padStart(2, '0');
        currentTargetInput.value = `${y}-${m}-${d}`;
        currentTargetInput.dispatchEvent(new Event('change', { bubbles: true }));
        currentTargetInput.dispatchEvent(new Event('input', { bubbles: true }));
      }
      closeDropdowns();
      window.closeDashboardModal(modal);
    });
  }

  if (clearBtn) {
    clearBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      if (currentTargetInput) {
        currentTargetInput.value = '';
        currentTargetInput.dispatchEvent(new Event('change', { bubbles: true }));
        currentTargetInput.dispatchEvent(new Event('input', { bubbles: true }));
      }
      closeDropdowns();
      window.closeDashboardModal(modal);
    });
  }
}


