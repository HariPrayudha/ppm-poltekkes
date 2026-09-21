/**
 * Greeting Page Scripts (TinyMCE Initialization)
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize TinyMCE
  if (typeof tinymce !== 'undefined') {
    tinymce.init({
      selector: '#content',
      plugins: 'lists link table code preview visualblocks wordcount',
      toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | alignleft aligncenter alignright | link table | code preview',
      menubar: false,
      height: 380,
      content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6; color: #334155; }',
      branding: false,
      promotion: false,
    });
  }

  // Photo live preview
  const photoInput = document.getElementById('photo-input');
  const previewImg = document.getElementById('photo-preview-img');

  if (photoInput && previewImg) {
    photoInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          previewImg.src = event.target.result;
          previewImg.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }
    });
  }
});
