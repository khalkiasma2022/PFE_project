<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Gestion des Utilisateurs</title>

    <!-- Styles -->
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

        /* Style de pagination minimaliste et élégant */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            border: 1px solid transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: #94a3b8;
            cursor: not-allowed;
            background: transparent;
        }

        .dataTables_wrapper .dataTables_info {
            padding: 0.5rem 0;
            color: var(--text-color);
            font-size: 0.875rem;
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

        .bg-technicien {
            background-color: #8b5cf6;
        }

        .bg-responsable {
            background-color: #1e40af;
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
        @include('espace_responsable.NavBar.navbar_resp')
        <!-- Main Content -->
        @include('espace_responsable.afficher_liste_user.main_content')
    </div>
    <!-- Modal Visualisation Utilisateur -->
    @include('espace_responsable.afficher_liste_user.information_user')

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialisation de DataTable avec filtres
            const table = $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json',
                    paginate: {
                        previous: '<i class="fas fa-chevron-left"></i>',
                        next: '<i class="fas fa-chevron-right"></i>'
                    }
                },
                dom: '<"top"f>rt<"bottom"ip><"clear">',
                pageLength: 10,
                responsive: true,
                initComplete: function() {
                    $('.dataTables_filter input').addClass('px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)]');
                }
            });

            // Filtre par type
            $('#typeFilter').change(function() {
                const type = $(this).val();
                if (type) {
                    table.column(3).search(type).draw();
                } else {
                    table.column(3).search('').draw();
                }
            });

            // Réinitialisation des filtres
            $('#resetFilters').click(function() {
                $('#filterForm')[0].reset();
                table.search('').columns().search('').draw();
            });

            // Gestion de la vue des détails
            $('.view-user').click(function() {
                const matricule = $(this).data('id');
                const type = $(this).data('type');

                let url = type === 'technicien'
                    ? `#`
                    : `#`;

                $.get(url, function(data) {
                    $('#view_matricule').text(data.Matricule_tech || data.Matricule_resp);
                    $('#view_nom').text(data.Nom_tech || data.Nom_resp);
                    $('#view_email').text(data.Email_tech || data.Email_resp);
                    $('#view_type').html(
                        type === 'technicien'
                            ? '<span class="px-3 py-1 rounded-full text-xs font-medium bg-technicien text-white">Technicien</span>'
                            : '<span class="px-3 py-1 rounded-full text-xs font-medium bg-responsable text-white">Responsable</span>'
                    );

                    // Afficher les détails spécifiques
                    const detailsDiv = $('#view_details_specifiques');
                    detailsDiv.empty().removeClass('hidden');

                    if (type === 'technicien') {
                        detailsDiv.append(`
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Spécialité:</label>
                                <p class="text-gray-800">${data.Specialite || 'Non spécifié'}</p>
                            </div>
                        `);
                    } else {
                        detailsDiv.append(`
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Département:</label>
                                <p class="text-gray-800">${data.Departement || 'Non spécifié'}</p>
                            </div>
                        `);
                    }

                    $('#viewUserModal').removeClass('hidden');
                });
            });

            // Fermer la modal
            $('#closeModal').click(function() {
                $('#viewUserModal').addClass('hidden');
            });
        });
    </script>
</body>
</html>
