@extends('layouts.app')

@section('title', 'SMS-Edit Single Assigned Subject')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Single Assigned Subject</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <!-- general form elements -->
                        <div class="card card-primary">

                            <!-- form start -->
                            <form action="" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <select name="class_id" class="form-control" required>
                                            <option value="">Select Class</option>
                                            @foreach ($getClass as $class)
                                                <option value="{{ $class->id }}"
                                                    @if ($class->id == $assignedSubject->class_id) selected @endif>{{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <select name="subject_id" class="form-control" required>
                                            <option value="">Select Subject</option>
                                            @foreach ($getSubject as $subject)
                                                <option value="{{ $subject->id }}"
                                                    @if ($subject->id == $assignedSubject->subject_id) selected @endif>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @if ($assignedSubject->status == 1) selected @endif>Active
                                            </option>
                                            <option value="0" @if ($assignedSubject->status == 0) selected @endif>
                                                InActive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Assigned Subject</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->



                    </div>
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
