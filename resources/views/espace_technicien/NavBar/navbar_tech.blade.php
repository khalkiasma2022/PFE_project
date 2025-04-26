<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('espace_technicien\theme.css')}}">
    <title>Document</title>
</head>
<body>
    <aside class="sidebar w-64 bg-gradient-to-br from-green-50 to-white border-r border-gray-200 text-[var(--text-color)] hidden md:block shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h4 class="text-2xl font-bold text-[var(--grand_titre_color)]">Espace Technicien</h4>
        </div>
        <nav class="p-4">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('technicien.dashboard') }}"
                       class="flex items-center p-3 rounded-xl {{ Request::routeIs('technicien.dashboard*') ? 'bg-green-100' : '' }} text-[var(--text-color)] hover:bg-green-200 transition-colors">
                        <i class="fas fa-user mr-3 text-[var(--primary-color)]"></i>
                        Profile
                    </a>
                </li>

                <li>
                    <a href="{{ route('liste_produit_tech_view') }}"
                       class="flex items-center p-3 rounded-xl {{ Request::routeIs('liste_produit_tech_view*') ? 'bg-green-100' : '' }} text-[var(--text-color)] hover:bg-green-200 transition-colors">
                        <i class="fas fa-box mr-3 text-[var(--primary-color)]"></i>
                        Consultation Stock
                    </a>
                </li>
                <li>
                    <a href="{{ route('liste_etape_view') }}"
                       class="flex items-center p-3 rounded-xl {{ Request::routeIs('liste_etape_view*') ? 'bg-green-100' : '' }} text-[var(--text-color)] hover:bg-green-200 transition-colors">
                        <i class="fas fa-industry mr-3 text-[var(--primary-color)]"></i>
                        <span>Processus Production</span>
                    </a>
                </li>
                <li class="mt-8">
                    <form action="{{ route('technicien.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-xl text-[var(--text-color)] hover:bg-green-200 transition-colors">
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
