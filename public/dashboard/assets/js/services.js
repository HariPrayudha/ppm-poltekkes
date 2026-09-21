/**
 * Services Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-service');
  const editPreviewContainer = document.getElementById('edit-service-preview');

  document.querySelectorAll('.btn-edit-service').forEach((btn) => {
    btn.addEventListener('click', () => {
      const service = JSON.parse(btn.getAttribute('data-service'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="name"]').value = service.name || '';
        editForm.querySelector('[name="description"]').value = service.description || '';
        const activeCheckbox = editForm.querySelector('[name="is_active"]');
        if (activeCheckbox) {
          activeCheckbox.checked = Boolean(service.is_active);
        }
      }

      if (editPreviewContainer) {
        if (service.icon_url) {
          editPreviewContainer.innerHTML = `
            <p class="text-xs font-semibold text-slate-500 mb-1.5">Ikon Saat Ini:</p>
            <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-2">
              <img src="${service.icon_url}" alt="${service.name}" class="h-12 w-12 object-contain rounded-lg">
            </div>
          `;
          editPreviewContainer.classList.remove('hidden');
        } else {
          editPreviewContainer.innerHTML = '';
          editPreviewContainer.classList.add('hidden');
        }
      }

      window.openDashboardModal('modal-edit-service');
    });
  });
});
