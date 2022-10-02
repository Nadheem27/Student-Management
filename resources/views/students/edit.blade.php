@extends('layouts.index')

@section('content')
    @component('breadcrumb.breadcrumb', ['page_title' => 'student-add'])
    @endcomponent

    <div class="row mb-4 p-3">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-body">
                    <form method="POST" action="{{ route('student.student-update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row  mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">Name</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="hidden" value="{{ $student->id }}" name="id" />
                                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $student->name }}" required>
                                        @error('name')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 form-group">
                                    <label class="col-md-4 mt-1 text-left">
                                        <span class="text-14">Age</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="age" value="{{ old('age') ?? $student->age }}" required>
                                        @error('age')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 form-group">
                                    <label class="col-form-label col-md-4">Gender</label>
                                    <div class="col-md-8">
                                        @php $gender = is_null(old('gender')) ? $student->gender : old('gender') @endphp
                                        <label style="margin-right: 1rem"><input type="radio" name="gender" value="1" {{ $gender == '1' ? 'checked' : '' }}>Male</label>
                                        <label><input type="radio" name="gender" value="0" required {{ $gender == '0' ? 'checked' : '' }}>Female</label>
                                        @error('gender')
                                            <span class="text-danger small">
                                                <li>{{ $message }}</li>
                                            </span>
                                        @enderror
                                    </div>
                                </div>   
                                <div class="row mb-4 form-group">
                                    <label class="col-form-label col-md-4">Teacher</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="teacher" required>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ (is_null(old('teacher')) ? $student->teacher_id : old('teacher')) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher')
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
