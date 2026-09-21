/**
 * Gallery Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-gallery');
  const editPreviewContainer = document.getElementById('edit-gallery-preview');

  document.querySelectorAll('.btn-edit-gallery').forEach((btn) => {
    btn.addEventListener('click', () => {
      const item = JSON.parse(btn.getAttribute('data-gallery'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="title"]').value = item.title || '';
        editForm.querySelector('[name="event_date"]').value = item.event_date ? item.event_date.split('T')[0] : '';
        editForm.querySelector('[name="description"]').value = item.description || '';
      }

      if (editPreviewContainer) {
        if (item.image_url) {
          editPreviewContainer.innerHTML = `
            <p class="text-xs font-semibold text-slate-500 mb-1.5">Foto Saat Ini:</p>
            <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-1">
              <img src="${item.image_url}" alt="${item.title}" class="h-28 w-auto object-cover rounded-lg">
            </div>
          `;
          editPreviewContainer.classList.remove('hidden');
        } else {
          editPreviewContainer.innerHTML = '';
          editPreviewContainer.classList.add('hidden');
        }
      }

      window.openDashboardModal('modal-edit-gallery');
    });
  });
});
