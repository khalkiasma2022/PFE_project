<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Analyses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('espace_technicien\theme.css')}}">

    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(6, 95, 70, 0.1);
            border-radius: 1rem;
        }
        .hover-effect:hover {
            background-color: #f0fdf4 !important;
        }
        .transition-all {
            transition: all 0.2s ease;
        }
        .cell-highlight {
            font-weight: 500;
            color: #1a2e05;
        }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8">
    @include('espace_technicien.NavBar.navbar_tech')
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <h1 class="text-2xl md:text-3xl font-bold text-[#166534]">Historique des Analyses</h1>
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10b981] focus:border-transparent bg-gray-50">
                <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>

        <div class="glass-card overflow-hidden transition-all">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#166534] text-white">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Technicien</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">ID Étape</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Nom de l'Étape</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-right text-sm font-medium uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($historiques as $historique)
                        <tr class="transition-all hover-effect">
                            <td class="px-6 py-4">
                                <div class="flex items-center min-w-[180px]">
                                    <div class="flex-shrink-0 h-9 w-9 bg-[#10b981] rounded-full flex items-center justify-center text-white font-medium">
                                        {{ substr($historique->matricule_technicien, 0, 2) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm cell-highlight">{{ $historique->matricule_technicien }}</div>
                                        <div class="text-xs text-gray-500 mt-1">Technicien</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-4 font-medium rounded-full bg-green-50 text-[#166534] border border-green-100">
                                    #{{ $historique->ID_prelevement }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm cell-highlight">{{ $historique->nom_etape }}</div>
                                <div class="text-xs text-gray-500 mt-1">Processus</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i data-feather="calendar" class="mr-2 w-4 h-4 text-gray-400"></i>
                                    <div>
                                        <div class="text-sm cell-highlight">{{ date('d/m/Y', strtotime($historique->date_enregistrement)) }}</div>
                                        <div class="text-xs text-gray-500">{{ date('H:i', strtotime($historique->date_enregistrement)) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-2 rounded-lg hover:bg-green-50 text-[#10b981] hover:text-[#059669]" title="Voir détails">
                                        <i data-feather="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button class="p-2 rounded-lg hover:bg-blue-50 text-blue-500 hover:text-blue-600" title="Télécharger">
                                        <i data-feather="download" class="w-4 h-4"></i>
                                    </button>
                                    <button class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700" title="Plus d'options">
                                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination améliorée -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-100 sm:px-6 rounded-b-lg">
                <div class="flex-1 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Affichage <span class="font-medium">1-10</span> sur <span class="font-medium">20</span>
                        </p>
                    </div>
                    <div>
                        <nav class="inline-flex rounded-md shadow-sm">
                            <a href="#" class="relative inline-flex items-center px-3 py-2 rounded-l-md border border-gray-200 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i data-feather="chevron-left" class="h-4 w-4"></i>
                            </a>
                            <a href="#" aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 border border-[#166534] bg-[#166534] text-white text-sm font-medium">
                                1
                            </a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-200 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                2
                            </a>
                            <a href="#" class="relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-200 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i data-feather="chevron-right" class="h-4 w-4"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
