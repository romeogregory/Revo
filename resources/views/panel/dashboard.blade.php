<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    @if (session()->has('mode') == 'administrator')
        {{ session('mode') }}
    @endif
</x-app-layout>
