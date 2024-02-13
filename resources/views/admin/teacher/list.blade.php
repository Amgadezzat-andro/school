@extends('layouts.app')

@section('title', 'SMS-Teacher List')
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
                            <h1>Teacher List Total : {{ $teachers->total() }} Teachers</h1>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="/admin/teacher/add" class="btn btn-primary">Add New Teacher</a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>




            <!-- Search Form -->
            <div class="card card-primary">
                <!-- form start -->
                <form action="" method="get">
                    <div class="card-header">
                        <h3 class="card-title">Search Teacher</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter Student's First Name"
                                    value="{{ old('name', Request::get('name')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    placeholder="Enter Student's Last Name"
                                    value="{{ old('last_name', Request::get('last_name')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email"
                                    placeholder="Enter Student's Email" value="{{ old('email', Request::get('email')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="" selected>All</option>
                                    <option value='male' {{ Request::get('gender') == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value='female' {{ Request::get('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number"
                                    placeholder="Enter Student's Mobile Number"
                                    value="{{ old('mobile_number', Request::get('mobile_number')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Marital Status</label>
                                <input type="text" class="form-control" name="martial_status"
                                    placeholder="Enter Student's Email"
                                    value="{{ old('martial_status', Request::get('martial_status')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Current Address</label>
                                <input type="text" class="form-control" name="current_address"
                                    placeholder="Enter Student's Current Addresss"
                                    value="{{ old('current_address', Request::get('current_address')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Join Date</label>
                                <input type="date" class="form-control" name="date_of_join"
                                    value="{{ old('date_of_join', Request::get('date_of_join')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="" selected>All</option>
                                    <option value='1.0' {{ Request::get('status') == '1.0' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value='0.0' {{ Request::get('status') == '0.0' ? 'selected' : '' }}>InActive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Created At</label>
                                <input type="date" class="form-control" name="date"
                                    value="{{ old('date', Request::get('date')) }}">
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                <a href="/admin/teacher/list" class="btn btn-success" style="margin-top: 30px">Clear</a>
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
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Join Date</th>
                                <th>Mobile Number</th>
                                <th>Martial Status</th>
                                <th>Current Address</th>
                                <th>Permanent Address</th>
                                <th>Qualification</th>
                                <th>Work Experience</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $key => $student)
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
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->gender }}</td>
                                    @if (!empty($student->date_of_birth))
                                        <td>{{ date('d-m-Y', strtotime($student->date_of_birth)) }}</td>
                                    @endif
                                    @if (!empty($student->date_of_join))
                                        <td>{{ date('d-m-Y', strtotime($student->date_of_join)) }}</td>
                                    @endif
                                    <td>{{ $student->mobile_number }}</td>
                                    <td>{{ $student->martial_status }}</td>
                                    <td>{{ $student->current_address }}</td>
                                    <td>{{ $student->permanent_address }}</td>
                                    <td>{{ $student->qualification }}</td>
                                    <td>{{ $student->work_exp }}</td>
                                    <td>{{ $student->note }}</td>
                                    <td>
                                        @if ($student->status == 1)
                                            <p class="text-success">Active</p>
                                        @else
                                            <p class="text-danger">InActive</p>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
                                    <td style="min-width: 180px">
                                        <a href="/admin/teacher/edit/{{ $student->id }}" class="btn btn-primary">Edit</a>
                                        <a href="/admin/teacher/delete/{{ $student->id }}"class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="padding: 10px; float: right; ">
                        {{ $teachers->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
