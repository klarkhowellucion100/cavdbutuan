{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-guestlayout.layout>
    <!-- Session Status -->

    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-6 col-md-8 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Forgot Password</span>
                        </div>
                        <x-auth-session-status class="mb-4 text-success p-3" :status="session('status')" />
                        <div class="card-body">
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autofocus placeholder="Enter Email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <x-primary-button class="btn m-t-30 mt-3 p-3">
                                    {{ __('Email Password Reset Link') }}
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
