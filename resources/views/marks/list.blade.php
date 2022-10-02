@extends('layouts.index')

@section('top-script')
    <script>
        window.DATATABLE = {
            ajax_url: "{{ route('mark.mark-list') }}",
            delete_url : "{{ route('mark.mark-delete') }}"
        };
    </script>
@endsection

@section('content')
    @component('breadcrumb.breadcrumb', ['page_title' => 'mark-list'])
    @endcomponent

    <div class="row mb-4 p-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped" id="marks_table">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Maths</th>
                                <th>Science</th>
                                <th>History</th>
                                <th>Term</th>
                                <th>Total Marks</th>
                                <th>Created On</th>
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
