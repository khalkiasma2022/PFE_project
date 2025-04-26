<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('espace_responsable_css/style_resp.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>Espace Responsable</title>
</head>
<body>
    <aside class="sidebar w-64 bg-white/30 border-r border-gray-300 text-[var(--text-color)] hidden md:block shadow-lg">
        <div class="p-6 border-b border-gray-300 text-center">
            <h4 class="text-2xl font-bold text-[var(--grand_titre_color)]">Espace Responsable</h4>
        </div>
        <nav class="p-4">
            <ul class="space-y-4">

                <li>
                    <a href="{{ route('responsable.dashboard') }}"
                       class="flex items-center p-3 rounded-xl {{ Request::routeIs('responsable.dashboard*') ? 'bg-gray-200' : '' }} text-[var(--text-color)] hover:bg-gray-300 transition-colors">
                        <i class="fas fa-user-circle mr-3 text-[var(--primary-color)]"></i>
                        <span>Profil</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('gestion_utilisateurs_view') }}"
                       class="flex items-center p-3 rounded-xl {{ Request::routeIs('gestion_utilisateurs_view*') ? 'bg-gray-200' : '' }} text-[var(--text-color)] hover:bg-gray-300 transition-colors">
                        <i class="fas fa-users mr-3 text-[var(--primary-color)]"></i>
                        <span>Gestion Utilisateurs</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('produits.index') }}"
                       class="flex items-center p-3 rounded-xl {{ Request::routeIs('produits.index*') ? 'bg-gray-200' : '' }} text-[var(--text-color)] hover:bg-gray-300 transition-colors">
                        <i class="fas fa-tasks mr-3 text-[var(--primary-color)]"></i>
                        <span>Gestion de Stock</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-xl text-[var(--text-color)] hover:bg-gray-300 transition-colors">
                        <i class="fas fa-chart-bar mr-3 text-[var(--primary-color)]"></i>
                        <span>Statistiques</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-xl text-[var(--text-color)] hover:bg-gray-300 transition-colors">
                        <i class="fas fa-history mr-3 text-[var(--primary-color)]"></i>
                        <span>Historique</span>
                    </a>
                </li>

                <li class="mt-8">
                    <form action="{{ route('responsable.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-xl text-[var(--text-color)] hover:bg-gray-300 transition-colors">
                            <i class="fas fa-sign-out-alt mr-3 text-[var(--primary-color)]"></i>
                            Déconnexion
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </aside>
</body>
</html>
