<div class="p-4">
    <form wire:submit.prevent="updateProfile"
     class="w-full border container mx-auto rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-20">
        <div>
            <div class="mb-4">
                <x-input id="username" type="text" wire:model="username" name="username"
                    label="Username:"
                />
                 @error('username') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input id="email" type="email" wire:model="email" name="email"
                    label="Email:"
                />
                @error('email') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-200 text-sm font-bold mb-2">
                    Bio:</label>
                <textarea class="shadow appearance-none border rounded py-2 px-3 leading-tight
                     focus:outline-none focus:shadow-outline text-white" cols="30" rows="5"
                 id="bio" wire:model="bio"></textarea>
                @error('bio') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input id="password" type="password" wire:model="password" name="password"
                    label="New Password (Leave blank if unchanged):"
                />
            </div>

            <div class="mb-4">
                <x-input id="password_confirmation" type="password" wire:model="password_confirmation" name="password_confirmation"
                    label="Confirm Password"
                />
                @error('password') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="">

            <div class="mb-4">
                <label>Profile Image:</label>


                @if ($profile_image && ! $new_profile_image)
                     <img src="{{ asset('storage/' . $profile_image) }}"
                    class="w-42 h-42 object-cover rounded-full mb-4">
                @elseif ($new_profile_image)
                    <img src="{{ $new_profile_image->temporaryUrl() }}"
                    class="w-42 h-42 object-cover rounded-full mb-4">
                @else

                    <img src="{{ asset('storage/user-pics/default.png') }}" width="200px"
                    class="object-cover rounded-full mb-4" >
                @endif


            </div>

            <div class="mb-4">
                <label for="new_profile_image" class="block text-sm font-bold mb-2">
                    Upload New Profile Image:</label>
                <input type="file" wire:model="new_profile_image" id="new_profile_image" name="new_profile_image" {{-- Corrected wire:model and name --}}
                    class="w-full border p-2 rounded border-gray-300 bg-indigo-600 hover:outline"> 
                @error('new_profile_image') <span style="color: red;">{{ $message }}</span> @enderror

            </div>

            @if ($profile_image && !$new_profile_image)
                <div class="mb-4">
                     <button type="button" wire:click="removeProfileImage" class="text-red-500 text-sm">Remove Current Image</button>
                </div>
            @endif

        </div>

        <button class="bg-blue-500 hover:bg-blue-700
         text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
         type="submit">Update Profile</button>

        @if (session()->has('message'))
         <div style="color: green;">{{ session('message') }}</div>
        @endif
    </form>

</div>