<x-app-layout>

    <x-slot:title>Ajouter un module</x-slot:title>

    <div class="max-w-xl mx-auto my-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('modules.store') }}" method="POST">
                @csrf
                <div class="p-8 flex items-center justify-center">
                    <div class="w-full space-y-4">
                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-base font-medium text-gray-700">Nom<span class="text-red-600">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="nom" id="nom" class="block w-full pr-10 sm:text-base rounded-md focus:outline-none @error('nom') focus:ring-red-500 focus:border-red-500 border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="Nom de votre module" aria-invalid="true" aria-describedby="erreur-nom" value="{{ old('nom') }}">

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

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-base font-medium text-gray-700">Description</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <textarea type="text" rows="5" name="description" id="description" class="block w-full pr-10  sm:text-base rounded-md focus:outline-none @error('description') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Description de votre module" aria-invalid="true" aria-describedby="erreur-description">{{ old('description') }}</textarea>

                                @error('description')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @enderror
                            </div>
                            @error('description')
                            <p class="mt-2 text-sm text-red-600" id="erreur-description">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Données par seconde -->
                        <div>
                            <label for="donnees" class="block text-base font-medium text-gray-700">Données par seconde (KB)<span class="text-red-600">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="donnees" id="donnees" class="block w-full pr-10 sm:text-base rounded-md focus:outline-none @error('donnees') focus:ring-red-500 focus:border-red-500 border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="donnees par seconde (1-10)" aria-invalid="true" aria-describedby="erreur-donnees" value="{{ old('donnees') }}">

                                @error('donnees')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @enderror
                            </div>
                            @error('donnees')
                            <p class="mt-2 text-sm text-red-600" id="erreur-donnees">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type de mesure -->
                        <div>
                            <label class="block text-base font-medium text-gray-700">Type de mesure<span class="text-red-600">*</span></label>

                            @foreach($types_mesures as $type)
                            <div class="mt-1 relative flex">
                                <div class="flex items-center me-4">
                                    <input id="type-{{ $type->id }}" type="radio" value="{{ $type->id }}" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @checked(( old('type')===(string) $type->id ))>
                                    <label for="type-{{ $type->id }}" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ ucfirst($type->nom) }}</label>
                                </div>
                            </div>
                            @endforeach
                            @error('type')
                            <p class="mt-2 text-sm text-red-600" id="erreur-type">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Etat du module -->
                        <div>
                            <label class="block text-base font-medium text-gray-700">Etat<span class="text-red-600">*</span></label>
                            <div class="mt-1 relative flex">
                                <div class="flex items-center me-4">
                                    <input id="etat-arret" type="radio" value="0" name="etat" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @checked((old('etat')==='0' ))>
                                    <label for="etat-arret" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">En arret</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="etat-marche" type="radio" value="1" name="etat" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @checked((old('etat')==='1' ))>
                                    <label for="etat-marche" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">En marche</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="etat-panne" type="radio" value="2" name="etat" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @checked((old('etat')==='2' ))>
                                    <label for="etat-panne" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">En panne</label>
                                </div>
                            </div>

                            @error('etat')
                            <p class="mt-2 text-sm text-red-600" id="erreur-type">{{ $message }}</p>
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