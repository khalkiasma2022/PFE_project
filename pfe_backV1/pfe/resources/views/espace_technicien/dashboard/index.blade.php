<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Technicien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Tableau de Bord Technicien</h1>
        
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-lg">Bienvenue, {{ $technicien->Nom_tech }} !</p>
            <p class="mt-2">Matricule: {{ $technicien->Matricule_tech }}</p>
            <p>Email: {{ $technicien->Email_tech ?? 'Non renseigné' }}</p>

            <form action="{{ route('technicien.logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</body>
</html>
