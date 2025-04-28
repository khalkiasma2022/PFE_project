<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Technicien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
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
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(6, 95, 70, 0.1);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="min-h-screen flex">
     <!-- Sidebar -->
     @include('espace_technicien.NavBar.navbar_tech')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="glass-card p-8">
                @include('espace_technicien.update_mdp.succes_msg')
                <h1 class="text-2xl font-bold text-[var(--grand_titre_color)] mb-6">Profie Technicien</h1>

                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-user-cog text-2xl text-[var(--primary-color)]"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold">Bienvenue, {{ $technicien->Nom_tech }} !</h2>
                            <p class="text-gray-600">Vous êtes connecté en tant que technicien</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Matricule</h3>
                            <p class="text-lg font-mono">{{ $technicien->Matricule_tech }}</p>
                        </div>
                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">CIN</h3>
                            <p class="text-lg">{{ $technicien->CIN_tech ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Nom</h3>
                            <p class="text-lg font-mono">{{ $technicien->Nom_tech }}</p>
                        </div>
                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Prénom</h3>
                            <p class="text-lg">{{ $technicien->Prenom_tech ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Email</h3>
                            <p class="text-lg">{{ $technicien->Email_tech ?? 'Non renseigné' }}</p>
                        </div>

                    </div>
                        <!--Pour modifier le mot de passe-->

                            <a href="{{ route('update_mdp_view') }}" class="w-full p-4 border border-[var(--input-border-color)] rounded-xl hover:bg-blue-50 hover:border-blue-50 transition-colors text-left block">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 rounded-lg bg-blue-100 text-[var(--primary-color)]">
                                        <i class="fas fa-key text-xl"></i>
                                    </div>
                                    <span>Modifier mot de passe</span>
                                </div>
                            </a>

                        <!--pour Déconnexion-->
                    <div class="mt-8">
                        <form action="{{ route('technicien.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full p-4 border border-[var(--input-border-color)] rounded-xl hover:bg-red-50 hover:border-red-50 transition-colors text-left">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 rounded-lg bg-red-100 text-red-500">
                                        <i class="fas fa-sign-out-alt text-xl"></i>
                                    </div>
                                    <span>Déconnexion</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</body>
</html>
