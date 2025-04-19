<div class="text-white">
    <h1 class="text-3xl">Hello {{ auth()->user()->username }} !!!</h1>

    {{-- <livewire:chat-box /> --}}

</div>
{{-- <x-layouts.app :title="'Dashboard'">
    <h1>This is dashboard</h1>
    <p>Hello {{ auth()->user()->username }} !!!</p>

    <a href="{{ route('profile.show', ['username' => $user->username]) }}">View Profile</a>
</x-layouts.app> --}}