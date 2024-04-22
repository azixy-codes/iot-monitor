<!-- Menu des réglages et notifications -->
<div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">

    <!-- Bouton d'ouverture du menu mobile -->
    <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="open = true">
        <span class="sr-only">Ouvrir le menu latéral</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
        </svg>
    </button>


    <div class="flex-1 px-4 flex justify-end">

        <div class="ml-4 flex items-center md:ml-6">

            <!-- Boutons de Notifications -->
            <div x-data="{ openNotifications: false }" @keydown.escape.stop="openNotifications = false" @click.away="openNotifications = false" class="ml-3 relative">
                <button type="button" class="flex relative bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="openNotifications = !openNotifications" @keyup.space.prevent="openNotifications = !openNotifications" @keydown.enter.prevent="openNotifications = !openNotifications" aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="openNotifications.toString()">
                    <span class="sr-only">Voir les notifications</span>
                    @if( $allNotifications->where('read', 0)->count() > 0)
                    <span class="absolute bg-red-600 text-white rounded-full text-xs px-2 -top-1 -left-2">{{ $allNotifications->where('read', 0)->count() }}</span>
                    @endif
                    <svg class="h-6 w-6 {{ $allNotifications->where('read', 0)->count() > 0 ? 'text-red-600' : ''}}" x-description="Heroicon name: outline/bell" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </button>

                <!-- Dropdown des notifications -->
                <div x-cloak x-show="openNotifications" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-64 md:w-96 rounded-md shadow-lg py-0 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden" x-ref="menu-items" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                    <!-- Si il existe des notifications -->
                    @if($allNotifications->count() > 0)

                    @foreach($allNotifications as $notification)

                    <!--Notification et lu -->
                    @if($notification->read == 1)
                    <a href="{{ route('notifications.show', $notification->id) }}" class="hover:bg-white block px-4 py-2 text-sm text-gray-900 border-gray-500 border-l-4 bg-gray-50" role="menuitem" @click="openNotifications = false">{{ $notification->message }}</a>

                    <!-- Notification non lu -->
                    @else
                    <a href="{{ route('notifications.show', $notification->id) }}" class="hover:bg-white block px-4 py-2 text-sm text-gray-900 border-{{ $notification->type === 'panne' ? 'yellow' : '' }}{{ $notification->type === 'info' ? 'blue' : '' }}-500 border-l-4 bg-{{ $notification->type === 'panne' ? 'yellow' : '' }}{{ $notification->type === 'info' ? 'blue' : '' }}-50" role="menuitem" @click="openNotifications = false">{{ $notification->message }}</a>
                    @endif

                    <hr class="bg-yellow-50 bg-blue-50">

                    @endforeach
                    <a class="float-right text-sm p-3 text-blue-600 hover:underline" href="{{route('notifications.index')}}">Voir tout</a>

                    <!-- Pas de notifications -->
                    @else
                    <p class="text-sm p-3 text-gray-500">Pas de notifications pour le moment !</p>
                    @endif
                </div>
            </div>

            <!-- Profil Dropdown -->
            <div x-data="{ openDropdown: false, activeIndex: 0 }" @keydown.escape.stop="openDropdown = false" @click.away="openDropdown = false" class="ml-3 relative">
                <div>
                    <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu-button" x-ref="button" @click="openDropdown = !openDropdown" @keyup.space.prevent="openDropdown = !openDropdown" @keydown.enter.prevent="openDropdown = !openDropdown" aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="openDropdown.toString()">
                        <span class="sr-only">Ouvrir le menu du profil</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 rounded-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                    </button>
                </div>

                <div x-cloak x-show="openDropdown" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg overflow-hidden bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="menu-items" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 text-sm text-gray-700" :class="{ 'bg-gray-100': activeIndex === 2 }" role="menuitem" tabindex="-1" id="user-menu-item-2" @mouseenter="activeIndex = 2" @mouseleave="activeIndex = -1" @click="openDropdown = false">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden border-yellow-500"></div>
</div>