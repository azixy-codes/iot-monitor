@props(['notification'])

<div id="notification-{{ $notification->id }}" {{ $attributes->merge(['class' => 'w-full']) }}>


    <div class="rounded-md shadow bg-yellow-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" x-description="Heroicon name: solid/exclamation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">
                    Module en panne
                </h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <p>
                        {{ $notification->message }}
                    </p>
                </div>
                <div class="mt-4">
                    <div class="-mx-2 -my-1.5 flex">
                        <a id="markAsRead" href="{{ route('notifications.read', $notification->id) }}" class="bg-yellow-50 px-2 py-1.5 rounded-md text-sm font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-50 focus:ring-yellow-600">
                            Marquer comme lu
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full text-right">
            <p class="text-sm text-gray-800">{{ $notification->created_at->diffForHumans() }}
            <p>
        </div>
    </div>
</div>