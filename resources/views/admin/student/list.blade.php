@extends('layouts.app')

@section('title', 'SMS-Student List')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="col-md-12">

            @include('_message')

            {{-- HEADER --}}
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Student List Total : {{ $students->total() }} Students</h1>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>




            <!-- Search Form -->
            <div class="card card-primary">
                <!-- form start -->
                <form action="" method="get">
                    <div class="card-header">
                        <h3 class="card-title">Search Student</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter Student's First Name"
                                    value="{{ old('name', Request::get('name')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    placeholder="Enter Student's Last Name"
                                    value="{{ old('last_name', Request::get('last_name')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email"
                                    placeholder="Enter Student's Email" value="{{ old('email', Request::get('email')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Admission Number</label>
                                <input type="text" class="form-control" name="admission_number"
                                    placeholder="Enter Student's Admission Number"
                                    value="{{ old('admission_number', Request::get('admission_number')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Roll Number</label>
                                <input type="text" class="form-control" name="roll_number"
                                    placeholder="Enter Student's Roll Number"
                                    value="{{ old('roll_number', Request::get('roll_number')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Class</label>
                                <input type="text" class="form-control" name="class_name"
                                    placeholder="Enter Student's Class Name"
                                    value="{{ old('class_name', Request::get('class_name')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="" selected>All</option>
                                    <option value='male' {{ Request::get('gender') == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value='female' {{ Request::get('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Caste</label>
                                <input type="text" class="form-control" name="caste"
                                    placeholder="Enter Student's Caste" value="{{ old('caste', Request::get('caste')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Religion</label>
                                <input type="text" class="form-control" name="religion"
                                    placeholder="Enter Student's Religion"
                                    value="{{ old('religion', Request::get('religion')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number"
                                    placeholder="Enter Student's Mobile Number"
                                    value="{{ old('mobile_number', Request::get('mobile_number')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Blood Group</label>
                                <input type="text" class="form-control" name="blood_group"
                                    placeholder="Enter Student's Blood Group"
                                    value="{{ old('blood_group', Request::get('blood_group')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="" selected>All</option>
                                    <option value='1.0' {{ Request::get('status') == '1.0' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value='0.0' {{ Request::get('status') == '0.0' ? 'selected' : '' }}>InActive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Created At</label>
                                <input type="date" class="form-control" name="date"
                                    value="{{ Request::get('date') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Admission Date</label>
                                <input type="date" class="form-control" name="admission_date"
                                    value="{{ Request::get('admission_date') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Birth Date</label>
                                <input type="date" class="form-control" name="date_of_birth"
                                    value="{{ Request::get('date_of_birth') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                <a href="{{ url('admin/student/list') }}" class="btn btn-success"
                                    style="margin-top: 30px">Clear</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->





            {{-- Table Card --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student List</h3>
                </div>
                <!-- /.card-header -->
                <div style="overflow: auto;" class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Profile Image</th>
                                <th>Parent Name</th>
                                <th>Class Name</th>
                                <th>Email</th>
                                <th>Admission Number</th>
                                <th>Roll Number</th>
                                <th>Admission Date</th>
                                <th>Status</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Caste</th>
                                <th>Blood Group</th>
                                <th>Religion</th>
                                <th>Gender</th>
                                <th>BirthDate</th>
                                <th>Mobile Number</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>
                                        @if (!empty($student->getProfile()))
                                            <img src="{{ $student->getProfile() }}" alt=""
                                                style=" height: 50px; width: 50px; border-radius: 50%">
                                        @else
                                            <p class="text-danger">Not Found</p>
                                        @endif
                                    </td>
                                    <td>{{ $student->parent_name . ' ' . $student->parent_last_name }}</td>
                                    <td>{{ $student->class_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->admission_number }}</td>
                                    <td>{{ $student->roll_number }}</td>
                                    @if (!empty($student->admission_date))
                                        <td>{{ date('d-m-Y', strtotime($student->admission_date)) }}</td>
                                    @endif
                                    <td>
                                        @if ($student->status == 1)
                                            <p class="text-success">Active</p>
                                        @else
                                            <p class="text-danger">InActive</p>
                                        @endif
                                    </td>
                                    <td>{{ $student->height }}</td>
                                    <td>{{ $student->weight }}</td>
                                    <td>{{ $student->caste }}</td>
                                    <td>{{ $student->blood_group }}</td>
                                    <td>{{ $student->religion }}</td>
                                    <td>{{ $student->gender }}</td>
                                    @if (!empty($student->date_of_birth))
                                        <td>{{ date('d-m-Y', strtotime($student->date_of_birth)) }}</td>
                                    @endif
                                    <td>{{ $student->mobile_number }}</td>
                                    <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
                                    <td style="min-width: 180px">
                                        <a href="{{ url('admin/student/edit/' . $student->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ url('admin/student/delete/' . $student->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="padding: 10px; float: right; ">
                        {{ $students->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
