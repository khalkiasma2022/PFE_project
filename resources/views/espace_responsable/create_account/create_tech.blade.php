<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Créer un compte Technicien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background-color: #f0fdf4;
            --grand_titre_color: #166534;
            --text-color: #1a2e05;
            --primary-color: #10b981;
            --primary-hover-color: #059669;
            --input-border-color: #d1fae5;
            --accent-color: #34d399;
            --accent-hover-color: #10b981;
            --error-color: #ef4444;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(31, 83, 135, 0.1);
            border-radius: 1rem;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 to-white font-[Poppins] flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="glass-card p-8 transition-all duration-300 hover:shadow-xl">
            <!-- Logo/Titre -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[var(--primary-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-[var(--grand_titre_color)] mb-2">Créer un compte Technicien</h1>
                <p class="text-gray-600">Remplissez les informations requises</p>
            </div>

            <!-- Messages d'état -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-[var(--primary-color)] text-[var(--grand_titre_color)] rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[var(--primary-color)]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any()))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-[var(--error-color)] text-[var(--error-color)] rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Formulaire -->
            <form action="{{ route('createTechnicien') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Matricule -->
                <div>
                    <label for="Matricule_tech" class="block text-sm font-medium text-[var(--text-color)] mb-1">Matricule</label>
                    <div class="relative">
                        <input type="text" name="Matricule_tech" id="Matricule_tech"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                               placeholder="Tapez le matricule" required>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    @error('Matricule_tech')
                        <p class="mt-1 text-sm text-[var(--error-color)]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nom et Prénom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="Nom_tech" class="block text-sm font-medium text-[var(--text-color)] mb-1">Nom</label>
                        <div class="relative">
                            <input type="text" name="Nom_tech" id="Nom_tech"
                                   class="w-full px-4 py-3 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                                   placeholder="Votre nom" required>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        @error('Nom_tech')
                            <p class="mt-1 text-sm text-[var(--error-color)]">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="Prenom_tech" class="block text-sm font-medium text-[var(--text-color)] mb-1">Prénom</label>
                        <div class="relative">
                            <input type="text" name="Prenom_tech" id="Prenom_tech"
                                   class="w-full px-4 py-3 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                                   placeholder="Votre prénom" required>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        @error('Prenom_tech')
                            <p class="mt-1 text-sm text-[var(--error-color)]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- CIN -->
                <div>
                    <label for="CIN_tech" class="block text-sm font-medium text-[var(--text-color)] mb-1">CIN</label>
                    <div class="relative">
                        <input type="text" name="CIN_tech" id="CIN_tech"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                               placeholder="Numéro CIN" required>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    @error('CIN_tech')
                        <p class="mt-1 text-sm text-[var(--error-color)]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="Email_tech" class="block text-sm font-medium text-[var(--text-color)] mb-1">Email</label>
                    <div class="relative">
                        <input type="email" name="Email_tech" id="Email_tech"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                               placeholder="email@exemple.com" required>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @error('Email_tech')
                        <p class="mt-1 text-sm text-[var(--error-color)]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="Mot_de_passe" class="block text-sm font-medium text-[var(--text-color)] mb-1">Mot de passe</label>
                    <div class="relative">
                        <input type="password" name="Mot_de_passe" id="Mot_de_passe"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                               placeholder="••••••••" required>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    @error('Mot_de_passe')
                        <p class="mt-1 text-sm text-[var(--error-color)]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bouton de soumission -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white font-medium rounded-xl transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:ring-offset-2 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Créer le compte
                </button>

                <!-- Liens -->
                <div class="flex flex-col space-y-2 text-center text-sm">
                    <a href="{{ route('createResponsable') }}" class="text-[var(--primary-color)] hover:text-[var(--primary-hover-color)] transition duration-200">
                        Créer un compte Responsable
                    </a>
                    <a href="{{ route('createAccount_view') }}" class="text-gray-600 hover:text-[var(--primary-color)] transition duration-200">
                        Retour à la page précédente
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
