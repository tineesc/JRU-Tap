<div>
    <x-slot name="trigger">
        <span class="inline-flex rounded-md">
            <button type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                Notification

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                </svg>
                <div class="relative flex">
                    <div class="relative inline-flex  border-2 border-white rounded-full -top-3 right-2 dark:border-gray-900">
                        <p  class="font-semibold text-md px-2 bg-yellow-300 p-1 rounded-full">{{ auth()->user()->notifications->count() }}</p>
                    </div>
                  </div>
            </button>
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="mx-5"> 
            <p class="font-semibold pt-2 text-md">Notification</p>
           <!-- Clear Notifications Button -->
           <form action="#" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-400 text-sm">Clear</button>
        </form>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        <x-dropdown-link href="#">
            @foreach (auth()->user()->notifications as $notification)
                <div>
                    <strong>{{ $notification->data['title'] }}</strong>
                    <p>{{ $notification->data['body'] }}</p>
                    <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    <!-- Add more details as needed -->
                </div>
            @endforeach
        </x-dropdown-link>
    </x-slot>
</div>
