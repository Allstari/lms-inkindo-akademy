@section('title', 'Daftar Akun')

<x-guest-layout>
    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <x-alert.error :errors="$errors->all()" />
            @endif

            <div class="flex items-center justify-center min-h-screen">
                <form class="w-full max-w-md" method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

                    <!-- First Name dan Last Name -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input.input-label for="first_name" :value="__('Nama Depan')" />
                            <x-input.text-input id="first_name" class="mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name')" required autofocus autocomplete="first_name" />
                            <x-input.input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input.input-label for="last_name" :value="__('Nama Belakang')" />
                            <x-input.text-input id="last_name" class="mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name')" required autofocus autocomplete="last_name" />
                            <x-input.input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Phone Number dan Gender -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input.input-label for="phone" :value="__('Nomor Telepon')" />
                            <x-input.text-input id="phone" class="mt-1 w-full" type="tel" name="phone"
                                :value="old('phone')" required autofocus autocomplete="phone" pattern="^\d{9,13}$" />
                            <x-input.input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                        <div>
                            <x-input.input-label for="gender" :value="__('Jenis Kelamin')" />
                            <x-input.select-input id="gender" class="mt-1 w-full" name="gender" required autofocus
                                autocomplete="gender">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki - Laki" {{ old('gender') == 'Laki - Laki' ? ' selected' : ' ' }}>
                                    Laki - Laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? ' selected' : ' ' }}>
                                    Perempuan</option>
                            </x-input.select-input>
                            <x-input.input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Email dan Password -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input.input-label for="email" :value="__('Email')" />
                            <x-input.text-input id="email" class="mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="email" />
                            <x-input.input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input.input-label for="password" :value="__('Password')" />
                            <x-input.text-input id="password" class="mt-1 w-full" type="password" name="password"
                                :value="old('password')" required autofocus autocomplete="password" />
                            <x-input.input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <x-input.input-label for="password_confirmation" :value="__('Password Konfirmasi')" />
                        <x-input.text-input id="password_confirmation" class="mt-1 w-full" type="password"
                            name="password_confirmation" :value="old('password_confirmation')" required autofocus
                            autocomplete="password_confirmation" />
                        <x-input.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Tombol Register -->
                    <button type="submit" class="w-full btn btn-info">
                        Register
                    </button>

                    <!-- Link Login -->
                    <p class="text-center text-sm mt-4">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-info hover:underline">Log in</a>
                    </p>
                </form>

                </d>
            </div>
        </div>
        <x-slot name="script">
            <script>
                // JavaScript untuk memastikan input telepon diawali dengan 62
                document.addEventListener('DOMContentLoaded', function() {
                    const phoneInput = document.getElementById('phone');

                    phoneInput.addEventListener('input', function() {
                        let phoneValue = phoneInput.value;

                        // Jika nomor diawali dengan 08 atau selain 62, ubah menjadi 62
                        if (phoneValue.startsWith('08')) {
                            phoneInput.value = '62' + phoneValue.substring(2);
                        } else if (!phoneValue.startsWith('62')) {
                            phoneInput.value = '62' + phoneValue.replace(/^0/, ''); // Ganti 0 dengan 62
                        }
                    });
                });
            </script>
        </x-slot>
</x-guest-layout>
