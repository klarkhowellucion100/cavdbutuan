<x-guestlayout.layout>
    <!-- Session Status -->
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-6 col-md-8 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Register</span>
                        </div>
                        <x-auth-session-status class="mb-4 text-success p-3" :status="session('status')" />
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name"
                                            placeholder="Enter Full Name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="position" :value="__('Position')" />
                                        <x-text-input id="position" class="form-control" type="text" name="position"
                                            :value="old('position')" required autofocus autocomplete="position"
                                            placeholder="Enter Position" />
                                        <x-input-error :messages="$errors->get('position')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autocomplete="username"
                                            placeholder="Enter Email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <div class="input-group show-hide-password">
                                            <x-text-input id="password" class="form-control" type="password"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Enter Password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="icon-eye-off"
                                                        aria-hidden="true" style="cursor: pointer;"></i></span>
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <div class="input-group show-hide-password">
                                            <x-text-input id="password_confirmation" class="form-control"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" placeholder="Confirm Password" />

                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="icon-eye-off"
                                                        aria-hidden="true" style="cursor: pointer;"></i></span>
                                            </div>
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <div class="g-recaptcha" data-sitekey="{{ config('app.captcha.captcha_site_key') }}"
                                        data-callback="onCaptchaSuccess">
                                    </div>
                                </div>

                                <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        href="{{ route('login') }}" style="font-size: 13px;">
                                        {{ __('Already registered?') }}
                                    </a>
                                </div>
                                <x-primary-button class="btn m-t-30 mt-3 p-3">
                                    {{ __('Register') }}
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
