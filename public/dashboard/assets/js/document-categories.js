/**
 * Document Categories Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-category');

  document.querySelectorAll('.btn-edit-category').forEach((btn) => {
    btn.addEventListener('click', () => {
      const category = JSON.parse(btn.getAttribute('data-category'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="name"]').value = category.name || '';
      }

      window.openDashboardModal('modal-edit-category');
    });
  });
});
