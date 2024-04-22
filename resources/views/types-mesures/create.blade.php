<x-app-layout>

    <x-slot:title>Ajouter un type de mesure</x-slot:title>

    <div class="max-w-xl mx-auto my-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('types_mesures.store') }}" method="POST">
                @csrf
                <div class="p-8 flex items-center justify-center">
                    <div class="w-full space-y-4">
                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-base font-medium text-gray-700">Nom<span class="text-red-600">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="nom" id="nom" class="block w-full pr-10 sm:text-base rounded-md focus:outline-none @error('nom') focus:ring-red-500 focus:border-red-500 border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="Nom du type de mesure" aria-invalid="true" aria-describedby="erreur-nom" value="{{ old('nom') }}">

                                @error('nom')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @enderror
                            </div>
                            @error('nom')
                            <p class="mt-2 text-sm text-red-600" id="erreur-nom">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bouton d'envoie -->
                        <div class="text-right">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-base px-5 py-1 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ajouter
                            </button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>