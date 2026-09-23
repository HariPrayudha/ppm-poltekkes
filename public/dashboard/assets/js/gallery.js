/**
 * Gallery Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-gallery');
  const editPreviewContainer = document.getElementById('edit-gallery-preview');

  // Function to generate image preview HTML
  const generatePreviewHTML = (url, title, label = "Pratinjau Gambar") => {
    return `
      <p class="text-xs font-semibold text-slate-500 mb-1.5">${label}:</p>
      <div class="relative inline-block overflow-hidden rounded-xl border border-slate-200 bg-slate-100 group cursor-pointer"
           data-preview-image="${url}"
           data-preview-title="${title}"
           title="Klik untuk memperbesar foto">
        <img src="${url}" alt="${title}" class="h-28 w-auto object-cover rounded-xl transition-transform duration-300 group-hover:scale-105">
        <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center pointer-events-none">
          <i data-feather="zoom-in" class="h-5 w-5 text-white drop-shadow-md"></i>
        </div>
      </div>
    `;
  };

  // Local Image Preview Handler
  const handleLocalPreview = (inputId, previewContainerId, label) => {
    const input = document.getElementById(inputId);
    const container = document.getElementById(previewContainerId);
    
    if (input && container) {
      input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          if (file.size > 2 * 1024 * 1024) {
            if (typeof showToast === 'function') {
              showToast('Ukuran file melebihi batas maksimal 2MB.', 'error');
            } else {
              alert('Ukuran file melebihi batas maksimal 2MB.');
            }
            this.value = '';
            if (inputId === 'create-gallery-img') {
              container.innerHTML = '';
              container.classList.add('hidden');
            }
            return;
          }
          const url = URL.createObjectURL(file);
          container.innerHTML = generatePreviewHTML(url, file.name, label);
          if (typeof feather !== 'undefined') {
            feather.replace();
          }
          container.classList.remove('hidden');
        } else {
          // If no file selected, we might want to clear or reset. 
          if (inputId === 'create-gallery-img') {
             container.innerHTML = '';
             container.classList.add('hidden');
          }
        }
      });
    }
  };

  handleLocalPreview('create-gallery-img', 'create-gallery-preview', 'Pratinjau Gambar Terpilih');
  handleLocalPreview('edit-gallery-img', 'edit-gallery-preview', 'Pratinjau Gambar Baru Terpilih');

  document.querySelectorAll('.btn-edit-gallery').forEach((btn) => {
    btn.addEventListener('click', () => {
      const item = JSON.parse(btn.getAttribute('data-gallery'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="title"]').value = item.title || '';
        
        const dateInput = editForm.querySelector('[name="event_date"]');
        if (dateInput) {
            dateInput.value = item.event_date ? item.event_date.split('T')[0] : '';
        }
        
        editForm.querySelector('[name="description"]').value = item.description || '';
      }

      // Reset the file input so change event can trigger again for the same file if needed
      const editImgInput = document.getElementById('edit-gallery-img');
      if (editImgInput) editImgInput.value = '';

      if (editPreviewContainer) {
        if (item.image_url) {
          editPreviewContainer.innerHTML = generatePreviewHTML(item.image_url, item.title, 'Foto Saat Ini (Klik untuk memperbesar)');
          if (typeof feather !== 'undefined') {
            feather.replace();
          }
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
