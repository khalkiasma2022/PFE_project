<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Technicien | Sélection Étape Production</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('espace_technicien\theme.css')}}">
</head>
<body class="font-[Poppins] bg-gradient-to-br from-green-50 to-white min-h-screen flex flex-col">

    <!-- Layout -->
    <div class="flex flex-1 min-h-0">


        <!-- Sidebar -->
        @include('espace_technicien.NavBar.navbar_tech')


        <!-- Main Content -->
        <main class="main-content flex-1 p-6 overflow-y-auto">
            <header class="mb-8">
                @include('espace_technicien.Update_mdp.succes_msg')
                <h2 class="text-2xl font-bold text-[var(--grand_titre_color)] flex items-center">
                    <i class="fas fa-industry mr-2"></i>Processus de Production
                </h2>
                <p class="text-gray-600 mt-2">Sélectionnez une étape du processus de fabrication</p>
            </header>

            <!-- Étapes de production -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Étape 1 -->
                <a href="{{route('refonte_brute_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">1</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">Refonte Brute</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Première fusion des matières premières pour obtenir la masse brute.</p>
                </a>

                <!-- Étape 2 -->
                <a href="{{route('chaulage_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">2</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">Chaulage</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Ajout de chaux pour éliminer les impuretés et stabiliser le pH.</p>
                </a>

                <!-- Étape 3 -->
                <a href="{{route('premier_carbo_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">3</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">1ère Carbonatation</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Injection de CO₂ pour précipiter les impuretés résiduelles.</p>
                </a>

                <!-- Étape 4 -->
                <a href="{{route('deu_carbo_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">4</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">2ème Carbonatation</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Seconde injection pour affiner la purification du produit.</p>
                </a>

                <!-- Étape 5 -->
                <a href="{{route('Refonte_epuree_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">5</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">Refonte Épurée</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Fusion contrôlée pour obtenir une matière première purifiée.</p>
                </a>

                <!-- Étape 6 -->
                <a href="{{route('Refonte_decoloree_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">6</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">Refonte Décantée</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Séparation des phases pour isoler le produit final.</p>
                </a>

                <!-- Étape 7 -->
                <a href="{{route('evapuration_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">7</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">Évaporation</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Réduction de la teneur en eau par évaporation contrôlée.</p>
                </a>

                <!-- Étape 8 -->
                <a href="{{route('cristalisation_view')}}" class="step-card glass-card p-6 cursor-pointer">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center mr-4">
                            <span class="font-bold">8</span>
                        </div>
                        <h3 class="text-lg font-semibold text-[var(--grand_titre_color)]">Cristallisation</h3>
                    </div>
                    <p class="text-gray-600 text-sm">Formation des cristaux pour obtenir le produit final.</p>
                </a>
            </section>

            <!-- Information supplémentaire -->
            <section class="glass-card mt-8 p-6">
                <h3 class="text-lg font-semibold text-[var(--grand_titre_color)] mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-[var(--primary-color)]"></i>
                    Instructions
                </h3>
                <p class="text-gray-600">
                    Sélectionnez une étape du processus pour accéder aux détails et enregistrer les paramètres de production.
                </p>
            </section>
        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Animation au survol des cartes
            $('.step-card').hover(
                function() {
                    $(this).css('border-left-color', 'var(--accent-color)');
                },
                function() {
                    $(this).css('border-left-color', 'var(--primary-color)');
                }
            );
        });
    </script>
</body>
</html>
