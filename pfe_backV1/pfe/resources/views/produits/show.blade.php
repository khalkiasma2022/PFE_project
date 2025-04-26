<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Détails Produit</title>
    
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
            --couleur-info: #17a2b8;
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
            background-color: var(--couleur-info);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
        }
        .detail-row {
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .detail-row:last-child {
            border-bottom: none;
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
        .card-footer {
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
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
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-box-open me-2"></i>Fiche Produit #{{ $produit->ID_produit }}
                    </h3>
                    <a href="{{ route('produits.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-list me-1"></i> Retour à la liste
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row detail-row">
                    <div class="col-md-2 fw-bold text-muted">ID Produit:</div>
                    <div class="col-md-10">{{ $produit->ID_produit }}</div>
                </div>
                
                <div class="row detail-row">
                    <div class="col-md-2 fw-bold text-muted">Nom:</div>
                    <div class="col-md-10">{{ $produit->Nom_produit }}</div>
                </div>
                
                <div class="row detail-row">
                    <div class="col-md-2 fw-bold text-muted">Description:</div>
                    <div class="col-md-10">{{ $produit->information_produit }}</div>
                </div>
                
                <div class="row detail-row">
                    <div class="col-md-2 fw-bold text-muted">Stock actuel:</div>
                    <div class="col-md-10">
                        <span class="badge bg-{{ $produit->quantite_produit > 10 ? 'success' : ($produit->quantite_produit > 0 ? 'warning text-dark' : 'danger') }}">
                            {{ $produit->quantite_produit }} unité(s)
                        </span>
                        @if($produit->quantite_produit < 5)
                        <span class="badge bg-danger ms-2">Stock critique</span>
                        @endif
                    </div>
                </div>
                
                <div class="row detail-row">
                    <div class="col-md-2 fw-bold text-muted">Date création:</div>
                    <div class="col-md-10">
                        <i class="far fa-calendar-alt me-1 text-muted"></i>
                        {{ $produit->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
                
                <div class="row detail-row">
                    <div class="col-md-2 fw-bold text-muted">Dernière modification:</div>
                    <div class="col-md-10">
                        <i class="far fa-calendar-alt me-1 text-muted"></i>
                        {{ $produit->updated_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-end">
                <a href="{{ route('produits.edit', $produit->ID_produit) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i> Modifier
                </a>
                <form action="{{ route('produits.destroy', $produit->ID_produit) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Animation pour les lignes de détails
            $('.detail-row').hover(
                function() {
                    $(this).css('background-color', 'rgba(0, 0, 0, 0.02)');
                },
                function() {
                    $(this).css('background-color', '');
                }
            );
        });
    </script>
</body>
</html>