<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="viewUserModal">
        <div class="glass-card w-full max-w-md">
            <div class="p-6 border-b border-[var(--input-border-color)] flex justify-between items-center">
                <h5 class="text-xl font-bold text-[var(--grand_titre_color)]">Détails de l'utilisateur</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('viewUserModal').classList.add('hidden')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Matricule:</label>
                    <p class="text-gray-800" id="view_matricule"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Nom:</label>
                    <p class="text-gray-800" id="view_nom"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Prénom:</label>
                    <p class="text-gray-800" id="view_prenom"></p> <!-- CORRIGÉ -->
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Email:</label>
                    <p class="text-gray-800" id="view_email"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Numéro de téléphone:</label>
                    <p class="text-gray-800" id="view_telephone"></p> <!-- CORRIGÉ -->
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">CIN:</label>
                    <p class="text-gray-800" id="view_cin"></p> <!-- CORRIGÉ -->
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[var(--text-color)] mb-2">Type:</label>
                    <p class="text-gray-800" id="view_type"></p>
                </div>
                <div id="view_details_specifiques" class="hidden">
                    <!-- Détails spécifiques ajoutés dynamiquement -->
                </div>
            </div>

    </div>

</body>
</html>
