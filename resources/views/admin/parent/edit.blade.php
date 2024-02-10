@extends('layouts.app')

@section('title', 'SMS-Edit Parent')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Parent : {{ $parent->name }}</h1>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red">*</span></label>
                                            <input type="name" class="form-control" name="name"
                                                placeholder="Enter Parent's First Name"
                                                value="{{ old('name', $parent->name) }}" required>
                                            <div style="color: red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red">*</span> </label>
                                            <input type="name" class="form-control" name="last_name"
                                                placeholder="Enter Parent's Last Name"
                                                value="{{ old('last_name', $parent->last_name) }}" required>
                                            <div style="color: red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red">*</span></label>
                                            <select class="form-control" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male"
                                                    {{ old('gender', $parent->gender) == 'male' ? 'selected' : '' }}> Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender', $parent->gender) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('gender') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Occupation</label>
                                            <input type="name" class="form-control" name="occupation"
                                                placeholder="Enter Parent's Occupation"
                                                value="{{ old('occupation', $parent->occupation) }}">
                                            <div style="color: red">{{ $errors->first('occupation') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="name" class="form-control" name="address"
                                                placeholder="Enter Parent's Address"
                                                value="{{ old('address', $parent->address) }}">
                                            <div style="color: red">{{ $errors->first('address') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Number <span style="color: red">*</span> </label>
                                            <input type="name" class="form-control" name="mobile_number"
                                                placeholder="Enter Parent's Mobile Number"
                                                value="{{ old('mobile_number', $parent->mobile_number) }}" required>
                                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                            @if (!empty($parent->getProfile()))
                                                <img src="{{ $parent->getProfile() }}" style="width: 100px">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status <span style="color: red">*</span></label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="0"
                                                    {{ old('status', $parent->status) == 0 ? 'selected' : '' }}>InActive
                                                </option>
                                                <option value="1"
                                                    {{ old('status', $parent->status) == 1 ? 'selected' : '' }}>Active
                                                </option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Email address <span style="color: red">*</span> </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Parent's email"
                                            value="{{ old('email', $parent->email) }}" required>
                                        {{-- !Validation Errors ! --}}
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span style="color: red">*</span> </label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter Parent's Password">
                                        <p>Add New Password if you want to change password</p>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Parent</button>
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
