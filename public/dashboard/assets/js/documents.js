/**
 * Documents & SOP Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-document');
  const pdfFrame = document.getElementById('pdf-preview-frame');
  const pdfTitle = document.getElementById('pdf-preview-title');

  // Edit document handler
  document.querySelectorAll('.btn-edit-document').forEach((btn) => {
    btn.addEventListener('click', () => {
      const doc = JSON.parse(btn.getAttribute('data-document'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="document_category_id"]').value = doc.document_category_id;
        editForm.querySelector('[name="code"]').value = doc.code || '';
        editForm.querySelector('[name="name"]').value = doc.name || '';
        editForm.querySelector('[name="year"]').value = doc.year || '';
      }

      window.openDashboardModal('modal-edit-document');
    });
  });

  // PDF Preview handler
  document.querySelectorAll('.btn-preview-pdf').forEach((btn) => {
    btn.addEventListener('click', () => {
      const fileUrl = btn.getAttribute('data-file-url');
      const title = btn.getAttribute('data-doc-title') || 'Pratinjau Dokumen';

      if (pdfTitle) pdfTitle.textContent = title;
      if (pdfFrame) pdfFrame.src = fileUrl;

      window.openDashboardModal('modal-preview-pdf');
    });
  });

  // Reset iframe src when modal is closed
  const previewModal = document.getElementById('modal-preview-pdf');
  if (previewModal) {
    const observer = new MutationObserver(() => {
      if (previewModal.classList.contains('hidden') && pdfFrame) {
        pdfFrame.src = '';
      }
    });
    observer.observe(previewModal, { attributes: true, attributeFilter: ['class'] });
  }
});
