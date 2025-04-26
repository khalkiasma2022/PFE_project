<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier compte technicien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --background-color: #f8fafc;
            --grand_titre_color: #166534; /* Vert foncé pour le titre */
            --text-color: #1e3a8a;
            --primary-color: #16a34a; /* Vert principal */
            --primary-hover-color: #15803d; /* Vert plus foncé au survol */
            --input-border-color: #d1fae5; /* Bordure verte claire */
            --success-color: #16a34a;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --sidebar-color: #166534;
            --sidebar-hover: #15803d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-color);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(22, 163, 74, 0.1); /* Ombre verte subtile */
            border-radius: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover-color);
        }

        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(22, 163, 74, 0.3); /* Lueur verte */
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border-color: #bbf7d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-color: #fde68a;
        }

        .link {
            color: var(--primary-color);
        }

        .link:hover {
            color: var(--primary-hover-color);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-green-50 to-white">
    <div class="w-full max-w-md">
        <div class="glass-card p-6 rounded-xl border border-green-100">
            <!-- En-tête -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-[var(--grand_titre_color)] mb-1 flex items-center justify-center">
                    <i class="fas fa-user-cog mr-2"></i>Modifier compte technicien
                </h1>
                <p class="text-sm text-gray-600">Mettez à jour les informations du technicien</p>
            </div>

            <!-- Messages d'état -->
            @if (session('success'))
                <div class="mb-4 p-3 rounded-lg flex items-center alert-success">
                    <i class="fas fa-check-circle mr-2 text-green-600"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 rounded-lg flex items-center alert-error">
                    <i class="fas fa-exclamation-circle mr-2 text-red-600"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any()))
                <div class="mb-4 p-3 rounded-lg alert-warning">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-yellow-600"></i>
                        <span class="font-medium">Veuillez corriger les erreurs suivantes :</span>
                    </div>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire -->
            <form action="{{ route('updateTechnicien') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Matricule -->
                <div>
                    <label for="matricule" class="block text-sm font-medium text-gray-700 mb-1">Matricule <span class="text-xs text-gray-500">(obligatoire)</span></label>
                    <div class="relative">
                        <input type="text" id="matricule" name="matricule_tech_obligatoire" required
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="Entrez le matricule">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Nom et Prénom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="Prenom_tech" class="block text-sm font-medium text-gray-700 mb-1">Prénom <span class="text-xs text-gray-500">(optionnel)</span></label>
                        <input type="text" id="Prenom_tech" name="Prenom_tech"
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="Nouveau Prénom">
                    </div>
                    <div>
                        <label for="Nom_tech" class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-xs text-gray-500">(optionnel)</span></label>
                        <input type="text" id="Nom_tech" name="Nom_tech"
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="Nouveau Nom">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-xs text-gray-500">(optionnel)</span></label>
                    <div class="relative">
                        <input type="email" id="email" name="email_tech"
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="email@exemple.com">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Nouveau email Exemple : nom@mail.com</p>
                </div>

                <!-- Matricule optionnel -->
                <div>
                    <label for="matricule_opt" class="block text-sm font-medium text-gray-700 mb-1">Nouveau matricule <span class="text-xs text-gray-500">(optionnel)</span></label>
                    <div class="relative">
                        <input type="text" id="matricule_opt" name="matricule_tech"
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="Nouveau matricule">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-badge text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- CIN -->
                <div>
                    <label for="cin" class="block text-sm font-medium text-gray-700 mb-1">CIN <span class="text-xs text-gray-500">(optionnel)</span></label>
                    <div class="relative">
                        <input type="text" id="cin" name="cin_tech"
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="Nouveau Numéro CIN">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-address-card text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe <span class="text-xs text-gray-500">(optionnel)</span></label>
                    <div class="relative">
                        <input type="password" id="password" name="password_tech"
                            class="w-full px-4 py-2.5 rounded-lg border border-[var(--input-border-color)] focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent transition"
                            placeholder="••••••••">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Doit contenir au moins 6 caractères</p>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('UpdateAccount_view') }}" class="px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2.5 rounded-lg bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white transition transform hover:scale-[1.02]">
                        <i class="fas fa-save mr-1"></i> Enregistrer
                    </button>
                </div>

                <!-- Liens -->
                <div class="mt-4 text-center text-sm">
                    <a href="{{ route('updateResponsable') }}" class="text-[var(--primary-color)] hover:underline">
                        <i class="fas fa-user-shield mr-1"></i> Modifier compte Responsable
                    </a>
                </div>
                <div class="mt-2 text-center">
                    <a href="{{ route('UpdateAccount_view') }}" class="text-sm link">Retourner à la page précédente</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
