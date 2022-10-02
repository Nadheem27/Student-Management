@extends('layouts.index')

@section('content')
    @component('breadcrumb.breadcrumb', ['page_title' => 'mark-add'])
    @endcomponent

    <div class="row mb-4 p-3">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-body">
                    <form method="POST" action="{{ route('mark.mark-update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row  mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">Student</span>
                                    </label>
                                    <input type="hidden" value="{{ $mark->id }}" name="id">
                                    <div class="col-md-8">
                                        <select class="form-control" name="student" required>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}" {{ (is_null(old('student')) ? $mark->student_id : old('student')) == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('student')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row  mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">Term</span>
                                    </label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="term" required>
                                            @foreach ($terms as $term)
                                                <option value="{{ $term->id }}" {{ (is_null(old('term')) ? $mark->term_id : old('term')) == $term->id ? 'selected' : '' }}>{{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('term')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">Maths Mark</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="maths_mark" value="{{ old('maths_mark') ?? $mark->maths }}" required>
                                        @error('maths_mark')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">Science Mark</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="science_mark" value="{{ old('science_mark') ?? $mark->science }}" required>
                                        @error('science_mark')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">History Mark</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="history_mark" value="{{ old('history_mark') ?? $mark->history }}" required>
                                        @error('history_mark')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
