<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de Compte | Espace Responsable</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --background-color: #f8fafc;
            --grand_titre_color: #1e40af;
            --text-color: #1e3a8a;
            --primary-color: #3b82f6; /* Bleu pour responsable */
            --primary-hover-color: #2563eb;
            --technicien-color: #10b981; /* Vert pour technicien */
            --technicien-hover: #0d9f6e;
            --input-border-color: #e2e8f0;
            --sidebar-color: #1e3a8a;
            --sidebar-hover: #1e40af;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            border-radius: 1rem;
        }
        .header-gradient {
            background: linear-gradient(135deg, var(--grand_titre_color) 0%, var(--primary-color) 100%);
        }
    </style>
</head>
<body class="font-[Poppins] bg-gradient-to-br from-blue-50 to-white min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl">
        <div class="glass-card overflow-hidden">
            <!-- En-tête avec dégradé bleu -->
            <div class="header-gradient p-6 text-center text-white">
                <h1 class="text-2xl font-bold flex items-center justify-center">
                    <i class="fas fa-user-edit mr-3"></i>Modification de Compte
                </h1>
                <p class="opacity-90 mt-2">Sélectionnez le type de compte à modifier</p>
            </div>

            <!-- Boutons de choix -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bouton Technicien (Vert) -->
                <a href="{{ route('updateTechnicien') }}"
                   class="group relative flex flex-col items-center p-6 bg-white rounded-xl border border-[var(--input-border-color)] shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-green-100 p-3 rounded-full shadow-md">
                        <i class="fas fa-user-cog text-[var(--technicien-color)] text-xl"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-[var(--grand_titre_color)]">Technicien</h3>
                    <p class="mt-2 text-sm text-gray-600 text-center">Modifier les informations d'un compte technicien</p>
                    <div class="mt-4 px-4 py-2 bg-green-100 text-[var(--technicien-color)] rounded-full text-sm font-medium group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-edit mr-1"></i> Modifier
                    </div>
                </a>

                <!-- Bouton Responsable (Bleu) -->
                <a href="{{ route('updateResponsable') }}"
                   class="group relative flex flex-col items-center p-6 bg-white rounded-xl border border-[var(--input-border-color)] shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-blue-100 p-3 rounded-full shadow-md">
                        <i class="fas fa-user-shield text-[var(--primary-color)] text-xl"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-semibold text-[var(--grand_titre_color)]">Responsable</h3>
                    <p class="mt-2 text-sm text-gray-600 text-center">Modifier les informations d'un compte responsable</p>
                    <div class="mt-4 px-4 py-2 bg-blue-100 text-[var(--primary-color)] rounded-full text-sm font-medium group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-edit mr-1"></i> Modifier
                    </div>
                </a>
            </div>

            <!-- Pied de page -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t border-[var(--input-border-color)]">
                <a href="{{route('gestion_utilisateurs_view')}}" class="text-sm text-[var(--primary-color)] hover:underline flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste des utilisateurs
                </a>
            </div>
        </div>
    </div>

</body>
</html>
