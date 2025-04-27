<div class="flex items-center justify-center">
    <form wire:submit="register" class="border rounded-xl shadow p-8 w-full max-w-md">
        @csrf
        <!-- Username Input -->
        <div class="mb-4">
            <x-input class="w-full"
                type="text" 
                id="username" 
                wire:model="username" 
                name="username" 
                placeholder="Enter your username" 
                label="Username"
            />

        </div>

        <!-- Email Input -->
        <div class="mb-4">
            <x-input class="w-full"
                type="email" 
                id="email" 
                wire:model="email" 
                name="email" 
                placeholder="example@domain.com" 
                label="Email Address"
            />

        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <x-input class="w-full"
                type="password" 
                id="password" 
                wire:model="password" 
                name="password" 
                placeholder="Enter your password" 
                label="Password"
            />

        </div>

        <!-- Confirm Password Input -->
        <div class="mb-4">
            <x-input class="w-full"
                type="password" 
                id="password_confirmation" 
                wire:model="password_confirmation" 
                name="password_confirmation" 
                placeholder="Confirm your password" 
                label="Confirm Password"
            />

        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center">
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            >
                Register
            </button>
            <div class="ml-5">
                <a class="underline text-indigo-500" href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </form>
</div>
