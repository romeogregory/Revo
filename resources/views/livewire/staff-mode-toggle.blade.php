<div>
    @if (!empty($role))
        <div class="separator my-2"></div>
        <div class="menu-item px-5">
            <div class="menu-content px-5">
                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success">
                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" wire:model="mode" />
                    <span class="pulse-ring ms-n1"></span>
                    <span class="form-check-label text-gray-600 fs-7">
                        {{ $role }} Mode
                    </span>
                </label>
            </div>
        </div>
    @endif
</div>
