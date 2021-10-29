<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use App\Models\Province;
use App\Models\Locallevel;
use App\Http\Requests\LocallevelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LocallevelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocallevelCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Locallevel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/locallevel');
        CRUD::setEntityNameStrings('locallevel', 'locallevels');
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
        'name' => 'district_id',
        'type' => 'select',
        'label' => "District Name",
        'entity'    => 'district', 
        'attribute' => 'districtname',
        'model' => District::class
      ]);
      $this->crud->addColumn([
        'name' => 'locallevelname',
        'type' => 'text',
        'label' => "Locallevel Name"
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
        CRUD::setValidation(LocallevelRequest::class);
          
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
          'type' => 'select2',
          'label' => "District Name",
          'entity'  => 'district', 
          'attribute' => 'districtname',
          'model' => District::class
        ]);
          $this->crud->addField([
            'name' => 'province_id',
            'type' => 'select2',
            'label' => "Province Name"
          ]);

          $this->crud->addField([
            'name' => 'district_id',
            'type' => 'select2',
            'label' => "District Name"
          ]);

          $this->crud->addField([
            'name' => 'locallevelname',
            'type' => 'text',
            'label' => "Locallevel Name"
          ]);

        CRUD::field('created_at');
        CRUD::field('updated_at');

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
