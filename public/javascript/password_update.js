// Fonction pour afficher/masquer le mot de passe
function togglePasswordVisibility(fieldId) {
  const field = document.getElementById(fieldId);
  const toggleIcon = field.nextElementSibling.querySelector('i');

  if (field.type === 'password') {
    field.type = 'text';
    toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
  } else {
    field.type = 'password';
    toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
  }
}

// Fonction pour vérifier la force du mot de passe
function checkPasswordStrength(password) {
  const strengthBars = [
    document.getElementById('strength-bar-1'),
    document.getElementById('strength-bar-2'),
    document.getElementById('strength-bar-3'),
    document.getElementById('strength-bar-4')
  ];
  const strengthText = document.getElementById('password-strength-text');

  // Réinitialiser
  strengthBars.forEach(bar => {
    bar.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-green-500');
    bar.classList.add('bg-gray-200');
  });

  if (password.length === 0) {
    strengthText.textContent = '';
    return;
  }

  // Calculer la force
  let strength = 0;
  if (password.length > 7) strength++;
  if (password.length > 11) strength++;
  if (/[A-Z]/.test(password)) strength++;
  if (/[0-9]/.test(password)) strength++;
  if (/[^A-Za-z0-9]/.test(password)) strength++;

  strength = Math.min(strength, 4);

  // Mettre à jour l'UI
  for (let i = 0; i < strength; i++) {
    strengthBars[i].classList.remove('bg-gray-200');
    if (strength <= 2) {
      strengthBars[i].classList.add('bg-red-500');
    } else if (strength === 3) {
      strengthBars[i].classList.add('bg-yellow-500');
    } else {
      strengthBars[i].classList.add('bg-green-500');
    }
  }

  const messages = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
  strengthText.textContent = `Force du mot de passe: ${messages[strength]}`;
  strengthText.className = `text-xs ${strength <= 1 ? 'text-red-500' : strength <= 2 ? 'text-yellow-500' : 'text-green-500'}`;
}
