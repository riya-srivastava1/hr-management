<x-guest-layout>
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        <div class="form-group row mb-3">
            <label class="col-lg-4 col-form-label form-label">User</label>
            <div class="col-lg-14 ">
                <select name="role" class="form-select pt-3">
                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}> <b>Employee</b> </option>
                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}> <b>Team Leader</b> </option>
                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}> <b>HR</b> </option>
                </select>
            </div>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">

            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 float-end">Back</a>

            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
