<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refonte Épurée - Analyse</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('espace_technicien\process_production.css')}}">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="title">
                <i class="ti ti-filter"></i>
                Refonte décolorée
            </h1>
            <p class="subtitle">Analyse des paramètres essentiels</p>
        </header>

        <main class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="ti ti-dashboard"></i>
                    Paramètres Clés
                </h2>
            </div>

            <div class="card-body">
                <form action="{{ route('refonte_decoloree_ajouter') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_lot" value="{{ $lot->ID_lot }}">
                    <!-- Degré Brix -->
                    <div class="form-group">
                        <label for="brix" class="form-label">
                            <i class="ti ti-letter-b"></i>
                            Degré Brix
                        </label>
                        <div class="input-with-icon">
                            <input type="number" id="brix" name="brix" step="0.1" min="0"
                                   class="form-control" placeholder="12.5">
                            <span class="input-icon">°Bx</span>
                        </div>
                    </div>

                    <!-- pH -->
                    <div class="form-group">
                        <label for="ph" class="form-label">
                            <i class="ti ti-letter-p"></i>
                            Niveau de pH
                        </label>
                        <div class="input-with-icon">
                            <input type="number" id="ph" name="ph" step="0.01" min="0" max="14"
                                   class="form-control" placeholder="7.0">
                            <span class="input-icon">pH</span>
                        </div>
                    </div>

                    <!-- Couleur -->
                    <div class="form-group">
                        <label for="color" class="form-label">
                            <i class="ti ti-palette"></i>
                            Couleur
                        </label>
                        <div class="color-picker">
                            <input type="color" id="color" name="color" value="#d1fae5"
                                   class="color-preview" title="Sélectionner une couleur">
                            <input type="text" id="color-hex" name="color-hex"
                                   class="form-control" placeholder="#d1fae5" maxlength="7">
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="form-actions">
                        <button type="reset" class="btn btn-outline">
                            <i class="ti ti-rotate-2"></i>
                            Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-check"></i>
                            Valider
                        </button>
                    </div>
                </form>
            </div>
        </main>
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

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            colorHexInput.value = colorInput.value;
        });
    </script>
</body>
</html>
