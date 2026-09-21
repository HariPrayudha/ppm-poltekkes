/**
 * Banners Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-banner');
  const editPreviewContainer = document.getElementById('edit-banner-preview');

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
      }

      if (editPreviewContainer) {
        if (banner.image_url) {
          editPreviewContainer.innerHTML = `
            <p class="text-xs font-semibold text-slate-500 mb-1.5">Gambar Saat Ini:</p>
            <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1">
              <img src="${banner.image_url}" alt="${banner.title}" class="h-28 w-auto object-cover rounded-lg">
            </div>
          `;
          editPreviewContainer.classList.remove('hidden');
        } else {
          editPreviewContainer.innerHTML = '';
          editPreviewContainer.classList.add('hidden');
        }
      }

      window.openDashboardModal('modal-edit-banner');
    });
  });
});
