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
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Admin's Name"
                                    value="{{ Request::get('name') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Email address</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Admin's email"
                                    value="{{ Request::get('email') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date"
                                    placeholder="Enter Admin's created Date" value="{{ Request::get('date') }}">
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
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
                                    <td>
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
