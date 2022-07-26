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
      $enrollment = Enrollment::where('assessed','=',1)->with('student','course','year','sem','mop');
      return $enrollment;
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
        return [
          'student' => [
            'firstname',
            'middlename',
            'lastname'
          ]
        ];
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
            ->addColumn('student', function (Enrollment $model) {
              $color = '';
              if($model->student->gender === 'Female'){
                $color = "bg-purple-lt";
              }else{
                $color = "bg-blue-lt";
              }
              return '<span class="avatar avatar-sm '.$color.'">'.$model->student->initials.'</span>'; 
            })
            ->addColumn('name', function(Enrollment $model){
              return $model->student->full_name;
            })
            ->addColumn('course', function(Enrollment $model){
              return $model->course->title;
            })
            ->addColumn('year', function(Enrollment $model){
              return $model->year->title;
            })
            ->addColumn('sem', function(Enrollment $model){
              return $model->sem->title;
            })
            ->addColumn('mode_of_payment', function(Enrollment $model){
              return $model->mop->mode;
            });
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
                ->title('Student')
                ->field('student'),
            Column::add()
                ->title('Name')
                ->field('name', 'student_id')
                ->searchable()
                ->sortable(),
            Column::add()
                ->title('Course')
                ->field('course', 'course_id')
                ->searchable()
                ->makeInputSelect(Course::all(), 'title', 'course_id', ['live-search' => true]),
            Column::add()
              ->title('Year')
              ->field('year', 'year_id')
              ->searchable()
              ->makeInputSelect(Year::all(), 'title', 'year_id', ['live-search' => true]),
            Column::add()
              ->title('Semester')
              ->field('sem', 'sem_id')
              ->searchable()
              ->makeInputSelect(Semester::all(), 'title', 'sem_id', ['live-search' => true]),
            Column::add()
              ->title('Mode of Payment')
              ->field('mode_of_payment', 'mop_id')
              ->searchable()
              ->makeInputSelect(ModeOfPayment::all(), 'mode', 'mop_id', ['live-search' => true])
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
            ->route('enrollee.show', ['id' => 'id'])
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
