<x-guest-layout>
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url(assets/media/illustrations/sigma-1/14-dark.png">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{ URL::asset('revo/media/logos/logo-2.svg') }}" class="h-40px" />
            </a>
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form method="POST" class="form w-100" id="kt_password_reset_form"
                    action="{{ route('password.email') }}">
                    @csrf
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Forgot Password ?</h1>
                        <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
                        <input
                            class="form-control form-control-solid @error('email') is-invalid @enderror @if (session('status')) is-valid @endif"
                            type="email" value="{{ old('email') }}" name="email" autocomplete="off" required />
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if (session('status'))
                            <div class="valid-feedback">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" id="kt_password_reset_submit"
                            class="btn btn-lg btn-primary fw-bolder me-4">
                            <span class="indicator-label">Submit</span>
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
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
