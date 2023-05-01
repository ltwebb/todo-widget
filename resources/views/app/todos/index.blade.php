<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todo List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="lg:w-2/3 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:todo-list />
            </div>
        </div>
    </div>
</x-app-layout>
