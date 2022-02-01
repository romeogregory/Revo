<x-app-layout>
    <x-slot name="title">
        Shop
    </x-slot>

    <div class="card" id="kt_pricing">
        <div class="card-body p-lg-17">
            <div class="d-flex flex-column">
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bolder mb-5">Choose Your Plan</h1>
                    <div class="text-gray-400 fw-bold fs-5">If you need more info about our pricing, please check
                        <a href="#" class="link-primary fw-bolder">Pricing Guidelines</a>.
                    </div>
                </div>
                <div class="row g-10">
                    @forelse ($packages as $package)
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <div
                                    class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                    <div class="mb-7 text-center">
                                        <h1 class="text-dark mb-5 fw-boldest">{{ $package->name }}</h1>
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bolder text-primary" data-kt-plan-price-month="39"
                                                data-kt-plan-price-annual="399">{{ round($package->price) }}</span>
                                            <span class="fs-7 fw-bold opacity-50">/
                                                <span data-kt-element="period">Mon</span></span>
                                        </div>
                                    </div>
                                    <div class="w-100 mb-10">
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Boot time:</span>
                                            {{ $package->max_boot_time }} seconds
                                        </div>
                                        <div class="d-flex align-items-center mb-5">
                                            <span
                                                class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Concurrents:</span>
                                            {{ $package->concurrents }}
                                        </div>
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Tools:</span>
                                            <span class="svg-icon svg-icon-1 svg-icon-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                        fill="black" />
                                                    <path
                                                        d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            @if ($package->api_access == true)
                                                <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Api
                                                    Access:</span>

                                                <span class="svg-icon svg-icon-1 svg-icon-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                            fill="black" />
                                                        <path
                                                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="fw-bold fs-6 text-gray-400 flex-grow-1">Api Access</span>
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                            fill="black" />
                                                        <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                            transform="rotate(-45 7 15.3137)" fill="black" />
                                                        <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                            transform="rotate(45 8.41422 7)" fill="black" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-primary">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
