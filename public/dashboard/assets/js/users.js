/**
 * Users Page Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('form-edit-user');

  document.querySelectorAll('.btn-edit-user').forEach((btn) => {
    btn.addEventListener('click', () => {
      const user = JSON.parse(btn.getAttribute('data-user'));
      const updateUrl = btn.getAttribute('data-action');

      if (editForm) {
        editForm.action = updateUrl;
        editForm.querySelector('[name="name"]').value = user.name || '';
        editForm.querySelector('[name="email"]').value = user.email || '';
        editForm.querySelector('[name="password"]').value = '';

        const roleInput = editForm.querySelector('[name="role"]');
        if (roleInput) roleInput.value = user.role || 'operator_mutu';

        const activeCheckbox = editForm.querySelector('[name="is_active"]');
        if (activeCheckbox) {
          activeCheckbox.checked = Boolean(user.is_active);
        }
      }

      window.openDashboardModal('modal-edit-user');
    });
  });
});
