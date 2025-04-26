<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Authentification Responsable</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
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
  </style>
</head>

<body class="font-[Poppins] flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-white">
  <div class="w-full max-w-md p-8 mx-4 glass-card transition-all duration-300 hover:shadow-2xl">
    <div class="flex justify-center mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[var(--primary-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
      </svg>
    </div>
    <h2 class="text-3xl font-bold text-center text-[var(--grand_titre_color)] mb-2">Connexion Responsable</h2>
    <p class="text-center text-gray-500 mb-8">Accédez à votre espace d'administration</p>

    <!-- Afficher les erreurs -->
    @if($errors->any())
      <div class="bg-red-50 border-l-4 border-[var(--error-color)] text-[var(--error-color)] p-4 rounded mb-6 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('responsable.login') }}" method="POST" class="space-y-6">
      @csrf

      <div class="space-y-2">
        <label class="block text-sm font-medium text-[var(--text-color)]">Matricule</label>
        <div class="relative">
          <input type="text" name="matricule" value="{{ old('matricule') }}" required
                 class="w-full px-4 py-3 border rounded-xl border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition-all duration-200 pl-10" placeholder="Votre matricule"/>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>
      </div>

      <div class="space-y-2">
        <label class="block text-sm font-medium text-[var(--text-color)]">Mot de passe</label>
        <div class="relative">
          <input type="password" name="password" required
                 class="w-full px-4 py-3 border rounded-xl border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition-all duration-200 pl-10" placeholder="Votre mot de passe"/>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-[var(--primary-color)] focus:ring-[var(--primary-color)] border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
        </div>
        <div class="text-sm">
          <a href="#" class="font-medium text-[var(--primary-color)] hover:text-[var(--primary-hover-color)]">Mot de passe oublié?</a>
        </div>
      </div>

      <button type="submit" class="w-full py-3 px-4 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
        </svg>
        Se connecter
      </button>
      <div class="mt-6 text-center text-sm text-gray-500">
        <p>Êtes-vous technicien ?
          <a href="{{route('auth_tech_view')}}" class="font-medium text-[var(--primary-color)] hover:text-[var(--primary-hover-color)] transition-all duration-200">
          Accédez à l'espace technicien
          </a>
        </p>
      </div>
      <div class="mt-6 text-center text-sm text-gray-500">
        <a href="{{route('first_page')}}">Souhaitez-vous revenir à la page de sélection de l'espace ?</a>
      </div>
    </form>


  </div>
</body>
</html>
