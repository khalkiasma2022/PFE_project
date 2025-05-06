<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable</title>
    <link rel="stylesheet" href="{{ url('espace_responsable_css/style_resp.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <aside class="sidebar w-64 bg-white/30 border-r border-gray-300 text-[var(--text-color)] hidden md:block shadow-lg h-screen overflow-y-auto">
        <div class="p-6 border-b border-gray-300 text-center">
            <h4 class="text-2xl font-bold text-[var(--grand_titre_color)]">Espace Responsable</h4>
        </div>
        <div class="p-4">
            <ul class="space-y-4">

                <!-- Liens classiques -->
                <li>
                    <a href="{{ route('responsable.dashboard') }}" class="flex items-center p-3 rounded-xl {{ Request::routeIs('responsable.dashboard*') ? 'bg-gray-200' : '' }} hover:bg-gray-300 transition-colors">
                        <i class="fas fa-user-circle mr-3 text-[var(--primary-color)]"></i>
                        <span>Profil</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('gestion_utilisateurs_view') }}" class="flex items-center p-3 rounded-xl {{ Request::routeIs('gestion_utilisateurs_view*') ? 'bg-gray-200' : '' }} hover:bg-gray-300 transition-colors">
                        <i class="fas fa-users mr-3 text-[var(--primary-color)]"></i>
                        <span>Gestion Utilisateurs</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('produits.index') }}" class="flex items-center p-3 rounded-xl {{ Request::routeIs('produits.index*') ? 'bg-gray-200' : '' }} hover:bg-gray-300 transition-colors">
                        <i class="fas fa-tasks mr-3 text-[var(--primary-color)]"></i>
                        <span>Gestion de Stock</span>
                    </a>
                </li>

                <!-- Notifications 🔔 -->
                <li>
                    <button onclick="toggleModal()" class="flex items-center w-full p-3 rounded-xl hover:bg-gray-300 transition-colors">
                        <i class="fas fa-bell mr-3 text-[var(--primary-color)]"></i>
                        <span>Notifications ({{ $notifications->count() }})</span>
                    </button>
                </li>

                <!-- Déconnexion -->
                <li class="mt-8">
                    <form action="{{ route('responsable.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-xl hover:bg-gray-300 transition-colors">
                            <i class="fas fa-sign-out-alt mr-3 text-[var(--primary-color)]"></i>
                            Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

  <!-- Modal Notifications Modernisé -->
<div id="notificationsModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden opacity-0 z-50 transition-opacity duration-300">
    <div id="modalContent" class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 relative overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        <!-- Header -->
        <div class="sticky top-0 bg-white z-10 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-blue-100/80 p-2 rounded-lg mr-3">
                    <i class="fas fa-bell text-blue-500 text-lg"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Notifications</h2>
                @if($notifications->count() > 0)
                <span class="ml-2 bg-blue-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                    {{ $notifications->count() }}
                </span>
                @endif
            </div>
            <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-full hover:bg-gray-100">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="max-h-[60vh] overflow-y-auto">
            @forelse($notifications as $notification)
            <div class="px-6 py-4 hover:bg-gray-50/80 transition-colors border-b border-gray-100 last:border-0 group">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-gray-800 font-medium leading-snug">{{ $notification->contenu_notification }}</p>
                        <div class="flex items-center mt-1.5 text-xs text-gray-400">
                            <i class="far fa-clock mr-1.5"></i>
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <button class="opacity-0 group-hover:opacity-100 text-gray-300 hover:text-blue-500 transition-all">
                        <i class="far fa-trash-alt text-sm"></i>
                    </button>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                    <i class="far fa-bell-slash text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500 font-medium">Aucune notification</p>
                <p class="text-gray-400 text-sm mt-1">Toutes vos notifications apparaîtront ici</p>
            </div>
            @endforelse
        </div>

        <!-- Footer -->
        @if($notifications->count() > 0)
        <div class="sticky bottom-0 bg-white border-t border-gray-100 px-4 py-3 flex justify-end">
            <button class="text-sm text-blue-500 hover:text-blue-600 font-medium px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">
                Tout marquer comme lu
            </button>
        </div>
        @endif
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById('notificationsModal');
        const content = document.getElementById('modalContent');

        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // attendre que la transition finisse
        }
    }
</script>



</body>
</html>
