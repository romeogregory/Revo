<x-guest-layout>
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url(assets/media/illustrations/sigma-1/14-dark.png">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{ URL::asset('revo/media/logos/logo-2.svg') }}" class="h-40px" />
            </a>
            <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form method="POST" class="form w-100" id="kt_new_password_form"
                    action="{{ route('password.update') }}">
                    @csrf
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Setup New Password</h1>
                        <div class="text-gray-400 fw-bold fs-4">Already have reset your password ?
                            <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6">Email</label>
                        <input
                            class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                            type="email" name="email" value="{{ old('email', $request->email) }}" required readonly />
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <div class="mb-1">
                            <label class="form-label fw-bolder text-dark fs-6">Password</label>
                            <div class="position-relative mb-3">
                                <input
                                    class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                    type="password" name="password" autocomplete="off" />
                                <span
                                    class="btn btn-sm btn-icon position-absolute translate-middle top-0 mt-7 end-0 me-n17"
                                    data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                            symbols.</div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                        <input class="form-control form-control-lg form-control-solid" type="password"
                            name="password_confirmation" autocomplete="off" />
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                            <span class="indicator-label">Submit</span>
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
