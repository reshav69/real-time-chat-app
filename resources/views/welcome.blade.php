<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite('resources/css/app.css') {{-- Only if using Vite + Tailwind --}}
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex items-center justify-center">

    <div class="text-center p-8 bg-white shadow rounded">
        <h1 class="text-4xl font-bold mb-4">Welcome to Your Chat App 👋</h1>
        <p class="mb-6 text-gray-600">Start chatting with friends and groups in real-time!</p>
        <a href="{{ route('dashboard') }}"
           class="inline-block px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
            Go to Dashboard
        </a>
    </div>

</body>
</html>
