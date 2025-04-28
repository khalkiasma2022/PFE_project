<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analyse Bx/pH/Couleur - Etape 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen p-6 md:p-8" style="background-image: radial-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px); background-size: 20px 20px;">
    <div class="max-w-2xl mx-auto">
        <!-- En-tête -->
        <header class="text-center mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-[#166534] mb-2 flex items-center justify-center">
                <i class="ti ti-clipboard-list mr-2"></i>Chaulage
            </h1>
            <div class="inline-flex items-center bg-[#10b981] text-white px-4 py-2 rounded-full text-sm font-medium shadow-md">
                <i class="ti ti-arrow-right mr-1"></i>
                Etape 2
            </div>
        </header>

        <!-- Carte du formulaire -->
        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-lg border border-[#d1fae5]/50 transition-all hover:-translate-y-1 hover:shadow-xl animate-fade-in-up">
            <!-- En-tête de la carte -->
            <div class="p-4 md:p-6 border-b border-[#d1fae5] bg-[#10b981]/10">
                <h2 class="text-lg md:text-xl font-semibold text-[#166534] flex items-center">
                    <i class="ti ti-flask-2 mr-2"></i>Paramètres Clés
                </h2>
            </div>

            <!-- Corps du formulaire -->
            <div class="p-4 md:p-6">
                <form action="{{ route('chaulage_ajouter') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Lait de chaux -->
                    <div class="mb-6">
                        <label for="lait_chaux_input" class="block text-sm font-medium text-[#1a2e05] mb-2 flex items-center">
                            <i class="ti ti-letter-b mr-2"></i>Quantité Lait de chaux
                        </label>
                        <div class="relative">
                            <input type="number" id="lait_chaux_input" name="lait_de_chaux_input" step="0.1" min="0"
                                   class="w-full px-4 py-3 border border-[#d1fae5] rounded-xl focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/20 transition"
                                   placeholder="Ex: 12.5">
                            <span class="absolute right-3 top-3 text-gray-500">Lait de chaux</span>
                        </div>
                    </div>

                    <!-- CO2 -->
                    <div class="mb-6">
                        <label for="ph" class="block text-sm font-medium text-[#1a2e05] mb-2 flex items-center">
                            <i class="ti ti-letter-p mr-2"></i>Quantité de CO2 (g/L)
                        </label>
                        <div class="relative">
                            <input type="number" id="ph" name="CO2_input" step="0.01" min="0" max="14"
                                   class="w-full px-4 py-3 border border-[#d1fae5] rounded-xl focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/20 transition"
                                   placeholder="Ex: 8.5">
                            <span class="absolute right-3 top-3 text-gray-500">Quantité de CO2</span>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8">
                        <button type="reset" class="px-6 py-3 border border-[#d1fae5] rounded-xl hover:bg-gray-50 transition flex items-center justify-center">
                            <i class="ti ti-rotate-2 mr-2"></i>Réinitialiser
                        </button>
                        <button type="submit" class="px-6 py-3 bg-[#10b981] hover:bg-[#059669] text-white rounded-xl transition hover:scale-[1.02] flex items-center justify-center shadow-md">
                            <i class="ti ti-check mr-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Gestion du sélecteur de couleur
        const colorInput = document.getElementById('color');
        const colorHexInput = document.getElementById('color-hex');

        colorInput.addEventListener('input', function() {
            colorHexInput.value = this.value;
        });

        colorHexInput.addEventListener('input', function() {
            if (this.value.match(/^#[0-9A-Fa-f]{6}$/i)) {
                colorInput.value = this.value;
            }
        });

        // Initialisation de la couleur
        document.addEventListener('DOMContentLoaded', () => {
            colorHexInput.value = colorInput.value;
        });
    </script>
</body>
</html>
