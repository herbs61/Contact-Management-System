<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 rounded-lg shadow-xl text-white">
                <h3 class="text-2xl font-semibold mb-4">Welcome Back!</h3>
                <p class="text-lg">You're logged in and ready to go. Let's continue building something great!</p>
            </div>
        </div>
    </div>
</x-app-layout>
