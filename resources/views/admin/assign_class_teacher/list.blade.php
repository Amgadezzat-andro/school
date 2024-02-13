@extends('layouts.app')

@section('title', 'SMS-Class Teacher List')
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
                            <h1>Assign Class-Teacher List Total : Class Assigned To teacher</h1>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="/admin/assign_class_teacher/add" class="btn btn-primary">Assign New
                                Class-Teacher</a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>




            <!-- Search Form -->
            <div class="card card-primary">
                <!-- form start -->
                <form action="" method="get">
                    <div class="card-header">
                        <h3 class="card-title">Search Assigned Teachers</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Teacher Name</label>
                                <input type="text" class="form-control" name="teacher_name"
                                    placeholder="Enter Teacher's Name"
                                    value="{{ old('name', Request::get('teacher_name')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Class Name</label>
                                <input type="text" class="form-control" name="class_name"
                                    placeholder="Enter Subject's Class Name"
                                    value="{{ old('name', Request::get('class_name')) }}">
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
                            {{-- <div class="form-group col-md-3">
                                <label>Created by</label>
                                <input type="text" class="form-control" name="created_by"
                                    placeholder="Enter Class created Owner" value="{{ Request::get('created_by') }}">
                            </div> --}}
                            <div class="form-group col-md-3">
                                <label>Created At</label>
                                <input type="date" class="form-control" name="date"
                                    placeholder="Enter Admin's created Date" value="{{ Request::get('date') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                <a href="/admin/assign_class_teacher/list" class="btn btn-success"
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
                    <h3 class="card-title">Assigned Class-Teacher List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Class Name</th>
                                <th>Teacher Name</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($Assigned_Classes as $key => $class)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $class->class_name }}</td>
                                    <td>{{ $class->teacher_name }}</td>
                                    <td>{{ $class->created_by }}</td>
                                    <td>
                                        @if ($class->status == 0)
                                            InActive
                                        @else
                                            Active
                                        @endif

                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($class->created_at)) }}</td>
                                    <td>
                                        <a href="/admin/assign_class_teacher/edit/{{ $class->id }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="/admin/assign_class_teacher/delete/{{ $class->id }}"
                                            class="btn btn-danger">Delete</a>
                                        <a href="/admin/assign_class_teacher/edit_single/{{ $class->id }}"
                                            class="btn btn-dark">Edit Single</a>
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
            <!-- /.card -->
        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
