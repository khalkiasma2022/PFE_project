<main class="main-content flex-1 p-6 overflow-y-auto">
    <header class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-[var(--grand_titre_color)] flex items-center">
            <i class="fas fa-users mr-2"></i>Gestion des Utilisateurs
        </h2>
        <div class="dropdown">
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <a href="{{ route('createAccount_view') }}"
               class="flex items-center justify-center px-4 py-2 bg-[var(--primary-color)] hover:bg-[var(--primary-hover-color)] text-white rounded-xl transition transform hover:scale-[1.02]">
                <i class="fas fa-plus mr-2"></i>Nouvel Utilisateur
            </a>

            <a href="{{ route('UpdateAccount_view') }}"
               class="flex items-center justify-center px-4 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded-xl transition transform hover:scale-[1.02]">
                <i class="fas fa-edit mr-2"></i>Modifier Utilisateur
            </a>
        </div>
        </div>
    </header>

    <!-- Filtres -->
    <section class="glass-card mb-6">
        <div class="p-6">
            <form id="filterForm" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="typeFilter" class="block text-sm font-medium text-[var(--text-color)] mb-2">Type</label>
                    <select id="typeFilter" class="w-full px-4 py-3 rounded-xl border border-[var(--input-border-color)] input-focus focus:outline-none focus:border-[var(--primary-color)] transition duration-200">
                        <option value="">Tous</option>
                        <option value="technicien">Technicien</option>
                        <option value="responsable">Responsable</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="button" id="resetFilters" class="w-full px-4 py-3 bg-white border border-[var(--input-border-color)] rounded-xl hover:bg-gray-50 transition flex items-center justify-center space-x-2">
                        <i class="fas fa-undo"></i>
                        <span>Réinitialiser</span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Tableau des utilisateurs -->
    <section class="glass-card overflow-hidden">
        <div class="p-6 border-b border-[var(--input-border-color)] flex justify-between items-center">
            <h3 class="text-lg font-medium text-[var(--grand_titre_color)] flex items-center">
                <i class="fas fa-list mr-2"></i>Liste des Utilisateurs
            </h3>
        </div>
        <div class="p-6">
            <table id="usersTable" class="w-full" style="width:100%">
                <thead>
                    <tr class="text-left border-b border-[var(--input-border-color)]">
                        <th class="pb-4 text-[var(--text-color)]">Matricule</th>
                        <th class="pb-4 text-[var(--text-color)]">Nom</th>
                        <th class="pb-4 text-[var(--text-color)]">Email</th>
                        <th class="pb-4 text-[var(--text-color)]">Type</th>
                        <th class="pb-4 text-[var(--text-color)]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-[var(--input-border-color)] hover:bg-blue-50 transition">
                        <td class="py-4">{{ $user->Matricule }}</td>
                        <td class="py-4">{{ $user->Nom }}</td>
                        <td class="py-4">{{ $user->Email }}</td>
                        <td class="py-4">
                            @if($user->type === 'technicien')
                                <span class="py-4">Technicien</span>
                            @else
                                <span class="py-4">Responsable</span>
                            @endif
                        </td>
                        <td class="py-4">
                            <div class="flex space-x-2">
                                @if($user->type === 'technicien')
                                    <a href="{{route('updateTechnicien')}}" class="w-8 h-8 flex items-center justify-center bg-yellow-100 hover:bg-yellow-200 text-yellow-600 rounded-lg transition" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="{{route('updateResponsable')}}" class="w-8 h-8 flex items-center justify-center bg-yellow-100 hover:bg-yellow-200 text-yellow-600 rounded-lg transition" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <button
                                    class="w-8 h-8 flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition view-user"
                                    data-id="{{ $user->Matricule }}"
                                    data-nom="{{ $user->Nom }}"
                                    data-prenom="{{ $user->Prenom ?? '' }}"
                                    data-email="{{ $user->Email }}"
                                    data-telephone="{{ $user->Telephone ?? '' }}"
                                    data-cin="{{ $user->Cin ?? '' }}"
                                    title="Détails">
                                    <i class="fas fa-info-circle"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>
