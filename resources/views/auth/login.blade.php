<x-guest-layout>
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{ URL::asset('revo/media/logos/logo-2.svg') }}" class="h-40px" />
            </a>
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form method="POST" class="form w-100" id="kt_sign_in_form" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Sign In to {{ config('app.name') }}</h1>
                        <div class="text-gray-400 fw-bold fs-4">New Here?
                            <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a>
                        </div>
                    </div>
                    <div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
                        <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                        <input
                            class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror @if (session('status')) is-valid @endif"
                            type="text" name="email" autocomplete="off" value="{{ old('email') }}" required
                            autofocus />
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if (session('status'))
                            <div class="valid-feedback">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot
                                Password ?</a>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                            autocomplete="off" required />
                    </div>
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="remember" />
                            <span class="form-check-label fw-bold text-gray-700 fs-6">Remember Me</span>
                        </label>
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <span class="indicator-label">Login</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex flex-center flex-column-auto p-10">
            <div class="d-flex align-items-center fw-bold fs-6">
                <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
        </div>
    </div>
</x-guest-layout>
