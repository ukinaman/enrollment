<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class StudentsTable extends PowerGridComponent
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
        $this->showCheckBox()
            ->showPerPage()
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
    * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\Student>|null
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
        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Student Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */

    public function actions(): array
    {
      return [
        Button::add('assess')
            ->caption('Enroll')
            ->class('btn btn-primary assess-btn')
            ->route('accounting.dashboard.existing.enroll', ['id' => 'id'])->target('_self')
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
     * PowerGrid Student Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($student) => $student->id === 1)
                ->hide(),
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

     /**
     * PowerGrid Student Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Student::query()->findOrFail($data['id'])
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
