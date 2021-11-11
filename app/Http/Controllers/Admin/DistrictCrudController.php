<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use App\Models\Province;
use App\Http\Requests\DistrictRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DistrictCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DistrictCrudController extends CrudController
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
        CRUD::setModel(\App\Models\District::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/district');
        CRUD::setEntityNameStrings('district', 'districts');
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
            'name' => 'province_id',
            'type' => 'select',
            'label' => "Province Name",
            'entity'    => 'province', 
            'attribute' => 'provincename',
            'model' => Province::class
          ]);

        $this->crud->addColumn([
            'name' => 'districtname',
            'type' => 'text',
            'label' => "District Name"
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
        CRUD::setValidation(DistrictRequest::class);
        $this->crud->addField([
            'name' => 'province_id',
            'type' => 'select2',
            'label' => "Province Name",
            'entity'  => 'province', 
            'attribute' => 'provincename',
            'model' => Province::class
          ]);
          
        $this->crud->addField([
            'name' => 'districtname',
            'type' => 'text',
            'label' => "District Name",
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
