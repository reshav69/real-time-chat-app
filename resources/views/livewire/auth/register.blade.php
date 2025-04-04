<div>
    <form wire:submit="register">
        <div>
            <input type="text" id="name" wire:model="username">
        </div>
        <div>
            <input type="email" id="email" wire:model="email">
        </div>

        <div>
            <input type="password" id="password" wire:model="password">
        </div>
        <div>
            <input type="password" id="password_confirmation" wire:model="password_confirmation"/>
        </div>

        <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">
            Register
       </button

    </form>
</div>
