<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
{{--                {{ $slot }}--}}
  <h1>Welcome to the Application</h1>

        @auth
            @php
                $user = auth()->user();
            @endphp

            <p>Hello, {{ $user->name ?? 'Guest' }}!</p>
            <p>Email: {{ $user->email ?? 'N/A' }}</p>
            @if(isset($user->userable))
                <p>Client Info: {{ $user->userable->name ?? 'N/A' }}</p>
@if(isset($user->userable) && $user->userable->teams)
    @foreach($user->userable->teams as $team)
        <p>Team: {{ $team->name }}</p>
    @endforeach
@endif
            @endif
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to continue.</p>
        @endauth
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
