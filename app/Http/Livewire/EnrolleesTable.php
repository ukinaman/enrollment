<?php

namespace App\Http\Livewire;

use App\Models\Year;
use App\Models\Course;
use App\Models\Student;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\ModeOfPayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\Traits\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class EnrolleesTable extends PowerGridComponent
{
    use ActionButton;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): void
    {
        $this->showPerPage()
        ->showSearchInput();
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    
    /**
    * PowerGrid datasource.
    *
    * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\Enrollment>|null
    */
    public function datasource(): ?Builder
    {
        return Student::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('firstname')
            ->addColumn('middlename')
            ->addColumn('lastname')
            ->addColumn('birthplace')
            ->addColumn('age')
            ->addColumn('birthday_formatted', function(Student $model) { 
                return Carbon::parse($model->birthday)->format('d/m/Y');
            })
            ->addColumn('gender');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('FIRSTNAME')
                ->field('firstname')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('MIDDLENAME')
                ->field('middlename')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('LASTNAME')
                ->field('lastname')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('BIRTHPLACE')
                ->field('birthplace')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('AGE')
                ->field('age')
                ->makeInputRange(),

            Column::add()
                ->title('BIRTHDAY')
                ->field('birthday_formatted', 'birthday')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('birthday'),

            Column::add()
                ->title('GENDER')
                ->field('gender')
                ->sortable()
                ->searchable()
                ->makeInputText(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Enrollment Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */

  
    public function actions(): array
    {
      return [
        Button::add('assess')
            ->caption('Assess')
            ->class('btn btn-primary assess-btn')
            ->route('enrollee.select', ['id' => 'id'])->target('_self')
      ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Enrollment Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    // public function actionRules(): array
    // {
    //    return [
           
    //        //Hide button edit for ID 1
    //         Rule::button('assess')
    //           ->when(fn($enrollment) => $enrollment->assessed == true )
    //           >redirect(fn($enrollment) => 'https://www.google.com/search?q='.$dish->name, '_blank'),
    //     ];
    // }


    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

     /**
     * PowerGrid Enrollment Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Enrollment::query()
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */
}
