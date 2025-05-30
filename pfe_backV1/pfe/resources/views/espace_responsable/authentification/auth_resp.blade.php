<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Authentification Responsable</title>  <!-- Changé de "Technicien" à "Responsable" -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --background-color: #f1f5f9;
      --grand_titre_color: #1e293b;
      --text-color: #1f2937;
      --secondary-color: #10b981;
      --secondary-hover-color: #059669;
      --input-border-color: #e5e7eb;
      --accent-color: #f59e0b;
      --accent-hover-color: #d97706;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.18);
    }
  </style>
</head>

<body class="font-[Poppins] flex items-center justify-center min-h-screen" style="background-color: var(--background-color)">
  <div class="w-full max-w-md p-8 rounded-xl glass-card shadow-xl">
    <h2 class="text-2xl font-bold text-center text-[var(--grand_titre_color)] mb-6">Connexion Responsable</h2>  <!-- Changé de "Technicien" à "Responsable" -->
    
    <!-- Afficher les erreurs -->
    @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ $errors->first() }}
      </div>
    @endif
    
    <form action="{{ route('responsable.login') }}" method="POST" class="space-y-4">  <!-- Modifié ici -->
      @csrf  <!-- Protection CSRF obligatoire dans Laravel -->
      
      <div>
        <label class="block mb-1 font-medium text-[var(--text-color)]">Matricule</label>
        <input type="text" name="matricule" value="{{ old('matricule') }}" required 
               class="w-full px-4 py-2 border rounded-lg border-[var(--input-border-color)] focus:outline-none focus:ring-2 focus:ring-[var(--secondary-color)]" />
    </div>
      <div>
        <label class="block mb-1 font-medium text-[var(--text-color)]">Mot de passe</label>
        <input type="password" name="password" required 
               class="w-full px-4 py-2 border rounded-lg border-[var(--input-border-color)] focus:outline-none focus:ring-2 focus:ring-[var(--secondary-color)]" />
      </div>
      <button type="submit" class="w-full py-2 bg-gradient-to-r from-[var(--secondary-color)] to-[var(--secondary-hover-color)] text-white font-semibold rounded-lg hover:scale-105 transition-transform">
        Se connecter
      </button>
    </form>
  </div>
</body>
</html>