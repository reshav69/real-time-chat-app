{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
         
    </head>
    <body>
        

    </body>
</html> --}}
<x-layouts.app.sidebar :title="$title ?? null">
    @include('components.success-card')



    {{ $slot }}
    @vite('resources/js/app.js')
</x-layouts.app.sidebar>