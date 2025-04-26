<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Technicien | Consultation Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('espace_technicien\theme.css')}}">
    <style>

        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(6, 95, 70, 0.1); /* Ombre verte */
            border-radius: 1rem;
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
<body class="font-[Poppins] bg-gradient-to-br from-green-50 to-white min-h-screen flex flex-col">

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
         @include('espace_technicien.NavBar.navbar_tech')


        <!-- Main Content -->
        <main class="main-content flex-1 p-6 overflow-y-auto">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-[var(--grand_titre_color)] flex items-center">
                    <i class="fas fa-boxes mr-2"></i>Consultation du Stock
                </h2>
            </header>

            <!-- Filtres -->
            <section class="glass-card mb-6">
                <div class="p-6">
                    <form id="filterForm" class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
                            <button type="button" id="resetFilters" class="w-full px-4 py-3 bg-white border border-[var(--input-border-color)] rounded-xl hover:bg-gray-50 transition flex items-center justify-center space-x-2">
                                <i class="fas fa-undo"></i>
                                <span>Réinitialiser</span>
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Tableau des produits -->
            <section class="glass-card overflow-hidden">
                <div class="p-6 border-b border-[var(--input-border-color)] flex justify-between items-center">
                    <h3 class="text-lg font-medium text-[var(--grand_titre_color)] flex items-center">
                        <i class="fas fa-list mr-2"></i>Liste des Produits
                    </h3>
                </div>
                <div class="p-6">
                    <table id="productsTable" class="w-full" style="width:100%">
                        <thead>
                            <tr class="text-left border-b border-[var(--input-border-color)]">
                                <th class="pb-4 text-[var(--text-color)]">ID</th>
                                <th class="pb-4 text-[var(--text-color)]">Nom</th>
                                <th class="pb-4 text-[var(--text-color)]">Quantité</th>
                                <th class="pb-4 text-[var(--text-color)]">Détails</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                            <tr class="border-b border-[var(--input-border-color)] hover:bg-green-50 transition">
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
                                        <a href="{{ route('produit_show_tech', $produit->ID_produit) }}"
                                           class="w-8 h-8 flex items-center justify-center bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition"
                                           title="Détails">
                                           <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
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
