<x-app-layout>
    @push('styles')
    @endpush

    <x-slot name="title">
        Packages
    </x-slot>

    <livewire:packages.packages />



    @push('scripts')
        <script>
            window.addEventListener('contentChanged', event => {

                // Enable dropdown
                KTMenu.createInstances();

                $('.recurring').select2();

                // Enable tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })

            });

            window.livewire.on('hideModals', () => {
                $('#packageUpdateModal').modal('hide');
                $('#packageStoreModal').modal('hide');
            });

            window.livewire.on('packageStored', () => {
                $('#packageStoreModal').modal('hide');
            });

            window.livewire.on('packageUpdated', () => {
                $('#packageUpdateModal').modal('hide');
            });

            window.addEventListener('swal:modal', event => {
                Swal.fire({
                    text: event.detail.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: event.detail.buttonConfirm,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            });

            window.addEventListener('swal:modalConfirm', event => {
                Swal.fire({
                    text: event.detail.message,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: event.detail.buttonAction,
                    cancelButtonText: event.detail.buttonCancel,
                    customClass: {
                        confirmButton: event.detail.buttonClass,
                        cancelButton: "btn fw-bold btn-secondary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire({
                            text: event.detail.messageConfirm,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: event.detail.buttonConfirm,
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function() {
                            if (event.detail.parameters) {
                                window.livewire.emit(event.detail.emit, event.detail.parameters);
                            } else {
                                window.livewire.emit(event.detail.emit);
                            }

                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: event.detail.messageCancel,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: event.detail.buttonConfirm,
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
