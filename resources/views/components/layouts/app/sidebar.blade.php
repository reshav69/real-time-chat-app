<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>{{ $title ?? 'Page Title' }}</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"
    />
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen light:bg-white dark:bg-zinc-900 flex">

    <div class="h-full w-44 sm:w-60 shadow-md border-indigo-500 border-r text-white fixed top-0 left-0">
        <div class="p-4">
            <h2 class="text-lg font-semibold mb-4 border-indigo-500 border-b">Menu</h2>
            <nav class="space-y-2 w-full">
                @guest()
                <a href="/login" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Login</a>
                <a href="/register" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Register</a>
                @endguest
                @auth()
                <div class=" space-y-5 mb-4">

                    <a href="/dashboard" class="border-sky-600 border block py-2 px-4 hover:bg-gray-800 hover:text-gray-300 rounded">Dashboard</a>
                    <a href="{{ route('friend.requests') }}" class="border-sky-600 border block py-2 px-4 hover:bg-gray-800 hover:text-gray-300 rounded">Friend Requests</a>
                </div>
                <div class="p-4 h-[55vh] overflow-y-auto">
                    <h2 class="text-lg flex font-semibold mb-4 border-indigo-500 border-b">Group List</h2>
                    <div class="space-y-2 overflow-y-auto">
                        <p>WORK TO BE DONE</p>
 
                            
                    </div>
                </div>

                <div class="fixed bottom-0 border-t w-48 mb-4">
                    <p class="mt-4 mb-4 font-bold underline">
                        <a href="{{ route('profile.show',['username'=>auth()->user()->username]) }}">
                        {{ auth()->user()->username }}
                    </a></p>
                    <a href="/logout" class="border-sky-600 border block py-1 px-1 hover:bg-red-500 rounded">
                        Logout</a>
                </div>
                @endauth
            </nav>
        </div>
    </div>
    

    <div class="flex-1 ml-44 mr-auto ml-auto sm:ml-60 mr-40 sm:mr-60 text-white">

        @include('components.layouts.app.navbar')
        
        {{ $slot }}

    </div>

    <div class="h-full w-40 sm:w-60 shadow-md border-indigo-500 border-l text-white fixed top-0 right-0">
        @auth()
        <div class="p-4 h-[calc(100vh-300px)] overflow-y-auto">
            <h2 class="text-lg flex font-semibold mb-4 border-indigo-500 border-b">Search</h2>
            <nav class="space-y-2">
                @livewire('search-component')
                    
            </nav>
        </div>
        {{-- <hr> --}}
        <div class="p-4 h-[calc(100vh-64px)] overflow-y-auto">
            <h2 class="text-lg flex font-semibold mb-4 border-indigo-500 border-b">Recent Chats</h2>
            <nav class="space-y-2">
                WORK TO BE DONE
                    
            </nav>
        </div>
        @endauth
    </div>
    {{-- <div class="text-white">
        
        @guest()
        <a href="/login">login</a>
        
        <a href="/register">register</a>
        @endguest
        @auth() 
        <a href="/dashboard">dashboard</a>
        <a href="/logout">logout</a>
        <a href="{{ route('friend.requests') }}">Friend Requests</a>
        @endauth
    </div> --}}

    {{-- 
    <div class="fixed top-0 left-0 h-full w-64 shadow-md ">
        <div class="p-4">
            <h2 class="text-lg font-semibold mb-4">Menu</h2>
            <nav class="space-y-2">
                @guest()
                <a href="/login" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Login</a>
                <a href="/register" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Register</a>
                @endguest
                @auth()
                <a href="/dashboard" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Dashboard</a>
                <a href="/logout" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Logout</a>
                <a href="{{ route('friend.requests') }}" class="block py-2 px-4 hover:bg-gray-200 hover:text-gray-900 rounded">Friend Requests</a>
                @endauth
            </nav>
        </div>
    </div> --}}
    @livewireScripts
</body>
</html>
