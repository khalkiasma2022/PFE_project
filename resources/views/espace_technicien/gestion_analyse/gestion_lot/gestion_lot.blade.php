<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Technicien | Lots en Production</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('espace_technicien/theme.css')}}">
    <style>
        .status-badge {
            padding: 0.35rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Animation for the "En cours" status icon */
        .status-icon {
            animation: spin 1s linear infinite;
        }

        /* Rotate animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .notification {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Background color for the page - soft light gray */
        body {
            background-color: #f7fafc; /* Soft light gray */
        }

        /* White background for the main content */
        .main-content {
            background-color: #ffffff; /* White */
        }

        /* White background for the table container */
        .bg-white {
            background-color: #ffffff; /* White */
        }
    </style>
</head>
<body class="font-[Poppins] min-h-screen flex flex-col">

    <!-- Notification -->
    <div id="notification" class="notification hidden">
        <div class="glass-card p-4 mb-4 flex items-start border-l-4 border-red-500 shadow-lg">
            <i class="fas fa-exclamation-triangle text-red-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-bold text-gray-800">Erreur de production</h4>
                <p class="text-sm text-gray-600" id="error-message"></p>
            </div>
            <button onclick="hideNotification()" class="ml-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Layout -->
    <div class="flex flex-1 min-h-0">

        <!-- Sidebar -->
        @include('espace_technicien.NavBar.navbar_tech')

        <!-- Main Content -->
        <main class="main-content flex-1 p-6 overflow-y-auto">
            <header class="mb-8">
                @include('espace_technicien.Update_mdp.succes_msg')
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-[var(--grand_titre_color)] flex items-center">
                            <i class="fas fa-cogs mr-2"></i>Lots en Production
                        </h2>
                        <p class="text-gray-600 mt-2">Gestion des lots actuellement en cours de fabrication</p>
                    </div>
                    <a href="{{ route('refonte_brute_view_lot') }}" class="mt-4 md:mt-0 px-4 py-2 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white rounded-lg flex items-center transition-all duration-200 shadow hover:shadow-md">
                        <i class="fas fa-plus mr-2"></i>Nouveau Lot
                    </a>
                </div>
            </header>

            <!-- Tableau des lots en cours -->
            <section class="bg-white rounded-lg shadow-md p-6">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">ID Lot</th>
                            <th class="px-4 py-2 text-left text-gray-600">Matricule Technicien</th>
                            <th class="px-4 py-2 text-left text-gray-600">Date</th>
                            <th class="px-4 py-2 text-left text-gray-600">Statut</th>
                            <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lots as $lot)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $lot->ID_lot }}</td>
                                
                                <td class="px-4 py-2">{{ $lot->Matricule_technicien }}</td>
                                <td class="px-4 py-2">{{ $lot->Date_lot }}</td>
                                <td class="px-4 py-2">
                                    @if($lot->Statue == 'En cours')
                                        <span class="status-badge status-active flex items-center">
                                            <i class="fas fa-circle-notch status-icon mr-2"></i> En cours
                                        </span>
                                    @else
                                        <span class="status-badge status-error">Terminé</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('liste_etape_view', ['id' => $lot->ID_lot]) }}" class="action-btn px-3 py-1 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white rounded-lg transition-all duration-200"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // Fonction pour afficher les erreurs
        function showErrorDetails(errorMessage) {
            $('#error-message').text(errorMessage);
            $('#notification').removeClass('hidden').addClass('animate-fade-in');

            // Masquer automatiquement après 5 secondes
            setTimeout(hideNotification, 5000);
        }

        function hideNotification() {
            $('#notification').addClass('hidden').removeClass('animate-fade-in');
        }
    </script>

</body>
</html>
