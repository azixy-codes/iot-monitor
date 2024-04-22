<x-app-layout>

    <x-slot:title>Historique</x-slot:title>

    @if (session('success'))
    <x-success-alert class="my-2">{{ session('success') }}</x-success-alert>
    @endif

    <div class="relative overflow-x-auto shadow-md my-6 sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Nom du module
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Valeur mesurée
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Date de création
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($historique->count()>0)
                @foreach($historique as $record)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $record->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ ucfirst($record->module->nom) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $record->valeur_mesuree }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $record->created_at }}
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th colspan="4" scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap dark:text-white">
                        <svg class="h-5 w-5 text-yellow-400 inline-flex " x-description="Heroicon name: solid/exclamation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Pas de données d'historique pour le moment !
                    </th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $historique->links() }}
    </div>

</x-app-layout>