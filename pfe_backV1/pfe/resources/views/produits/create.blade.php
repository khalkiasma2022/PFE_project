<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Ajouter un Produit</title>
    
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
        .form-header {
            background-color: var(--couleur-principale);
            color: white;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
        }
        .form-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>Nouveau Produit
            </h2>
            <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
        </div>

        <!-- Formulaire -->
        <div class="card form-card">
            <div class="form-header">
                <h4 class="mb-0"><i class="fas fa-box-open me-2"></i>Informations du produit</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('produits.store') }}" method="POST">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Nom_produit" class="form-label">Nom du produit *</label>
                                <input type="text" class="form-control" id="Nom_produit" name="Nom_produit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantite_produit" class="form-label">Quantité initiale *</label>
                                <input type="number" class="form-control" id="quantite_produit" name="quantite_produit" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="information_produit" class="form-label">Description détaillée *</label>
                        <textarea class="form-control" id="information_produit" name="information_produit" rows="5" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary me-3">
                            <i class="fas fa-times me-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Focus sur le premier champ
            $('#Nom_produit').focus();
            
            // Validation simple du formulaire
            $('form').submit(function(e) {
                let valid = true;
                $(this).find('[required]').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                        valid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if (!valid) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                }
            });
        });
    </script>
</body>
</html>