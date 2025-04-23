<div>
    <form wire:submit="register" class="border rounded px-8 pt-6 pb-8 mb-4 w-fit container mx-auto">
        <div class="mb-4">
            <x-input type="text" id="username" wire:model="username" name="username"
             placeholder="test" label="Input username"/>
        </div>
        <div class="mb-4">
            <x-input type="email" id="email" wire:model="email" name="email"
             placeholder="test@exmaple.com" label="Input email"/>

        </div>

        <div class=mb-4>
            <x-input type="password" id="password" wire:model="password" name="password"
            label="Input password"/>

        </div>
        <div class="mb-4">
            <x-input type="password" id="password_confirmation" wire:model="password_confirmation"
             name="password_confirmation" label="Confirm password"/>
            {{-- <input type="password" id="password_confirmation" wire:model="password_confirmation"/> --}}
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700
            text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Register
       </button

    </form>
</div>
