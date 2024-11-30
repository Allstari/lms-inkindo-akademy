@section('title', 'Masuk')

<x-guest-layout>
    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <x-alert.error :errors="$errors->all()" />
            @endif

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="flex items-center justify-center min-h-screen">
                <x-form class="w-full max-w-md" action="{{ route('login') }}">
                    @csrf
                    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <x-input.input-label for="email" :value="__('Email')" />
                            <x-input.text-input id="email" class="mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="email" />
                            <x-input.input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="col-span-2">
                            <x-input.input-label for="password" :value="__('Password')" />
                            <x-input.text-input id="password" class="mt-1 w-full" type="password" name="password"
                                :value="old('password')" required autofocus autocomplete="password" />
                            <x-input.input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-4">
                        <x-input.input-label for="remember" class="label cursor-pointer mr-3">
                            <x-input.checkbox name="remember" id="remember" :title="__('Remember Me')" />
                        </x-input.input-label>
                    </div>

                    <button type="submit" class="w-full btn btn-info">
                        Login
                    </button>

                    <p class="text-center text-sm mt-4">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-info hover:underline">Register</a>
                    </p>
                </x-form>
            </div>
        </div>
    </div>
</x-guest-layout>
