@props(['message' => null])

@if (session()->has('success') || $message)
    <div x-data="{ show: true }" x-show="show" x-transition 
        class="rounded-2xl shadow-md bg-green-100 border border-green-300 p-4 mb-4 text-green-800 relative">
        
        <button @click="show = true" class="absolute top-2 right-2 text-green-700 hover:text-green-900">
            ✕
        </button>
        
        <div class="font-semibold text-lg">✅ Success</div>
        <p class="mt-1">
            {{ $message ?? session('success') }}
        </p>
    </div>
@endif
