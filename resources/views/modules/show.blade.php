<x-app-layout>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <x-slot:title>{{ $module->nom }}</x-slot:title>

    <!-- Affichage d'une notification de panne si il y en a -->
    @if($module->notificationsNonLus()->where('type', 'panne')->count() > 0)
    <x-panne-alert :notification="$module->notificationsNonLus()->where('type', 'panne')->last()" class="my-2"></x-panne-alert>
    @endif

    <!-- Message de succés en cas d'ajout/modification/suppression -->
    @if (session('success'))
    <x-success-alert class="my-2">{{ session('success') }}</x-success-alert>
    @endif

    <div class="flex gap-4">
        <!-- Graph des valeurs mesurées -->
        <div class="w-7/12">
            <div class="relative overflow-x-auto shadow-md my-6 sm:rounded-lg bg-white p-2">
                <x-line-chart :$module></x-line-chart>
            </div>
        </div>
        <!-- Tableau d'informations du module -->
        <div class="w-5/12">
            <div class="relative overflow-x-auto shadow-md my-6 sm:rounded-lg text-yellow-600">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <tr>
                        <th scope="col" class="text-xs text-gray-700 border-b border-white  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-6 py-4">
                            Nom du Module
                        </th>
                        <td scope="col" class="bg-white font-bold border-b dark:bg-gray-800 dark:border-gray-700 px-6 py-4">
                            {{ $module->nom }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-xs text-gray-700 border-b border-white  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-6 py-4">
                            Type de mesure
                        </th>
                        <td scope="col" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 px-6 py-4">
                            {{ ucfirst($module->type_de_mesure?->nom)  }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-xs text-gray-700 border-b border-white  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-6 py-4">
                            Dernière valeur
                        </th>
                        <td scope="col" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 px-6 py-4">
                            {{ $module->historique->last()?->valeur_mesuree }}
                            <span class="text-xs float-right">{{ $module->historique->last()?->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-xs text-gray-700 border-b border-white  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-6 py-4">
                            Etat
                        </th>
                        <td scope="col" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 px-6 py-4">
                            <span class="font-semibold text-{{ $module->etat_marche === 0 ? 'red' : '' }}{{ $module->etat_marche === 1 ? 'green' : '' }}{{ $module->etat_marche === 2 ? 'yellow' : '' }}-600">
                                {{ $module->etat_marche === 0 ? 'En arret' : '' }}
                                {{ $module->etat_marche === 1 ? 'En marche' : '' }}
                                {{ $module->etat_marche === 2 ? 'En panne' : '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-xs text-gray-700 border-b border-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-6 py-4">
                            Données
                        </th>
                        <td scope="col" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 px-6 py-4">
                            {{ $module->donnees_envoyees }} MB
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-6 py-4">
                            Actions
                        </th>
                        <td scope="col" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 px-6 py-4">
                            <a href="{{ route('modules.edit', $module->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</a>
                            <form class="inline" action="{{ route('modules.destroy', $module->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="ml-2 font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>


</x-app-layout>