<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>{{ $title ?? 'Page Title' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <div class="fixed top-0 left-0 h-full w-64 bg-gray-100 shadow-md border">
        <div class="p-4">
            <h2 class="text-lg font-semibold mb-4">Menu</h2>
            <nav class="space-y-2">
                @guest()
                <a href="/login" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded">Login</a>
                <a href="/register" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded">Register</a>
                @endguest
                @auth()
                <a href="/dashboard" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded">Dashboard</a>
                <a href="/logout" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded">Logout</a>
                <a href="{{ route('friend.requests') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded">Friend Requests</a>
                @endauth
            </nav>
        </div>
    </div>

    {{ $slot }}
</body>
</html>
