<div wire:ignore.self class="modal fade" id="packageUpdateModal" data-bs-keyboard="false" data-bs-backdrop="static"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form">
                <div class="modal-header">
                    <h2 class="fw-bolder">Edit package #{{ $ids }}</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary">
                        <a wire:click.prevent="discardConfirm()"> <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div wire:ignore.self class="scroll-y me-n7 pe-7" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-offset="300px">
                        <input type="hidden" wire:model="ids">
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Name</label>
                            <input type="text"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                placeholder="Bronze" wire:model="name" />
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">Max Boot Time</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Time in seconds"></i>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('max_boot_time') is-invalid @enderror"
                                placeholder="1000" wire:model="max_boot_time" />
                            @if (is_numeric($max_boot_time) && $max_boot_time >= 60) <small id="emailHelp" class="form-text text-muted">Time in minutes: {{ number_format($max_boot_time / 60) }}</small>  @endif
                            @error('max_boot_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="fv-row mb-15">
                            <label class="fs-6 fw-bold mb-2 required">Concurrents</label>
                            <input type="text"
                                class="form-control form-control-solid @error('concurrents') is-invalid @enderror"
                                placeholder="1" wire:model="concurrents" />
                            @error('concurrents') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        </div>
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false"
                            aria-controls="kt_customer_view_details">Billing Information
                            <span class="ms-2 rotate-180">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </span>
                        </div>
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="required">Price</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Example: 9.95"></i>
                                </label>
                                <input class="form-control form-control-solid @error('price') is-invalid @enderror"
                                    placeholder="9.95" wire:model="price" />
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            </div>

                            <div class="row g-9 mb-7">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Duration</label>
                                    <input
                                        class="form-control form-control-solid @error('duration') is-invalid @enderror"
                                        placeholder="1" wire:model="duration" />
                                    @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">Recurring</label>
                                    <select
                                        class="form-select form-select-solid @error('recurring') is-invalid @enderror"
                                        aria-label="Select example" wire:model="recurring">
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                    @error('recurring') <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="fv-row mb-7">
                                <div class="d-flex flex-stack">
                                    <div class="me-5">
                                        <label class="fs-6 fw-bold">Allowed to use API?</label>
                                        <div class="fs-7 fw-bold text-muted">Members with this package are allowed to
                                            make</div>
                                    </div>
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" wire:model="api_access" type="checkbox"
                                            value="1" id="kt_modal_add_customer_billing" />

                                        <span class="form-check-label fw-bold text-muted"
                                            for="kt_modal_add_customer_billing">Yes</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button wire:click.prevent="discardConfirm()" class="btn btn-light me-3">Discard</button>
                    <button wire:click.prevent="editPackage()" wire:loading.attr="disabled" type="button"
                        class="btn btn-primary">
                        <span class="indicator-label">Edit package</span>
                        <div wire:loading>
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </div>
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
