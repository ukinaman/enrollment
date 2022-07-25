@extends('backend.layouts.app')

@section('page_level_css')
    <link href="{{ asset('datatable/css/datatables.css') }}" rel="stylesheet"/>
    <link href="{{ asset('datatable/css/datatables.min.css') }}" rel="stylesheet"/>
    <style>
        .dataTables_filter .form-control{
            font-size: 16px
        }
        .filters,input{
            font-size: 14px
        }
        .filters th:nth-child(1) input{
            display: none
        }
        .filters th:nth-child(4) input{
            display: none
        }
    </style>
@endsection

@section('content')
<div class="page-wrapper">

    <div class="container">
        <x-page-header title="Enrollees" buttonType="assess" buttonTitle="Assess" routeName="assessForm"  />
        <div class="page-body">
            <div class="card p-2">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap datatable display" style="width:100%" id="enrollees_table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enrollees as $enrollment)
                                <tr>
                                    <td class="w-1">
                                        <span class="avatar avatar-sm">{{ $enrollment->student->initials }}</span>
                                    </td>
                                    <td>
                                        {{ $enrollment->student->full_name }}
                                    </td>
                                    <td>
                                        {{ $enrollment->getCourse('title') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('enrollee.show', $enrollment->id) }}" class="btn btn-primary" >
                                            Assess
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_level_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('datatable/js/datatables.js') }}"></script>
    <script src="{{ asset('datatable/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#enrollees_table thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#enrollees_table thead');
            var table = $('#enrollees_table').DataTable({
                responsive: true,
                orderCellsTop: true,
                fixedHeader: false,
                initComplete: function () {
                    var api = this.api();
                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
        });
    </script>
@endsection