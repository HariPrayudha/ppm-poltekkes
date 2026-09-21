/**
 * Related Links Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-link');
  const editPreviewContainer = document.getElementById('edit-link-preview');
  const createInput = document.getElementById('create-logo');
  const createPreviewContainer = document.getElementById('create-link-preview');
  const editInput = document.getElementById('edit-logo');

  // Helper to render preview HTML with click-to-popup lightbox
  const renderPreviewHtml = (url, title, label = 'Logo (Klik untuk memperbesar):') => `
    <p class="text-xs font-semibold text-slate-500 mb-1.5">${label}</p>
    <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-100 group cursor-pointer"
         data-preview-image="${url}"
         data-preview-title="${title}"
         title="Klik untuk memperbesar logo">
      <img src="${url}" alt="${title}" class="h-20 w-36 object-cover rounded-xl transition-transform duration-300 group-hover:scale-105">
      <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center pointer-events-none">
        <i data-feather="zoom-in" class="h-5 w-5 text-white drop-shadow-md"></i>
      </div>
    </div>
  `;

  // 1. Edit link button clicks
  document.querySelectorAll('.btn-edit-link').forEach((btn) => {
    btn.addEventListener('click', () => {
      const link = JSON.parse(btn.getAttribute('data-link'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="name"]').value = link.name || '';
        editForm.querySelector('[name="url"]').value = link.url || '';
        if (editInput) {
          editInput.value = '';
        }
      }

      if (editPreviewContainer) {
        if (link.logo_url) {
          editPreviewContainer.innerHTML = renderPreviewHtml(
            link.logo_url,
            link.name || 'Logo Link Terkait',
            'Logo Saat Ini (Klik untuk memperbesar):'
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

      window.openDashboardModal('modal-edit-link');
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
          'Pratinjau Logo Terpilih (Klik untuk memperbesar):'
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
          'Pratinjau Logo Baru (Klik untuk memperbesar):'
        );
        editPreviewContainer.classList.remove('hidden');
        if (typeof feather !== 'undefined') {
          feather.replace();
        }
      }
    });
  }
});
