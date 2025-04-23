<div class="text-white p-4">
    <h1 class="text-3xl mb-5">Hello {{ auth()->user()->username }} !!!</h1>

    <p class="border-b border-gray-400 p-2 mb-5">Your Friends:</p>
    

    <livewire:friend-list />

</div>
{{-- <x-layouts.app :title="'Dashboard'">
    <h1>This is dashboard</h1>
    <p>Hello {{ auth()->user()->username }} !!!</p>

    <a href="{{ route('profile.show', ['username' => $user->username]) }}">View Profile</a>
</x-layouts.app> --}}