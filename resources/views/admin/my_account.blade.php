@extends('layouts.app')

@section('title', 'SMS-My Account')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Admin's Info</h1>
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
                        @include('_message')
                        <!-- general form elements -->
                        <div class="card card-primary">

                            <!-- form start -->
                            <form action="" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="name" class="form-control" name="name"
                                            placeholder="Enter Admin's Name" value="{{ old('name', $admin->name) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Admin's email" value="{{ old('email', $admin->email) }}"
                                            required>
                                        <div style="color: red">{{ $errors->first('email')}}</div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update My Info</button>
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
