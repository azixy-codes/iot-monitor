<x-app-layout>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <x-slot:title>Liste des Modules</x-slot:title>

    <!-- Message de succés en cas d'ajout/modification/suppression -->
    @if (session('success'))
    <x-success-alert class="my-2">{{ session('success') }}</x-success-alert>
    @endif

    <div class="relative overflow-x-auto shadow-md my-6 sm:rounded-lg text-yellow-600">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        Nom du Module
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Type de mesures
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Dernière valeur
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Durée
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Données
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Etat
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Historique
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Existance de module(s) -->
                @if($modules->count()>0)

                @foreach($modules as $module)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('modules.show', $module->id) }}" class="text-base">{{ $module->nom }}</a>
                        <div>
                            <a href="{{ route('modules.edit', $module->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</a>
                            <form class="inline" action="{{ route('modules.destroy', $module->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="ml-2 font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{ ucfirst($module->type_de_mesure->nom) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $module->historique->last()?->valeur_mesuree }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $module->duree_fonctionnement }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $module->donnees_envoyees }} MB
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-semibold text-{{ $module->etat_marche === 0 ? 'red' : '' }}{{ $module->etat_marche === 1 ? 'green' : '' }}{{ $module->etat_marche === 2 ? 'yellow' : '' }}-600">
                            {{ $module->etat_marche === 0 ? 'En arret' : '' }}
                            {{ $module->etat_marche === 1 ? 'En marche' : '' }}
                            {{ $module->etat_marche === 2 ? 'En panne' : '' }}
                        </span>
                    </td>
                    <td class="px-6 py-4" style="width: 200px !important; height: 100px !important; max-width: 200px; max-height: 100px">
                        @if(count($module->historique)>0)
                        <!-- Diagramme d'historique -->
                        <x-bar-chart :$module></x-bar-chart>
                        @endif
                    </td>
                </tr>
                @endforeach
                <!-- Pas de module(s) -->
                @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th colspan="4" scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap dark:text-white">
                        <svg class="h-5 w-5 text-yellow-400 inline-flex " x-description="Heroicon name: solid/exclamation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Pas de modules créés pour le moment !
                    </th>
                </tr>
                @endif
            </tbody>
        </table>

    </div>

    <div class="pagination">
        {{ $modules->links() }}
    </div>

</x-app-layout>