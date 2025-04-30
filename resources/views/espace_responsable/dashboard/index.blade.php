<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Responsable | Gestion de Stock</title>
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
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
<body class="font-[Poppins] bg-gradient-to-br from-blue-50 to-white min-h-screen flex flex-col">

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg flex items-center space-x-3">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
            <span>{{ session('success') }}</span>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Layout -->
    <div class="flex flex-1 min-h-0">
        <!-- Sidebar -->
        <!-- Sidebar -->
        @include('espace_responsable.NavBar.navbar_resp')

        <!-- Main Content -->
        <main class="main-content flex-1 p-6 overflow-y-auto">
            <div class="glass-card p-8">
                <h1 class="text-2xl font-bold text-[var(--grand_titre_color)] mb-6">Profile Responsable</h1>

                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user-cog text-2xl text-[var(--primary-color)]"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold">Bienvenue, {{ $responsable->Nom_resp }} !</h2>
                            <p class="text-gray-600">Vous êtes connecté en tant que responsable</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Matricule</h3>
                            <p class="text-lg font-mono">{{ $responsable->Matricule_resp }}</p>
                        </div>
                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">CIN</h3>
                            <p class="text-lg">{{ $responsable->CIN_resp ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Nom</h3>
                            <p class="text-lg font-mono">{{ $responsable->Nom_resp }}</p>
                        </div>
                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Prénom</h3>
                            <p class="text-lg">{{ $responsable->Prenom_resp ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="border-l-4 border-[var(--primary-color)] pl-4">
                            <h3 class="font-medium text-gray-500">Email</h3>
                            <p class="text-lg">{{ $responsable->Email_resp ?? 'Non renseigné' }}</p>
                        </div>

                    </div>
                    <a href="{{route('update_mdp_view_resp')}}" class="w-full p-4 border border-[var(--input-border-color)] rounded-xl hover:bg-blue-50 hover:border-blue-50 transition-colors text-left block">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 rounded-lg bg-blue-100 text-[var(--primary-color)]">
                                        <i class="fas fa-key text-xl"></i>
                                    </div>
                                    <span>Modifier mot de passe</span>
                                </div>
                            </a>

                    <div class="mt-8">
                        <form action="{{ route('responsable.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full p-4 border border-[var(--input-border-color)] rounded-xl hover:bg-red-50 transition-colors text-left">
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
        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // Auto-dismiss alert after 5 seconds
        setTimeout(() => {
            $('.fixed.top-4.right-4').fadeOut();
        }, 5000);
    </script>
</body>
</html>
