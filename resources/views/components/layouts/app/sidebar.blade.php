<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="min-h-screen flex bg-white dark:bg-zinc-900">

    <!-- Left Sidebar -->
    <aside class="h-full w-44 sm:w-60 fixed top-0 left-0 border-r border-indigo-800 shadow-md bg-white dark:bg-zinc-900 text-black dark:text-white z-10">
        <div class="flex flex-col h-full p-4 space-y-4">
            <h2 class="text-lg font-bold border-b border-indigo-500 pb-2">Menu</h2>

            <nav class="flex-1 space-y-2">
                @guest
                    <a href="/login" class="block px-4 py-2 rounded hover:bg-gray-200 hover:text-gray-900">Login</a>
                    <a href="/register" class="block px-4 py-2 rounded hover:bg-gray-200 hover:text-gray-900">Register</a>
                @endguest

                @auth
                    <div class="space-y-2">
                        <a href="/dashboard"
                        class="block px-4 py-2 border border-sky-600 rounded hover:bg-gray-800 hover:text-gray-300">
                        <i class="bi bi-house-door-fill"></i>
                        Dashboard</a>
                        <a href="{{ route('friend.requests') }}"
                        class="block px-4 py-2 border border-sky-600 rounded hover:bg-gray-800 hover:text-gray-300">
                        <i class="bi bi-person-lines-fill"></i> Friend Requests</a>
                        <a href="{{ route('groups.create') }}"
                        class="block px-4 py-2 border border-sky-600 rounded hover:bg-gray-800 hover:text-gray-300">
                        <i class="bi bi-people-fill"></i> Groups</a>
                    </div>

                    <div class="mt-6 h-[40vh] overflow-y-auto">
                        <h3 class="text-md font-semibold mb-2 border-b border-indigo-500">Group List</h3>
                        <div class="space-y-2">
                            <p>WORK TO BE DONE</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-indigo-500 bottom-0">
                        <p class="font-bold underline my-2">
                            <a href="{{ route('profile.show', ['username' => auth()->user()->username]) }}">
                                {{ auth()->user()->username }}
                            </a>
                        </p>
                        <a href="/logout" class="block w-full py-1 text-center border border-sky-600 rounded hover:bg-red-500">
                            <i class="bi bi-box-arrow-right"> Logout</i>
                        </a>
                        
                    </div>
                @endauth
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-44 sm:ml-60 mr-40 sm:mr-60 relative overflow-x-hidden text-black dark:text-white">

        <!-- Background Pattern -->
        {{-- <div class="absolute inset-0 -z-10">
            <div class="h-full w-full bg-black bg-[radial-gradient(#ffffff33_1px,#00091d_1px)] bg-[size:20px_20px]"></div>
        </div> --}}

        @include('components.layouts.app.navbar')

        <div class="">
            {{ $slot }}
        </div>

    </main>

    <!-- Right Sidebar -->
    <aside class="h-full w-40 sm:w-60 fixed top-0 right-0 border-l border-indigo-800 shadow-md bg-white dark:bg-zinc-900 text-black dark:text-white z-10">
        @auth
            <div class="p-4 h-[calc(50vh-64px)] overflow-y-auto">
                <h2 class="text-lg font-bold mb-4 border-b border-indigo-500">Search</h2>
                @livewire('search-component')
            </div>

            <div class="p-4 h-[calc(50vh-64px)] overflow-y-auto border-t border-indigo-500">
                <h2 class="text-lg font-bold mb-4 border-b border-indigo-500">Recent Chats</h2>
                <nav class="space-y-2">
                    WORK TO BE DONE
                </nav>
            </div>
        @endauth
    </aside>

    @livewireScripts
</body>
</html>
