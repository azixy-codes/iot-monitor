<x-app-layout>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <x-slot:title>Tableau de bord</x-slot:title>

    <div class="flex flex-wrap md:flex-nowrap gap-3">
        <!-- Graph des valeurs mesurées -->
        <div class="w-full md:w-7/12">
            <div class="relative overflow-x-auto shadow-md my-6 rounded-md sm:rounded-lg bg-white p-2">
                <x-multiline-chart :modules="$modules"></x-multiline-chart>
                <p class="text-gray-600 text-center text-base mt-3">Module(s) en marche</p>
            </div>
        </div>
        <!-- Tableau d'informations du module -->
        <div class="w-full md:w-5/12">
            <div class="relative shadow-md my-6 rounded-md overflow-hidden sm:rounded-lg text-gray-700 bg-white">
                <h3 class="font-semibold border-b text-lg p-3">Notifications récentes</h3>
                <div class="text-sm">
                    @if($allNotifications->count()>0)
                    @foreach($allNotifications as $notification)
                    <a href="{{ route('modules.show', $notification->module_id) }}" class="block border-b py-2 px-2 {{ ($notification->read == 0) ? 'bg-yellow-50' : '' }}">
                        <p>{{ $notification->message }}</p>
                        <p class="text-xs text-right">{{ $notification->created_at->diffForHumans() }}</p>
                    </a>
                    @endforeach
                    @else
                    <p class="p-2">Pas de notifications pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


</x-app-layout>