<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Gestion de Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            border-radius: 0.5rem;
            margin: 0 0.25em;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
            border: none !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--primary-hover-color) !important;
            color: white !important;
            border: none !important;
        }
    </style>
</head>
<body class="font-[Poppins] bg-gradient-to-br from-blue-50 to-white">
    <!-- Alert Messages -->
    @if(session('success'))
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
            <button class="ml-4 text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-[var(--sidebar-color)] text-white w-full md:w-64 flex-shrink-0">
            <div class="p-6 text-center border-b border-blue-800">
                <h4 class="text-xl font-bold">Espace Responsable</h4>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-3 text-blue-200 hover:text-white hover:bg-[var(--sidebar-hover)] rounded-lg transition">
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
                        <a href="#" class="flex items-center p-3 text-blue-200 hover:text-white hover:bg-[var(--sidebar-hover)] rounded-lg transition">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                    <li class="mt-8">
                        <a href="#" class="flex items-center p-3 text-blue-200 hover:text-white hover:bg-[var(--sidebar-hover)] rounded-lg transition">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <h2 class="text-2xl font-bold text-[var(--grand_titre_color)] mb-4 md:mb-0">
                    <i class="fas fa-tasks mr-2"></i>Gestion des Produits
                </h2>
                <a href="{{ route('produits.create') }}" class="flex items-center px-4 py-2 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white rounded-xl transition duration-300 transform hover:scale-[1.02]">
                    <i class="fas fa-plus mr-2"></i>Nouveau Produit
                </a>
            </div>

            <!-- Filtres -->
            <div class="glass-card mb-6">
                <div class="p-6">
                    <form id="filterForm">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="searchFilter" class="block text-sm font-medium text-[var(--text-color)] mb-2">Recherche</label>
                                <div class="relative">
                                    <input type="text" id="searchFilter" placeholder="Nom du produit..."
                                           class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200">
                                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>
                            <div>
                                <label for="quantityFilter" class="block text-sm font-medium text-[var(--text-color)] mb-2">Quantité</label>
                                <select id="quantityFilter" class="w-full px-4 py-3 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200">
                                    <option value="">Tous</option>
                                    <option value="low">Faible stock</option>
                                    <option value="normal">Stock normal</option>
                                    <option value="high">Stock élevé</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="button" id="resetFilters" class="w-full px-4 py-3 bg-white border border-[var(--input-border-color)] rounded-xl hover:bg-gray-50 transition flex items-center justify-center">
                                    <i class="fas fa-undo mr-2"></i>Réinitialiser
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tableau des produits -->
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-[var(--input-border-color)] flex justify-between items-center">
                    <h3 class="text-lg font-medium text-[var(--grand_titre_color)] flex items-center">
                        <i class="fas fa-list mr-2"></i>
                        Liste des Produits
                    </h3>
                </div>
                <div class="p-6">
                    <table id="productsTable" class="w-full" style="width:100%">
                        <thead>
                            <tr class="text-left border-b border-[var(--input-border-color)]">
                                <th class="pb-4 text-[var(--text-color)]">ID</th>
                                <th class="pb-4 text-[var(--text-color)]">Nom</th>
                                <th class="pb-4 text-[var(--text-color)]">Quantité</th>
                                <th class="pb-4 text-[var(--text-color)]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                            <tr class="border-b border-[var(--input-border-color)] hover:bg-blue-50 transition">
                                <td class="py-4">{{ $produit->ID_produit }}</td>
                                <td class="py-4">{{ $produit->Nom_produit }}</td>
                                <td class="py-4">
                                    @if($produit->quantite_produit < 10)
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-[var(--danger-color)] text-white">{{ $produit->quantite_produit }}</span>
                                    @elseif($produit->quantite_produit < 20)
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-[var(--warning-color)] text-white">{{ $produit->quantite_produit }}</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-[var(--success-color)] text-white">{{ $produit->quantite_produit }}</span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('produits.show', $produit->ID_produit) }}"
                                           class="w-8 h-8 flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition"
                                           title="Détails">
                                           <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('produits.edit', $produit->ID_produit) }}"
                                           class="w-8 h-8 flex items-center justify-center bg-yellow-100 hover:bg-yellow-200 text-yellow-600 rounded-lg transition"
                                           title="Modifier">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit->ID_produit) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-8 h-8 flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition"
                                                    title="Supprimer"
                                                    onclick="return confirm('Confirmer la suppression ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialisation de DataTable avec filtres
            const table = $('#productsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
                },
                dom: '<"top"f>rt<"bottom"lip><"clear">',
                pageLength: 10,
                responsive: true,
                initComplete: function() {
                    $('.dataTables_filter input').addClass('px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)]');
                }
            });

            // Filtre par recherche
            $('#searchFilter').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Filtre par quantité
            $('#quantityFilter').change(function() {
                const value = $(this).val();

                if (value === 'low') {
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            const quantity = parseFloat(data[2].match(/\d+/)[0]) || 0;
                            return quantity < 10;
                        }
                    );
                } else if (value === 'normal') {
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            const quantity = parseFloat(data[2].match(/\d+/)[0]) || 0;
                            return quantity >= 10 && quantity < 20;
                        }
                    );
                } else if (value === 'high') {
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            const quantity = parseFloat(data[2].match(/\d+/)[0]) || 0;
                            return quantity >= 20;
                        }
                    );
                } else {
                    $.fn.dataTable.ext.search = [];
                }

                table.draw();
            });

            // Réinitialisation des filtres
            $('#resetFilters').click(function() {
                $('#filterForm')[0].reset();
                $.fn.dataTable.ext.search = [];
                table.search('').draw();
            });

            // Auto-dismiss alert after 5 seconds
            setTimeout(() => {
                $('.fixed.top-4.right-4').fadeOut();
            }, 5000);
        });
    </script>
</body>
</html>
