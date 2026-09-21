/**
 * Banners Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-banner');
  const editPreviewContainer = document.getElementById('edit-banner-preview');
  const createInput = document.getElementById('create-image');
  const createPreviewContainer = document.getElementById('create-banner-preview');
  const editInput = document.getElementById('edit-image');

  // Helper to render preview HTML with click-to-popup lightbox
  const renderPreviewHtml = (url, title, label = 'Pratinjau Gambar (Klik untuk memperbesar):') => `
    <p class="text-xs font-semibold text-slate-500 mb-1.5">${label}</p>
    <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1 group cursor-pointer"
         data-preview-image="${url}"
         data-preview-title="${title}"
         title="Klik untuk memperbesar gambar">
      <img src="${url}" alt="${title}" class="h-28 w-auto object-cover rounded-lg transition-transform duration-300 group-hover:scale-105">
      <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center pointer-events-none">
        <i data-feather="zoom-in" class="h-5 w-5 text-white drop-shadow-md"></i>
      </div>
    </div>
  `;

  // 1. Edit banner button clicks
  document.querySelectorAll('.btn-edit-banner').forEach((btn) => {
    btn.addEventListener('click', () => {
      const banner = JSON.parse(btn.getAttribute('data-banner'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="title"]').value = banner.title || '';
        editForm.querySelector('[name="description"]').value = banner.description || '';
        editForm.querySelector('[name="cta_label"]').value = banner.cta_label || '';
        editForm.querySelector('[name="cta_url"]').value = banner.cta_url || '';
        const activeCheckbox = editForm.querySelector('[name="is_active"]');
        if (activeCheckbox) {
          activeCheckbox.checked = Boolean(banner.is_active);
        }
        if (editInput) {
          editInput.value = '';
        }
      }

      if (editPreviewContainer) {
        if (banner.image_url) {
          editPreviewContainer.innerHTML = renderPreviewHtml(
            banner.image_url,
            banner.title || 'Gambar Banner',
            'Gambar Saat Ini (Klik untuk memperbesar):'
          );
          editPreviewContainer.classList.remove('hidden');
          if (typeof feather !== 'undefined') {
            feather.replace();
          }
        } else {
          editPreviewContainer.innerHTML = '';
          editPreviewContainer.classList.add('hidden');
        }
      }

      window.openDashboardModal('modal-edit-banner');
    });
  });

  // 2. Live preview for newly selected file in Create modal
  if (createInput && createPreviewContainer) {
    createInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (file && file.type.startsWith('image/')) {
        const objectUrl = URL.createObjectURL(file);
        createPreviewContainer.innerHTML = renderPreviewHtml(
          objectUrl,
          file.name,
          'Pratinjau File Terpilih (Klik untuk memperbesar):'
        );
        createPreviewContainer.classList.remove('hidden');
        if (typeof feather !== 'undefined') {
          feather.replace();
        }
      } else {
        createPreviewContainer.innerHTML = '';
        createPreviewContainer.classList.add('hidden');
      }
    });
  }

  // 3. Live preview for newly selected replacement file in Edit modal
  if (editInput && editPreviewContainer) {
    editInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (file && file.type.startsWith('image/')) {
        const objectUrl = URL.createObjectURL(file);
        editPreviewContainer.innerHTML = renderPreviewHtml(
          objectUrl,
          file.name,
          'Pratinjau Gambar Baru (Klik untuk memperbesar):'
        );
        editPreviewContainer.classList.remove('hidden');
        if (typeof feather !== 'undefined') {
          feather.replace();
        }
      }
    });
  }
});
