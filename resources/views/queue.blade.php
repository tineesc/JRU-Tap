<x-app-layout>
    <style>
        .image {
            background-image: url('https://scontent.fmnl17-4.fna.fbcdn.net/v/t39.30808-6/333301757_5309027922533223_2056172026227239585_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeGXrbmiZs729RKtF70JIW0zqLDwnf8V-zmosPCd_xX7OQ6Nglq9qsHozfeydOVqKV8BbucROe1C03BuhoXdvcMh&_nc_ohc=iiyc_y8isowAX8_KGgf&_nc_ht=scontent.fmnl17-4.fna&oh=00_AfAgE2SXMjc9cuH0JX1jhw1NRFTzU2YKqVCAt7RtL7E7UA&oe=64F1FA9E');
        }
    </style>
    <x-slot name="header">
       <div class="flex flex-row justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Queue Section') }}
                <p class="text-slate-500 text-sm py-2">List of Queue</p>
            </h2>
        </div>
       
       </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

               

            </div>
        </div>
    </div>
</x-app-layout>
