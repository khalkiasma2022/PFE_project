<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Changement de mot de passe | Espace Technicien</title>

  <!-- Liens CSS -->
  <link rel="stylesheet" href="{{ asset('espace_responsable_css/style_resp.css.css') }}">
  <link rel="stylesheet" href="{{ asset('espace_technicien/update_mdp.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Police & Icônes -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Ton thème personnalisé -->
  <style>
    :root {
      --background-color: #f8fafc;
      --grand_titre_color: #1e40af;
      --text-color: #1e3a8a;
      --primary-color: #3b82f6;
      --primary-hover-color: #2563eb;
      --input-border-color: #e2e8f0;
      --accent-color: #60a5fa;
      --accent-hover-color: #3b82f6;
      --error-color: #ef4444;
      --sidebar-color: #1e3a8a;
      --sidebar-hover: #1e40af;
    }
    body {
      background-color: var(--background-color);
      color: var(--text-color);
      font-family: 'Poppins', sans-serif;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
      border-radius: 1rem;
    }
    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
    .sidebar {
      transition: all 0.3s;
    }
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-md glass-card overflow-hidden">
    <!-- En-tête -->
    <div class="py-4 px-6 rounded-t-xl" style="background-color: var(--primary-color);">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">
          <i class="fas fa-user-shield mr-2"></i>Changer mot de passe
        </h1>
        <div class="bg-[var(--accent-color)] text-white px-3 py-1 rounded-full text-sm flex items-center">
          <i class="fas fa-tools mr-1"></i> Responsable
        </div>
      </div>
    </div>

    <!-- Messages d'erreur -->
    @include('espace_technicien.Update_mdp.error_msg')

    <!-- Formulaire -->
    <form method="POST" action="{{ route('update_mdp_action_resp') }}" class="p-6 space-y-6">
      @csrf

      <!-- Nouveau mot de passe -->
      <div class="space-y-2">
        <label for="password" class="block text-sm font-medium" style="color: var(--text-color);">
          <i class="fas fa-lock mr-1"></i> Nouveau mot de passe
        </label>
        <div class="relative">
          <input type="password" name="password" id="password" required
                 class="w-full px-4 py-3 border rounded-lg transition input-focus"
                 style="border-color: var(--input-border-color);"
                 placeholder="••••••••"
                 oninput="checkPasswordStrength(this.value)">
          <span class="absolute right-3 top-3 show-password-toggle" onclick="togglePasswordVisibility('password')">
            <i class="far fa-eye text-gray-400"></i>
          </span>
        </div>
        <div class="flex space-x-1">
          <div id="strength-bar-1" class="password-strength w-full bg-gray-200 rounded"></div>
          <div id="strength-bar-2" class="password-strength w-full bg-gray-200 rounded"></div>
          <div id="strength-bar-3" class="password-strength w-full bg-gray-200 rounded"></div>
          <div id="strength-bar-4" class="password-strength w-full bg-gray-200 rounded"></div>
        </div>
        <p id="password-strength-text" class="text-xs text-gray-500"></p>
      </div>

      <!-- Confirmation -->
      <div class="space-y-2">
        <label for="password_confirmation" class="block text-sm font-medium" style="color: var(--text-color);">
          <i class="fas fa-lock mr-1"></i> Confirmer le mot de passe
        </label>
        <div class="relative">
          <input type="password" name="password_confirmation" id="password_confirmation" required
                 class="w-full px-4 py-3 border rounded-lg transition input-focus"
                 style="border-color: var(--input-border-color);"
                 placeholder="••••••••">
          <span class="absolute right-3 top-3 show-password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
            <i class="far fa-eye text-gray-400"></i>
          </span>
        </div>
      </div>

      <!-- Bouton de soumission -->
      <div class="pt-4">
        <button type="submit"
                class="w-full text-white font-medium py-3 px-4 rounded-lg transition transform hover:scale-[1.01] flex items-center justify-center"
                style="background-color: var(--primary-color);"
                onmouseover="this.style.backgroundColor='var(--primary-hover-color)';"
                onmouseout="this.style.backgroundColor='var(--primary-color)';">
          <i class="fas fa-sync-alt mr-2"></i> Mettre à jour le mot de passe
        </button>
      </div>
    </form>

    <!-- Pied de page -->
    <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200 rounded-b-xl">
      <a href="{{ route('technicien.dashboard') }}" class="text-sm font-medium inline-flex items-center"
         style="color: var(--primary-color);">
        <i class="fas fa-arrow-left mr-1"></i> Retour au profil
      </a>
    </div>
  </div>

<script src="{{ asset('javascript/password_update.js') }}"></script>
</body>
</html>
