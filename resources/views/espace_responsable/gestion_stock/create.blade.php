<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable | Ajouter un Produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
    </style>
</head>
<body class="font-[Poppins] bg-gradient-to-br from-blue-50 to-white">
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
                    <i class="fas fa-plus-circle mr-2"></i>Nouveau Produit
                </h2>
                <a href="{{ route('produits.index') }}" class="flex items-center px-4 py-2 bg-white border border-[var(--input-border-color)] rounded-xl hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>

            <!-- Formulaire -->
            <div class="glass-card overflow-hidden">
                <div class="bg-[var(--primary-color)] p-6 text-white">
                    <h4 class="text-xl font-medium"><i class="fas fa-box-open mr-2"></i>Informations du produit</h4>
                </div>
                <div class="p-6">
                    <form action="{{ route('produits.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="Nom_produit" class="block text-sm font-medium text-[var(--text-color)] mb-2">Nom du produit *</label>
                                <div class="relative">
                                    <input type="text" id="Nom_produit" name="Nom_produit" required
                                           class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                                           placeholder="Nom du produit">
                                    <i class="fas fa-tag absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>
                            <div>
                                <label for="quantite_produit" class="block text-sm font-medium text-[var(--text-color)] mb-2">Quantité initiale *</label>
                                <div class="relative">
                                    <input type="number" id="quantite_produit" name="quantite_produit" min="0" required
                                           class="w-full px-4 py-3 pl-10 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                                           placeholder="Quantité">
                                    <i class="fas fa-boxes absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="information_produit" class="block text-sm font-medium text-[var(--text-color)] mb-2">Description détaillée *</label>
                            <textarea id="information_produit" name="information_produit" rows="5" required
                                      class="w-full px-4 py-3 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200"
                                      placeholder="Description du produit..."></textarea>
                        </div>

                        <div class="flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-4">
                            <a href="{{ route('produits.index') }}" class="flex items-center justify-center px-6 py-3 bg-white border border-[var(--input-border-color)] rounded-xl hover:bg-gray-50 transition">
                                <i class="fas fa-times mr-2"></i> Annuler
                            </a>
                            <button type="submit" class="flex items-center justify-center px-6 py-3 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white rounded-xl transition duration-300 transform hover:scale-[1.02]">
                                <i class="fas fa-save mr-2"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Focus sur le premier champ
            $('#Nom_produit').focus();

            // Validation simple du formulaire
            $('form').submit(function(e) {
                let valid = true;
                $(this).find('[required]').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('border-[var(--error-color)]');
                        valid = false;
                    } else {
                        $(this).removeClass('border-[var(--error-color)]');
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
