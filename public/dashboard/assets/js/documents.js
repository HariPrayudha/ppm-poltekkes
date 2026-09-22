/**
 * Documents & SOP Page Scripts
 * Handles Edit Modal population, Live PDF file previews, and jQuery Instant AJAX Filters
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-document');
  const createFileInput = document.getElementById('create-doc-file');
  const createPdfPreview = document.getElementById('create-pdf-preview');
  const editFileInput = document.getElementById('edit-doc-file');
  const editExistingPreview = document.getElementById('edit-existing-pdf-preview');
  const editNewPreview = document.getElementById('edit-new-pdf-preview');

  let createSelectedFile = null;
  let editSelectedFile = null;

  // Format file size helper
  const formatFileSize = (bytes) => {
    if (!bytes) return '';
    if (bytes >= 1048576) {
      return (bytes / 1048576).toFixed(2) + ' MB';
    } else if (bytes >= 1024) {
      return (bytes / 1024).toFixed(1) + ' KB';
    }
    return bytes + ' B';
  };

  // Render PDF Preview Card Helper
  const renderPdfPreviewCard = (name, sizeText, previewType, target = 'create', previewUrl = null, downloadUrl = null) => `
    <p class="text-xs font-semibold text-slate-500 mb-1.5">${previewType}</p>
    <div class="flex items-center justify-between p-3 rounded-2xl border border-slate-200 bg-slate-50 hover:bg-slate-100/80 transition-colors">
      <div class="flex items-center gap-3 min-w-0 pr-3">
        <div class="h-10 w-10 shrink-0 rounded-xl bg-rose-50 border border-rose-200/60 flex items-center justify-center text-rose-600 font-bold text-xs uppercase tracking-wider shadow-2xs">
          PDF
        </div>
        <div class="min-w-0">
          <p class="text-xs font-bold text-slate-800 truncate">${name}</p>
          ${sizeText ? `<p class="text-[11px] text-slate-400 mt-0.5">${sizeText}</p>` : ''}
        </div>
      </div>
      <button type="button"
              class="shrink-0 btn-secondary py-1.5 px-3 text-xs flex items-center gap-1.5 text-[#028DA9] border-[#028DA9]/20 hover:bg-[#028DA9]/10 cursor-pointer shadow-2xs ${previewUrl ? 'btn-preview-existing-pdf' : 'btn-preview-local-pdf'}"
              ${previewUrl ? `data-preview-pdf="${previewUrl}" data-download-url="${downloadUrl || previewUrl}" data-preview-title="${name}"` : `data-target="${target}"`}>
        <i data-feather="eye" class="h-3.5 w-3.5"></i>
        <span>Pratinjau PDF</span>
      </button>
    </div>
  `;

  // 1. Live preview for newly selected file in Create modal
  if (createFileInput && createPdfPreview) {
    createFileInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (file && file.type === 'application/pdf') {
        createSelectedFile = file;
        createPdfPreview.innerHTML = renderPdfPreviewCard(
          file.name,
          formatFileSize(file.size),
          'Berkas PDF Terpilih (Siap Diunggah):',
          'create'
        );
        createPdfPreview.classList.remove('hidden');
        if (typeof feather !== 'undefined') feather.replace();
      } else {
        createSelectedFile = null;
        createPdfPreview.innerHTML = '';
        createPdfPreview.classList.add('hidden');
      }
    });
  }

  // 2. Live preview for newly selected file in Edit modal
  if (editFileInput && editNewPreview) {
    editFileInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (file && file.type === 'application/pdf') {
        editSelectedFile = file;
        editNewPreview.innerHTML = renderPdfPreviewCard(
          file.name,
          formatFileSize(file.size),
          'Berkas PDF Baru (Pengganti):',
          'edit'
        );
        editNewPreview.classList.remove('hidden');
        if (typeof feather !== 'undefined') feather.replace();
      } else {
        editSelectedFile = null;
        editNewPreview.innerHTML = '';
        editNewPreview.classList.add('hidden');
      }
    });
  }

  // Handle local PDF preview button clicks inside create/edit cards
  document.addEventListener('click', (e) => {
    const localBtn = e.target.closest('.btn-preview-local-pdf');
    if (localBtn) {
      e.preventDefault();
      const target = localBtn.getAttribute('data-target');
      const file = target === 'create' ? createSelectedFile : editSelectedFile;
      if (file && typeof window.openPdfPreviewModal === 'function') {
        const blobUrl = URL.createObjectURL(file);
        window.openPdfPreviewModal(blobUrl, file.name, blobUrl);
      }
    }
  });

  // 3. Edit document button clicks (using delegation for AJAX resilience)
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-edit-document');
    if (!btn) return;

    const doc = JSON.parse(btn.getAttribute('data-document'));
    const updateUrl = btn.getAttribute('data-action');

    if (editForm) {
      editForm.action = updateUrl;
      if (editForm.querySelector('[name="code"]')) {
        editForm.querySelector('[name="code"]').value = doc.code || '';
      }
      if (editForm.querySelector('[name="name"]')) {
        editForm.querySelector('[name="name"]').value = doc.name || '';
      }

      // Category custom select sync
      const catSelect = editForm.querySelector('[name="document_category_id"]');
      if (catSelect) {
        catSelect.value = doc.document_category_id || '';
        catSelect.dispatchEvent(new Event('change', { bubbles: true }));
      }

      // Year custom select sync
      const yrSelect = editForm.querySelector('[name="year"]');
      if (yrSelect) {
        yrSelect.value = doc.year || '';
        yrSelect.dispatchEvent(new Event('change', { bubbles: true }));
      }

      // Reset file input and new preview
      if (editFileInput) editFileInput.value = '';
      editSelectedFile = null;
      if (editNewPreview) {
        editNewPreview.innerHTML = '';
        editNewPreview.classList.add('hidden');
      }

      // Existing file preview
      if (editExistingPreview) {
        if (doc.file_url) {
          editExistingPreview.innerHTML = renderPdfPreviewCard(
            (doc.name || 'Dokumen') + '.pdf',
            doc.formatted_file_size || '',
            'Berkas PDF Saat Ini:',
            'edit-existing',
            doc.preview_url || doc.file_url,
            doc.file_url
          );
          editExistingPreview.classList.remove('hidden');
          if (typeof feather !== 'undefined') feather.replace();
        } else {
          editExistingPreview.innerHTML = '';
          editExistingPreview.classList.add('hidden');
        }
      }
    }

    if (typeof window.openDashboardModal === 'function') {
      window.openDashboardModal('modal-edit-document');
    }
  });

  // 4. jQuery Instant Search & Filter without Page Refresh (AJAX)
  if (typeof window.jQuery !== 'undefined') {
    const $ = window.jQuery;
    const $form = $('#filter-form');
    const $container = $('#documents-table-container');
    const $resetWrapper = $('#reset-filter-wrapper');

    const updateResetButtonVisibility = () => {
      const searchVal = ($('#filter-search-input').val() || '').trim();
      const catVal = $('#filter-category').val();
      const yrVal = $('#filter-year').val();

      if (searchVal || catVal || yrVal) {
        $resetWrapper.removeClass('hidden');
      } else {
        $resetWrapper.addClass('hidden');
      }
    };

    const fetchDocuments = (url = null) => {
      updateResetButtonVisibility();

      const fetchUrl = url || ($form.attr('action') + '?' + $form.serialize());
      $container.addClass('opacity-50 pointer-events-none');

      $.ajax({
        url: fetchUrl,
        type: 'GET',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
        },
        success: (html) => {
          $container.html(html);
          $container.removeClass('opacity-50 pointer-events-none');
          if (typeof feather !== 'undefined') feather.replace();
          window.history.replaceState(null, '', fetchUrl);
        },
        error: (xhr) => {
          $container.removeClass('opacity-50 pointer-events-none');
          console.error('Gagal memuat data dokumen:', xhr);
        },
      });
    };

    // Prevent standard full-page form submission
    $form.on('submit', (e) => {
      e.preventDefault();
      fetchDocuments();
    });

    // Auto update on Category or Year change
    $form.on('change', '#filter-category, #filter-year', () => {
      fetchDocuments();
    });

    // Auto update on Search typing (debounced)
    let searchTimer = null;
    $('#filter-search-input').on('input', () => {
      clearTimeout(searchTimer);
      searchTimer = setTimeout(() => {
        fetchDocuments();
      }, 350);
    });

    // Reset filter button click (no page reload)
    $(document).on('click', '#btn-reset-filter', (e) => {
      e.preventDefault();
      $('#filter-search-input').val('');

      // Reset native selects and trigger change for custom selects
      const catSelect = document.getElementById('filter-category');
      if (catSelect) {
        catSelect.value = '';
        catSelect.dispatchEvent(new Event('change', { bubbles: true }));
      }

      const yrSelect = document.getElementById('filter-year');
      if (yrSelect) {
        yrSelect.value = '';
        yrSelect.dispatchEvent(new Event('change', { bubbles: true }));
      }

      fetchDocuments($form.attr('action'));
    });

    // Handle pagination links via AJAX
    $(document).on('click', '#documents-table-container nav a', function (e) {
      e.preventDefault();
      const pageUrl = $(this).attr('href');
      if (pageUrl) {
        fetchDocuments(pageUrl);
      }
    });
  }
});
