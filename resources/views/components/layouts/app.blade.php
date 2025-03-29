<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        @guest()
            <a href="/login">login</a>

            <a href="/register">register</a>
        @endguest
        @auth()
            <a href="/logout">logout</a>
        @endauth
        {{ $slot }}

    </body>
</html>