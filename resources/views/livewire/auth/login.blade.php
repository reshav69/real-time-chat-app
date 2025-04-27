
<div class="flex items-center justify-center">
    <form wire:submit="login" class="border rounded-xl shadow p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800 dark:text-gray-100">Login</h2>
        <div class="mb-5">
            <x-input class="w-full"
                type="email" 
                id="email" 
                wire:model="email" 
                name="email" 
                placeholder="test@example.com" 
                label="Email"
            />
        </div>

        <div class="mb-6">
            <x-input class="w-full"
                type="password" 
                id="password" 
                wire:model="password" 
                name="password" 
                label="Password"
            />
        </div>

        @if (session()->has('error'))
            <div class="mb-4 text-sm text-red-600 dark:text-red-400 text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex items-center justify-center">
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            >
                Login
            </button>
            <div class="ml-5">
                <a class="underline text-indigo-500" href="{{ route('register') }}">Register here</a>
            </div>
        </div>
    </form>
</div>
