<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Gestion des Utilisateurs</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --couleur-principale: #3498db;
            --couleur-secondaire: #2980b9;
            --couleur-technicien: #2ecc71;
            --couleur-responsable: #e74c3c;
        }
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            font-weight: 600;
        }
        .badge-responsable {
            background-color: var(--couleur-responsable);
        }
        .badge-technicien {
            background-color: var(--couleur-technicien);
        }
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .nav-link {
            color: #bdc3c7;
            padding: 12px 20px;
            border-left: 3px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--couleur-principale);
        }
        .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h4>Espace Responsable</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="fas fa-users me-2"></i>Gestion Utilisateurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('produits.index') }}">
                    <i class="fas fa-tasks me-2"></i>Gestion de stock
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar me-2"></i>Statistiques
                </a>
            </li>
            <li class="nav-item mt-4">
                <a class="nav-link" href="#">
                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-users me-2"></i>Gestion des Utilisateurs
            </h2>
            <div>
                <div class="dropdown">
                    <a href="{{ route('createAccount_view') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Nouvel Utilisateur
                    </a>
                    
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="typeFilter" class="form-label">Type</label>
                            <select class="form-select" id="typeFilter">
                                <option value="">Tous</option>
                                <option value="technicien">Technicien</option>
                                <option value="responsable">Responsable</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-secondary w-100" id="resetFilters">
                                <i class="fas fa-undo me-2"></i>Réinitialiser
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-list me-2"></i>
                    Liste des Utilisateurs
                </div>
                
            </div>
            <div class="card-body">
                <table id="usersTable" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->Matricule }}</td>
                            <td>{{ $user->Nom }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>
                                @if($user->type === 'technicien')
                                    <span class="badge bg-technicien">Technicien</span>
                                @else
                                    <span class="badge bg-responsable">Responsable</span>
                                @endif
                            </td>
                            <td>
                                @if($user->type === 'technicien')
                                    <a href="{{ route('UpdateAccount_view', $user->Matricule) }}" 
                                          class="btn btn-sm btn-outline-warning btn-action" 
                                          title="Modifier">
                                          <i class="fas fa-edit"></i>
                                    </a>

                                @else
                                    <button class="btn btn-sm btn-outline-warning btn-action edit-responsable" 
                                            data-id="{{ $user->Matricule }}" title="Masquer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endif
                                
                                <button class="btn btn-sm btn-outline-info btn-action view-user" 
                                        data-id="{{ $user->Matricule }}" 
                                        data-type="{{ $user->type }}" 
                                        title="Détails">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Création Technicien -->
    <div class="modal fade" id="createTechnicienModal" tabindex="-1" aria-labelledby="createTechnicienModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-technicien text-white">
                    <h5 class="modal-title" id="createTechnicienModalLabel">Nouveau Technicien</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createTechnicienForm" action="{{ route('techniciens.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Matricule_tech" class="form-label">Matricule *</label>
                            <input type="text" class="form-control" id="Matricule_tech" name="Matricule_tech" required>
                        </div>
                        <div class="mb-3">
                            <label for="Nom_tech" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="Nom_tech" name="Nom_tech" required>
                        </div>
                        <div class="mb-3">
                            <label for="Email_tech" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="Email_tech" name="Email_tech" required>
                        </div>
                        <div class="mb-3">
                            <label for="Mot_de_passe_tech" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="Mot_de_passe_tech" name="Mot_de_passe_tech" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-technicien text-white">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Création Responsable -->
    <div class="modal fade" id="createResponsableModal" tabindex="-1" aria-labelledby="createResponsableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-responsable text-white">
                    <h5 class="modal-title" id="createResponsableModalLabel">Nouveau Responsable</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createResponsableForm" action="{{ route('responsables.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Matricule_resp" class="form-label">Matricule *</label>
                            <input type="text" class="form-control" id="Matricule_resp" name="Matricule_resp" required>
                        </div>
                        <div class="mb-3">
                            <label for="Nom_resp" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="Nom_resp" name="Nom_resp" required>
                        </div>
                        <div class="mb-3">
                            <label for="Email_resp" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="Email_resp" name="Email_resp" required>
                        </div>
                        <div class="mb-3">
                            <label for="Mot_de_passe_resp" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="Mot_de_passe_resp" name="Mot_de_passe_resp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-responsable text-white">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Visualisation Utilisateur -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">Détails de l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Matricule:</label>
                        <p class="form-control-static" id="view_matricule"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom:</label>
                        <p class="form-control-static" id="view_nom"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <p class="form-control-static" id="view_email"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type:</label>
                        <p class="form-control-static" id="view_type"></p>
                    </div>
                    <div id="view_details_specifiques" style="display: none;">
                        <!-- Détails spécifiques seront ajoutés dynamiquement -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialisation de DataTable avec filtres
            const table = $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
                },
                dom: '<"top"f>rt<"bottom"lip><"clear">',
                pageLength: 10,
                responsive: true
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
                    ? `/techniciens/${matricule}` 
                    : `/responsables/${matricule}`;
                
                $.get(url, function(data) {
                    $('#view_matricule').text(data.Matricule_tech || data.Matricule_resp);
                    $('#view_nom').text(data.Nom_tech || data.Nom_resp);
                    $('#view_email').text(data.Email_tech || data.Email_resp);
                    $('#view_type').html(
                        `<span class="badge bg-${type === 'technicien' ? 'technicien' : 'responsable'}">${
                            type === 'technicien' ? 'Technicien' : 'Responsable'
                        }</span>`
                    );
                    
                    // Afficher les détails spécifiques
                    const detailsDiv = $('#view_details_specifiques');
                    detailsDiv.empty().show();
                    
                    if (type === 'technicien') {
                        detailsDiv.append(`
                            <div class="mb-3">
                                <label class="form-label">Spécialité:</label>
                                <p class="form-control-static">${data.Specialite || 'Non spécifié'}</p>
                            </div>
                        `);
                    } else {
                        detailsDiv.append(`
                            <div class="mb-3">
                                <label class="form-label">Département:</label>
                                <p class="form-control-static">${data.Departement || 'Non spécifié'}</p>
                            </div>
                        `);
                    }
                    
                    $('#viewUserModal').modal('show');
                });
            });

            // Gestion de la suppression des techniciens
            $('.delete-technicien').click(function() {
                const matricule = $(this).data('id');
                
                if(confirm('Êtes-vous sûr de vouloir supprimer ce technicien ?')) {
                    $.ajax({
                        url: `/techniciens/${matricule}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Erreur: ' + xhr.responseJSON.message);
                        }
                    });
                }
            });

            // Gestion des formulaires de création
            $('#createTechnicienForm, #createResponsableForm').submit(function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');
                
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(),
                    success: function() {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Une erreur est survenue: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
</body>
</html>