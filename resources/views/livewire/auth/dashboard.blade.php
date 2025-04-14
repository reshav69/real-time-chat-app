<div>
    <h1>This is dashboard</h1>
    <p>Hello {{ auth()->user()->username }} !!!</p>
        
    <a href="{{ route('profile.show', ['username' => $user->username]) }}">View Profile</a>

</div>
{{-- <x-layouts.app :title="'Dashboard'">
    <h1>This is dashboard</h1>
    <p>Hello {{ auth()->user()->username }} !!!</p>

    <a href="{{ route('profile.show', ['username' => $user->username]) }}">View Profile</a>
</x-layouts.app> --}}