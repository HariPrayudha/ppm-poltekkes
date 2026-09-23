/**
 * Profile Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize TinyMCE for Duties & Functions
  if (typeof tinymce !== 'undefined') {
    tinymce.init({
      selector: '#duties_content',
      plugins: 'lists link table code preview visualblocks wordcount',
      toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | alignleft aligncenter alignright | link table | code preview',
      menubar: false,
      height: 420,
      elementpath: false,
      content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6; color: #334155; }',
      branding: false,
      promotion: false,
    });
  }

  // Org chart preview
  const chartInput = document.getElementById('chart-input');
  const previewImg = document.getElementById('chart-preview-img');
  const previewContainer = document.getElementById('chart-preview-container');
  const previewWrapper = document.getElementById('chart-preview-wrapper');

  if (chartInput && previewImg) {
    chartInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          previewImg.src = event.target.result;
          if (previewWrapper) {
            previewWrapper.setAttribute('data-preview-image', event.target.result);
          }
          if (previewContainer) previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }
    });
  }
});
