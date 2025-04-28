<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Changement de mot de passe | Espace Technicien</title>
  <link rel="stylesheet" href="{{ asset('espace_technicien/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('espace_technicien/update_mdp.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body class="min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-md glass-card overflow-hidden">
    <!-- En-tête -->
    <div class="bg-green-600 py-4 px-6 rounded-t-xl">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">
          <i class="fas fa-user-shield mr-2"></i>Changer mot de passe
        </h1>
        <div class="bg-green-500 text-white px-3 py-1 rounded-full text-sm flex items-center">
          <i class="fas fa-tools mr-1"></i> Technicien
        </div>
      </div>
    </div>

    <!-- Messages d'erreur -->
    @include('espace_technicien.Update_mdp.error_msg')

    <!-- Formulaire -->
    <form method="POST" action="{{ route('update_mdp_action') }}" class="p-6 space-y-6">
      @csrf

      <!-- Champ Nouveau mot de passe -->
      <div class="space-y-2">
        <label for="password" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-lock mr-1"></i> Nouveau mot de passe
        </label>
        <div class="relative">
          <input type="password" name="password" id="password" required
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
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

      <!-- Champ Confirmation -->
      <div class="space-y-2">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
          <i class="fas fa-lock mr-1"></i> Confirmer le mot de passe
        </label>
        <div class="relative">
          <input type="password" name="password_confirmation" id="password_confirmation" required
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                 placeholder="••••••••">
          <span class="absolute right-3 top-3 show-password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
            <i class="far fa-eye text-gray-400"></i>
          </span>
        </div>
      </div>

      <!-- Bouton de soumission -->
      <div class="pt-4">
        <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition transform hover:scale-[1.01] flex items-center justify-center">
          <i class="fas fa-sync-alt mr-2"></i> Mettre à jour le mot de passe
        </button>
      </div>
    </form>

    <!-- Pied de page -->
    <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200 rounded-b-xl">
      <a href="{{ route('technicien.dashboard') }}" class="text-green-600 hover:text-green-800 text-sm font-medium inline-flex items-center">
        <i class="fas fa-arrow-left mr-1"></i> Retour au profil
      </a>
    </div>
  </div>

<script src="{{ asset('javascript/password_update.js') }}"></script>
</body>
</html>
