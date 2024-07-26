<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1>Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
        </h2>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.registration_report')" :active="request()->routeIs('dashboard')">
                {{ __('registration Report') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.technology_report')" :active="request()->routeIs('dashboard')">
                {{ __('Technology Report ') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('map_based_report')" :active="request()->routeIs('map_based_report')">
                {{ __('Map Based Report ') }}
            </x-responsive-nav-link>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

            </div>
            
        </div>
    </div>
    @if(Auth::check() && Auth::user()->isAdmin == 1)
    <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="font-semibold text-lg mb-4">Reports</h3>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.registration_report') }}" class="text-blue-600 hover:underline">Registration Report</a>
                </li>
                <li>
                    <a href="{{ route('admin.technology_report') }}" class="text-blue-600 hover:underline">Technology Report fedfesdf</a>
                </li>

                <li>
                    <a href="{{ route('map_based_report') }}" class="text-blue-600 hover:underline">Map Based Report</a>
                </li>
            </ul>
        </div>
    </div>
    @endif
</x-app-layout>
