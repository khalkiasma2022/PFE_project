<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Analyses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(6, 95, 70, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hover-effect:hover {
            background-color: #f0fdf4;
            transform: translateY(-1px);
        }
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="font-[Poppins] bg-gray-50 p-6">

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-teal-800">
                <i class="fas fa-history mr-2 text-teal-600"></i>
                Historique des Analyses
            </h1>

            <div class="relative w-full md:w-80">
                <input type="text" placeholder="Rechercher..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg search-input
                              focus:outline-none focus:ring-2 focus:ring-teal-400 bg-white">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Table Card -->
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-teal-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase">Matricule Technicien</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase">ID Lot</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase">Date</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($historiques as $historique)
                            <tr class="hover-effect transition-all duration-150">
                                <!-- Matricule -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center">
                                            <i class="fas fa-user text-teal-700 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $historique->matricule_technicien }}</div>
                                            <div class="text-xs text-gray-500">Technicien</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- ID Lot -->
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold bg-teal-100 text-teal-800 rounded-full">
                                        #{{ $historique->ID_lot }}
                                    </span>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ date('d/m/Y', strtotime($historique->Date_historique)) }}</div>
                                    <div class="text-xs text-gray-500">{{ date('H:i', strtotime($historique->Date_historique)) }}</div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-right">
                                    <button class="p-2 rounded-lg hover:bg-teal-100 text-teal-600 transition-colors" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-3xl mb-2"></i>
                                    <p>Aucun historique trouvé.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Add any necessary JavaScript here
        document.querySelectorAll('.hover-effect').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 6px rgba(5, 150, 105, 0.1)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>
