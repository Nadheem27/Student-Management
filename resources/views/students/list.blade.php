@extends('layouts.index')

@section('top-script')
    <script>
        window.DATATABLE = {
            ajax_url: "{{ route('student.student-list') }}",
            delete_url : "{{ route('student.student-delete') }}"
        };
    </script>
@endsection

@section('content')
    @component('breadcrumb.breadcrumb', ['page_title' => 'student-list'])
    @endcomponent

    <div class="row mb-4 p-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped" id="students_table">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Reporting Teacher</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('/js/datatable.js') }}"></script>    
@endsection
