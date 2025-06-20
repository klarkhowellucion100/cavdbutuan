<x-guestlayout.layout>
    <!-- Session Status -->

    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-6 col-md-8 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Login</span>
                        </div>
                        <x-auth-session-status class="mb-4 text-success p-3" :status="session('status')" />

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autofocus autocomplete="username"
                                            placeholder="Enter Email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <div class="input-group show-hide-password">

                                            <x-text-input id="password" class="form-control" type="password"
                                                placeholder="Enter password" name="password" required
                                                autocomplete="current-password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="icon-eye-off"
                                                        aria-hidden="true" style="cursor: pointer;"></i></span>
                                            </div>

                                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            name="remember">
                                        <span style="font-size: 13px;"
                                            class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}" style="font-size: 13px;">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                                <x-primary-button class="btn m-t-30 mt-3 p-3">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </section>
</x-guestlayout.layout>
