<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analyse Chimique - Etape 1</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('espace_technicien\process_production.css')}}">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>
                <i class="ti ti-test-pipe btn-icon"></i>
                Analyse Chimique
            </h1>
            <div class="badge">
                <i class="ti ti-arrow-right btn-icon"></i>
                Paramètres de Base
            </div>
        </header>

        <main class="card">
            <div class="card-header">
                <h2>
                    <i class="ti ti-chemical-glass btn-icon"></i>
                    Mesures Fondamentales
                </h2>
            </div>

            <div class="card-body">
                <form action="{{ route('deu_carbo_ajouter') }}" method="POST">
                    @csrf
                    <!-- pH -->
                    <input type="hidden" name="id_lot" value="{{ $lot->ID_lot }}">
                    <div class="form-group">
                        <label for="ph" class="form-label">
                            <i class="ti ti-letter-p btn-icon"></i>
                            Niveau de pH
                        </label>
                        <div class="input-with-unit">
                            <input type="number" id="ph" name="ph" step="0.01" min="0" max="14"
                                   class="form-control" placeholder="Ex: 7.25">
                            <span class="input-unit">pH</span>
                        </div>
                        <p class="form-hint">Échelle de 0 (acide) à 14 (basique)</p>
                    </div>

                    <!-- Température -->
                    <div class="form-group">
                        <label for="temperature" class="form-label">
                            <i class="ti ti-temperature btn-icon"></i>
                            Température
                        </label>
                        <div class="input-with-unit">
                            <input type="number" id="temperature" name="temperature" step="0.1"
                                   class="form-control" placeholder="Ex: 22.5">
                            <span class="input-unit">°C</span>
                        </div>
                        <p class="form-hint">Température ambiante du milieu</p>
                    </div>

                    <!-- Alcalinité -->
                    <div class="form-group">
                        <label for="alcalinite" class="form-label">
                            <i class="ti ti-scale btn-icon"></i>
                            Alcalinité
                        </label>
                        <div class="input-with-unit">
                            <input type="number" id="alcalinite" name="alcalinite" step="0.1" min="0"
                                   class="form-control" placeholder="Ex: 120.3">
                            <span class="input-unit">mg/L CaCO₃</span>
                        </div>
                        <p class="form-hint">Mesurée en équivalent carbonate de calcium</p>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">
                            <i class="ti ti-rotate-2 btn-icon"></i>
                            Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-report-analytics btn-icon"></i>
                            Valider l'Analyse
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Animation au chargement
        document.addEventListener('DOMContentLoaded', () => {
            const elements = ['.header', '.card'];
            elements.forEach((selector, index) => {
                const el = document.querySelector(selector);
                if (el) {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(' + (20 + (index * 10)) + 'px)';

                    setTimeout(() => {
                        el.style.transition = 'opacity 0.4s ease ' + (index * 0.1) + 's, transform 0.4s ease ' + (index * 0.1) + 's';
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 100);
                }
            });
        });
    </script>
</body>
</html>
