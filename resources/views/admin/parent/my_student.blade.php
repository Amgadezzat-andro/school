@extends('layouts.app')

@section('title', 'SMS-Parent-Student List')
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
                            <h1>Parent-Student List Of : <span class="text-success "> {{ $parent->name . " " . $parent->last_name }}</span></h1>
                        </div>
                    </div>
                </div>
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
                                <label>Student ID</label>
                                <input type="text" class="form-control" name="id" placeholder="Enter Studnet's ID"
                                    value="{{ old('name', Request::get('id')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter Studnet's First Name"
                                    value="{{ old('name', Request::get('name')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    placeholder="Enter Studnet's Last Name"
                                    value="{{ old('name', Request::get('last_name')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email"
                                    placeholder="Enter Studnet's Email" value="{{ old('email', Request::get('email')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                <a href="{{ url('admin/parent/my-student/' . $parent_id) }}" class="btn btn-success"
                                    style="margin-top: 30px">Clear</a>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>

            @if (!empty($getSearchStudents))
                {{-- Table Card --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Profile Pic</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Parent Name</th>
                                    <th>Created Date</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getSearchStudents as $key => $student)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if (!empty($student->getProfile()))
                                                <img src="{{ $student->getProfile() }}" alt=""
                                                    style=" height: 50px; width: 50px; border-radius: 50%">
                                            @else
                                                <p class="text-danger">Not Found</p>
                                            @endif
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->parent_name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
                                        <td style="min-width: 180px">
                                            @if (!empty($student->parent_name))
                                                <span class="btn btn-success"> Added </span>
                                            @else
                                            <a href="{{ url('admin/parent/assign_student_parent/' . $student->id . '/' . $parent_id) }}"
                                                class="btn btn-primary">Add Student To Parent</a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div style="padding: 10px; float: right; ">

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            @endif


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parent-Student List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Parent Name</th>
                                <th>Created Date</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parentStudents as $key => $myStudent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if (!empty($myStudent->getProfile()))
                                            <img src="{{ $myStudent->getProfile() }}" alt=""
                                                style=" height: 50px; width: 50px; border-radius: 50%">
                                        @else
                                            <p class="text-danger">Not Found</p>
                                        @endif
                                    </td>
                                    <td>{{ $myStudent->name }}</td>
                                    <td>{{ $myStudent->email }}</td>
                                    <td>{{ $myStudent->parent_name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($myStudent->created_at)) }}</td>
                                    <td style="min-width: 180px">
                                        <a href="{{ url('admin/parent/assign_student_parent_delete/' . $myStudent->id . '/' . $parent_id) }}"
                                            class="btn btn-primary">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div style="padding: 10px; float: right; ">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>



        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
