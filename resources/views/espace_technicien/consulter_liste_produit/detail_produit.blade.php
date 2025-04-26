<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Détails Produit</title>
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
        .sidebar {
            background-color: var(--sidebar-color);
            color: white;
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
        .nav-link {
            color: #bdc3c7;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--primary-color);
        }
        .detail-row {
            transition: all 0.2s ease;
            padding: 12px 0;
            border-bottom: 1px solid var(--input-border-color);
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-row:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }
    </style>
</head>
<body class="font-[Poppins] bg-gradient-to-br from-blue-50 to-white">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 bg-white/30 border-r border-gray-300 text-[var(--text-color)] hidden md:block">
            <div class="p-6 text-center border-b border-gray-300">
                <h4 class="text-xl font-bold text-[var(--grand_titre_color)]">Espace Responsable</h4>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-3 text-[var(--text-color)] hover:bg-[var(--sidebar-hover)] hover:text-white rounded-lg transition">
                            <i class="fas fa-users mr-3"></i>
                            <span>Gestion Utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('produits.index') }}" class="flex items-center p-3 text-white bg-[var(--sidebar-hover)] rounded-lg">
                            <i class="fas fa-tasks mr-3"></i>
                            <span>Gestion de stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-[var(--text-color)] hover:bg-[var(--sidebar-hover)] hover:text-white rounded-lg transition">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                    <li class="mt-8">
                        <a href="#" class="flex items-center p-3 text-[var(--text-color)] hover:bg-[var(--sidebar-hover)] hover:text-white rounded-lg transition">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content flex-1 p-6">
            <div class="glass-card overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[var(--primary-color)] p-6 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <h3 class="text-xl font-medium flex items-center">
                            <i class="fas fa-box-open mr-2"></i>Fiche Produit #{{ $produit->ID_produit }}
                        </h3>
                        <a href="{{ route('produits.index') }}" class="mt-4 md:mt-0 flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl transition">
                            <i class="fas fa-list mr-2"></i> Retour à la liste
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 detail-row">
                        <div class="text-sm font-medium text-[var(--text-color)] opacity-80">ID Produit:</div>
                        <div class="md:col-span-3 font-mono">{{ $produit->ID_produit }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 detail-row">
                        <div class="text-sm font-medium text-[var(--text-color)] opacity-80">Nom:</div>
                        <div class="md:col-span-3">{{ $produit->Nom_produit }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 detail-row">
                        <div class="text-sm font-medium text-[var(--text-color)] opacity-80">Description:</div>
                        <div class="md:col-span-3 text-gray-600">{{ $produit->information_produit }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 detail-row">
                        <div class="text-sm font-medium text-[var(--text-color)] opacity-80">Stock actuel:</div>
                        <div class="md:col-span-3">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($produit->quantite_produit > 10) bg-[var(--success-color)] text-white
                                @elseif($produit->quantite_produit > 0) bg-[var(--warning-color)] text-white
                                @else bg-[var(--danger-color)] text-white @endif">
                                {{ $produit->quantite_produit }} unité(s)
                            </span>
                            @if($produit->quantite_produit < 5)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-[var(--danger-color)] text-white ml-2">
                                Stock critique
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 detail-row">
                        <div class="text-sm font-medium text-[var(--text-color)] opacity-80">Date création:</div>
                        <div class="md:col-span-3 text-gray-600">
                            <i class="far fa-calendar-alt mr-2 opacity-70"></i>
                            <!-- Date à ajouter -->
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 detail-row">
                        <div class="text-sm font-medium text-[var(--text-color)] opacity-80">Dernière modification:</div>
                        <div class="md:col-span-3 text-gray-600">
                            <i class="far fa-calendar-alt mr-2 opacity-70"></i>
                            <!-- Date à ajouter -->
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="p-6 border-t border-[var(--input-border-color)] flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-4">
                    <a href="{{ route('produits.edit', $produit->ID_produit) }}"
                       class="flex items-center justify-center px-6 py-2 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white rounded-xl transition">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                    <form action="{{ route('produits.destroy', $produit->ID_produit) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="flex items-center justify-center px-6 py-2 bg-[var(--danger-color)] hover:bg-red-600 text-white rounded-xl transition"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                            <i class="fas fa-trash-alt mr-2"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Animation pour les lignes de détails
            $('.detail-row').hover(
                function() {
                    $(this).css('transform', 'translateX(4px)');
                },
                function() {
                    $(this).css('transform', 'translateX(0)');
                }
            );
        });
    </script>
</body>
</html>
