<?php

namespace App\Http\Livewire\Packages;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;

class Packages extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'deleteCheckedPackages', 
        'deleteSinglePackage', 
        'updatePackage', 
        'discard'
    ];
    
    public $api_access = 0;

    public $recurring = 'monthly';

    public $checkedPackage = [];

    public $selectAll = false;

    public $search, $name, $max_boot_time, $concurrents, $price, $duration, $ids;
    
    /**
     * Validation rules for input fields
     * Given here.
     *
     * @var array
     */
    protected $rules = [
        'name'          => 'required',
        'max_boot_time' => 'required|numeric',
        'concurrents'   => 'required|numeric',
        'price'         => 'required|numeric',
        'duration'      => 'required',
        'recurring'     => 'required|in:monthly,yearly',
        'api_access'    => 'required',
    ];
    
    /**
     * Send a sweetalert confirmation to the user
     * to determine discarding the form. 
     *
     * @return void
     */
    public function discardConfirm()
    {
        $this->dispatchBrowserEvent('swal:modalConfirm', [
            'message'           => 'Are you sure you would like to cancel?',
            'buttonConfirm'     => 'Ok, got it!',
            'buttonAction'      => 'Yes, cancel it!',
            'buttonClass'       => 'btn fw-bold btn-primary',
            'buttonCancel'      => 'No, return',
            'buttonCancel'      => 'No, return',
            'messageCancel'     => 'Your form has not been cancelled.',
            'messageConfirm'    => 'Your form has been cancelled.',
            'emit'              => 'discard'
        ]);
    }
    
    /**
     * Hide the modals and reset
     * the variables.
     *
     * @return void
     */
    public function discard()
    {
        $this->emit('hideModals');
        $this->resetValidation();
        $this->reset();
    }

    /* CRUD:R Start */
    
    /**
     * Update the search input after updated
     * To prevent searching in page 1 only.
     *
     * @return void
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Render all the packages with pagination
     * and search option.
     *
     * @return void
     */
    public function packages()
    {
        return Package::search('name', $this->search)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    }
    
    /**
     * Pluck the id's from the records
     * when pressing select all checkbox.
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedSelectAll($value)
    {
        if($value)
        {
            $this->checkedPackage = Package::pluck('id');
        }
        else
        {
            $this->checkedPackage = [];
        }
    }

    /* CRUD:R End */

    /* CRUD:D Start */

    public function deletePackage($id)
    {
        $this->dispatchBrowserEvent('swal:modalConfirm', [
            'message'           => 'Are you sure you want to delete this package?',
            'buttonConfirm'     => 'Ok, got it!',
            'buttonAction'      => 'Yes, delete!',
            'buttonClass'       => 'btn fw-bold btn-danger',
            'buttonCancel'      => 'No, cancel',
            'buttonCancel'      => 'No, cancel',
            'messageCancel'     => 'This package has not been deleted.',
            'messageConfirm'    => 'You have deleted this package!',
            'emit'              => 'deleteSinglePackage',
            'parameters'        => $id
        ]);
    }
    
    /**
     * Send a sweetalert confirmation to the user
     * to determine deletion. 
     *
     * @return void
     */
    public function deletePackages()
    {
        $this->dispatchBrowserEvent('swal:modalConfirm', [
            'message'           => 'Are you sure you want to delete selected packages?',
            'buttonConfirm'     => 'Ok, got it!',
            'buttonAction'      => 'Yes, delete!',
            'buttonClass'       => 'btn fw-bold btn-danger',
            'buttonCancel'      => 'No, cancel',
            'buttonCancel'      => 'No, cancel',
            'messageCancel'     => 'Selected packages was not deleted.',
            'messageConfirm'    => 'You have deleted all selected packages!',
            'emit'              => 'deleteCheckedPackages',
            'parameters'        => $this->checkedPackage
        ]);
    }
    
    /**
     * Delete a single record
     * from the database.
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteSinglePackage($id)
    {
        Package::where('id', $id)->delete();
    }
    
    /**
     * Delete all the selected records
     * from the database.
     *
     * @param  mixed $ids
     * @return void
     */
    public function deleteCheckedPackages($ids) 
    {
        Package::whereKey($ids)->delete();
        $this->checkedPackage = [];
        $this->selectAll = false;
    }

    /* CRUD:D End */

    /* CRUD:C Start */
    
    /**
     * Store the package inside
     * the database.
     *
     * @return void
     */
    public function storePackageData()
    {
        $this->validate();

        Package::create([
            'name'          => $this->name,
            'max_boot_time' => $this->max_boot_time,
            'concurrents'   => $this->concurrents,
            'price'         => $this->price,
            'duration'      => $this->duration,
            'recurring'     => $this->recurring,
            'api_access'    => $this->api_access,
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'message'       => 'Package has been successfully created!',
            'buttonConfirm' => 'Continue'
        ]);

        $this->emit('packageStored');
        $this->reset();
    }

    /* CRUD:C End */

    /* CRUD:U Start */

    /**
     * Give the variables the given fields
     * from the record.
     *
     * @param  mixed $id
     * @return void
     */
    public function editPackageData($id)
    {
        $package = Package::where('id', $id)->first();
        $this->ids              = $package->id;
        $this->name             = $package->name;
        $this->max_boot_time    = $package->max_boot_time;
        $this->concurrents      = $package->concurrents;
        $this->price            = $package->price;
        $this->duration         = $package->duration;
        $this->recurring        = $package->recurring;
        $this->api_access       = $package->api_access;

    }
    
    /**
     * Send a sweetalert confirmation to the user
     * to determine updating. 
     *
     * @return void
     */
    public function editPackage()
    {
        $this->validate();

        $this->dispatchBrowserEvent('swal:modalConfirm', [
            'message'           => 'Are you sure you want to edit this package?',
            'buttonConfirm'     => 'Ok, got it!',
            'buttonAction'      => 'Yes, edit!',
            'buttonClass'       => 'btn fw-bold btn-primary',
            'buttonCancel'      => 'No, cancel',
            'buttonCancel'      => 'No, cancel',
            'messageCancel'     => 'Selected packages was not eddited.',
            'messageConfirm'    => 'You have eddited this package!',
            'emit'              => 'updatePackage',
            'parameters'        => $this->ids
        ]);
    }
    
    /**
     * Update the record with the
     * new given values.
     *
     * @return void
     */
    public function updatePackage()
    {
        if($this->ids)
        {
            $package = Package::find($this->ids);

            $package->update([
                'name'          => $this->name,
                'max_boot_time' => $this->max_boot_time,
                'concurrents'   => $this->concurrents,
                'price'         => $this->price,
                'duration'      => $this->duration,
                'recurring'     => $this->recurring,
                'api_access'    => $this->api_access,
            ]);

            $this->emit('packageUpdated');
            $this->reset();
        }
    }

    /* CRUD:U End */

    
    /**
     * Default livewire render function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.packages.packages', [
            $this->dispatchBrowserEvent('contentChanged'),
            'packages' => $this->packages(),
        ]);
    }
}
