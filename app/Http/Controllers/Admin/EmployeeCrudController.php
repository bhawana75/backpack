<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use App\Models\Employee;
use App\Models\Province;
use App\Models\Locallevel;
use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings('employee', 'employees');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'employeename',
            'type' => 'text',
            'label' => "Employee Name"
          ]);
    
        $this->crud->addColumn([
            'name' => 'province_id',
            'type' => 'select',
            'label' => "Province Name",
            'entity'    => 'province', 
            'attribute' => 'provincename',
            'model' => Province::class
          ]);
    
          $this->crud->addColumn([
            'name' => 'district_id',
            'type' => 'select',
            'label' => "District Name",
            'entity'    => 'district', 
            'attribute' => 'districtname',
            'model' => District::class
          ]);

          $this->crud->addColumn([
            'name' => 'locallevel_id',
            'type' => 'select',
            'label' => "Locallevel Name",
            'entity'    => 'locallevel', 
            'attribute' => 'locallevelname',
            'model' => Locallevel::class
          ]);

         
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeRequest::class);

        $this->crud->addField([
            'name' => 'employeename',
            'type' => 'text',
            'label' => "Employee Name"
          ]);

        $this->crud->addField([
          'name' => 'province_id',
          'type' => 'select2',
          'label' => "Province Name",
          'entity'  => 'province', 
          'attribute' => 'provincename',
          'model' => Province::class
        ]); 

        $this->crud->addField([
          'name' => 'district_id',
          'type' => 'select2_from_ajax',
          'label' => "District Name",
          'entity'  => 'district', 
          'attribute' => 'districtname',
          'placeholder' => "Select a District",
          'minimum_input_length' => 0, 
          'dependencies' => ['province_id'],
          'data_source' => url("/api/getDistrict/province_id"),
          'include_all_form_fields'=>true,
          'model' => District::class
        ]);

        $this->crud->addField([
            'name' => 'locallevel_id',
            'type' => 'select2_from_ajax',
            'label' => "Locallevel Name",
            'entity'  => 'locallevel', 
            'attribute' => 'locallevelname',
            'placeholder' => "Select a Locallevel",
            'minimum_input_length' => 0, 
            'dependencies' => ['district_id'],
            'data_source' => url("/api/getLocallevel/district_id"),
            'include_all_form_fields'=>true,
            'model' => Locallevel::class
          ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
