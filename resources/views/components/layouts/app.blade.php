{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
         
    </head>
    <body>
        

    </body>
</html> --}}
<x-layouts.app.sidebar :title="$title ?? null">
    {{ $slot }}
</x-layouts.app.sidebar>