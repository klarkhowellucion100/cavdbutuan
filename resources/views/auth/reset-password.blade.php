<x-guestlayout.layout>
    <!-- Session Status -->
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-6 col-md-8 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Password Reset</span>
                        </div>
                        <x-auth-session-status class="mb-4 text-success p-3" :status="session('status')" />
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <div class="input-group show-hide-password">

                                            <x-text-input id="password" class="form-control" type="password"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Enter New Password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="icon-eye-off"
                                                        aria-hidden="true" style="cursor: pointer;"></i></span>
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
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


                        </div>
                        <x-primary-button class="btn m-t-30 mt-3 p-3">
                            {{ __('Reset Password') }}
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
