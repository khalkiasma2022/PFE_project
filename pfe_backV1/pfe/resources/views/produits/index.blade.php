<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Gestion de Stock</title>
    
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
        .alert {
            margin-left: 250px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h4>Espace Responsable</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users me-2"></i>Gestion Utilisateurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('produits.index') }}">
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
                <i class="fas fa-tasks me-2"></i>Gestion des Produits
            </h2>
            <div>
                <a href="{{ route('produits.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Nouveau Produit
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="searchFilter" class="form-label">Recherche</label>
                            <input type="text" class="form-control" id="searchFilter" placeholder="Nom du produit...">
                        </div>
                        <div class="col-md-4">
                            <label for="quantityFilter" class="form-label">Quantité</label>
                            <select class="form-select" id="quantityFilter">
                                <option value="">Tous</option>
                                <option value="low">Faible stock</option>
                                <option value="normal">Stock normal</option>
                                <option value="high">Stock élevé</option>
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

        <!-- Tableau des produits -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-list me-2"></i>
                    Liste des Produits
                </div>
            </div>
            <div class="card-body">
                <table id="productsTable" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->ID_produit }}</td>
                            <td>{{ $produit->Nom_produit }}</td>
                            <td>
                                @if($produit->quantite_produit < 10)
                                    <span class="badge bg-danger">{{ $produit->quantite_produit }}</span>
                                @elseif($produit->quantite_produit < 20)
                                    <span class="badge bg-warning text-dark">{{ $produit->quantite_produit }}</span>
                                @else
                                    <span class="badge bg-success">{{ $produit->quantite_produit }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('produits.show', $produit->ID_produit) }}" 
                                   class="btn btn-sm btn-outline-info btn-action" 
                                   title="Détails">
                                   <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('produits.edit', $produit->ID_produit) }}" 
                                   class="btn btn-sm btn-outline-warning btn-action" 
                                   title="Modifier">
                                   <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('produits.destroy', $produit->ID_produit) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger btn-action" 
                                            title="Supprimer"
                                            onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
            const table = $('#productsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
                },
                dom: '<"top"f>rt<"bottom"lip><"clear">',
                pageLength: 10,
                responsive: true
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
                            const quantity = parseFloat(data[2]) || 0;
                            return quantity < 10;
                        }
                    );
                } else if (value === 'normal') {
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            const quantity = parseFloat(data[2]) || 0;
                            return quantity >= 10 && quantity < 20;
                        }
                    );
                } else if (value === 'high') {
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            const quantity = parseFloat(data[2]) || 0;
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
        });
    </script>
</body>
</html>