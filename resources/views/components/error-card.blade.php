@if ($errors->any())
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        class="rounded-2xl shadow-md bg-red-100 border border-red-300 p-4 mb-4 text-red-800 relative"
    >
        <button 
            @click="show = false" 
            class="absolute top-2 right-2 text-red-700 hover:text-red-900"
        >
            ✕
        </button>
        <div class="font-semibold text-lg">❌ Error</div>
        <ul class="list-disc list-inside mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        class="rounded-2xl shadow-md bg-red-100 border border-red-300 p-4 mb-4 text-red-800 relative"
    >
        <button 
            @click="show = false" 
            class="absolute top-2 right-2 text-red-700 hover:text-red-900"
        >
            ✕
        </button>
        <div class="font-semibold text-lg">❌ Error</div>
        <p class="mt-1">{{ session('error') }}</p>
    </div>
@endif
