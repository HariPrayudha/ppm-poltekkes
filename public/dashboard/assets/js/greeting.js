/**
 * Greeting Page Scripts (TinyMCE Initialization & Photo Lightbox Preview)
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize TinyMCE with clean status bar (hide 'p' elementpath)
  if (typeof tinymce !== 'undefined') {
    tinymce.init({
      selector: '#content',
      plugins: 'lists link table code preview visualblocks wordcount',
      toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | alignleft aligncenter alignright | link table | code preview',
      menubar: false,
      height: 350,
      elementpath: false, // Disables the HTML element path ('p') indicator in statusbar
      content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6; color: #334155; }',
      branding: false,
      promotion: false,
    });
  }

  // Photo live preview and lightbox trigger update
  const photoInput = document.getElementById('photo-input');
  const previewImg = document.getElementById('photo-preview-img');
  const previewWrapper = document.getElementById('photo-preview-wrapper');

  if (photoInput && previewImg) {
    photoInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (file && file.type.startsWith('image/')) {
        const objectUrl = URL.createObjectURL(file);
        previewImg.src = objectUrl;
        previewImg.classList.remove('hidden');

        if (previewWrapper) {
          previewWrapper.setAttribute('data-preview-image', objectUrl);
          previewWrapper.setAttribute('data-preview-title', 'Pratinjau Foto: ' + file.name);
        }
      }
    });
  }
});
