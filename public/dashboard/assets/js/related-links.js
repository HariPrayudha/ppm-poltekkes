/**
 * Related Links Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-link');
  const editPreviewContainer = document.getElementById('edit-link-preview');

  document.querySelectorAll('.btn-edit-link').forEach((btn) => {
    btn.addEventListener('click', () => {
      const link = JSON.parse(btn.getAttribute('data-link'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="name"]').value = link.name || '';
        editForm.querySelector('[name="url"]').value = link.url || '';
      }

      if (editPreviewContainer) {
        if (link.logo_url) {
          editPreviewContainer.innerHTML = `
            <p class="text-xs font-semibold text-slate-500 mb-1.5">Logo Saat Ini:</p>
            <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-2">
              <img src="${link.logo_url}" alt="${link.name}" class="h-10 w-auto object-contain rounded">
            </div>
          `;
          editPreviewContainer.classList.remove('hidden');
        } else {
          editPreviewContainer.innerHTML = '';
          editPreviewContainer.classList.add('hidden');
        }
      }

      window.openDashboardModal('modal-edit-link');
    });
  });
});
