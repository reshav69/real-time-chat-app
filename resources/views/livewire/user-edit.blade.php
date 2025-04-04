
<div class="w-full max-w-xs">

    <h2>Edit Profile</h2>

    @if (session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="updateProfile" class="bg-white rounded px-8 pt-6 pb-8 mb-4">

        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">
                Username:</label>

            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
             focus:outline-none focus:shadow-outline"
             id="username" type="text" placeholder="Username" wire:model="username">
             @error('username') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" wire:model="email">
        @error('email') <span style="color: red;">{{ $message }}</span> @enderror

        <!-- Bio -->
        <label for="bio">Bio:</label>
        <textarea id="bio" wire:model="bio"></textarea>
        @error('bio') <span style="color: red;">{{ $message }}</span> @enderror

        <!-- Profile Image -->
        <label for="profile_image">Current Profile Image:</label>
        @if ($profile_image)
            <img src="{{ asset('storage/' . $profile_image) }}" width="100">
        @else
            <p>No profile image set.</p>
        @endif

        <!-- Upload New Profile Image -->
        <label for="new_profile_image">Upload New Profile Image:</label>
        <input type="file" wire:model="new_profile_image">
        @error('new_profile_image') <span style="color: red;">{{ $message }}</span> @enderror

        <!-- Password -->
        <label for="password">New Password (Leave blank if unchanged):</label>
        <input type="password" id="password" wire:model="password">

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" wire:model="password_confirmation">
        @error('password') <span style="color: red;">{{ $message }}</span> @enderror

        <button type="submit">Update Profile</button>
    </form>
</div>
{{-- <div class="w-full max-w-xs">


    <form class="bg-white rounded px-8 pt-6 pb-8 mb-4">

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
        <p class="text-red-500 text-xs italic">Please choose a password.</p>
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          Sign In
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          Forgot Password?
        </a>
      </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
      &copy;2020 Acme Corp. All rights reserved.
    </p>
  </div> --}}