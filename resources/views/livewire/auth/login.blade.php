<div>
    <form wire:submit="login" class="border rounded px-8 pt-6 pb-8 mb-4 w-fit container mx-auto">
        <div>
            <x-input type="email" id="email" wire:model="email" name="email"
             placeholder="test@exmaple.com" label="Input email"/>
            {{-- <input type="email" id="email" wire:model="email"> --}}
        </div>

        <div>
            <x-input type="password" id="password" wire:model="password" name="password"
            label="Input Password"/>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700
            text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >Login</button>

        </div>

    </form>
</div>
