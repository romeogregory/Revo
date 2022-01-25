<x-guest-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-15">
            <a href="#" class="mb-10 pt-lg-10">
                <img alt="Logo" src="{{ URL::asset('revo/media/logos/logo-2.svg') }}" class="h-40px" />
            </a>
            <div class="pt-lg-10 mb-10">
                <h1 class="fw-bolder fs-2qx text-gray-800 mb-7">Verify Your Email</h1>
                <div class="fs-3 fw-bold text-muted mb-10">We have sent an email to
                    <a href="#" class="link-primary fw-bolder">{{ Auth::user()->email }}</a>
                    <br />see your email for further instructions.
                </div>
                <span class="fw-bold text-gray-700">Did’t receive an email? Make sure to check your spam inbox.</span>
                <form method="POST" class="form w-100" id="kt_new_password_form"
                    action="{{ route('verification.send') }}">
                    @csrf
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-sm btn-primary fw-bolder">Resend Email</button>
                    </div>
                    @if (session('status') == 'verification-link-sent')
                        <div class="valid-feedback d-block">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="d-flex flex-center flex-column-auto p-10">
            <div class="d-flex align-items-center fw-bold fs-6">
                <form method="POST" class="form w-100" id="kt_new_password_form" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn text-muted text-hover-primary px-2">Logout</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
