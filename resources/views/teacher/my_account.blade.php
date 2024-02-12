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
                        <h1>My Info</h1>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Teacher's First Name"
                                                value="{{ old('name', $teacher->name) }}" required>
                                            <div style="color: red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Enter Teacher's Last Name"
                                                value="{{ old('last_name', $teacher->last_name) }}" required>
                                            <div style="color: red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red">*</span></label>
                                            <select class="form-control" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male"
                                                    {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}> Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Birth Date <span style="color: red">*</span></label>
                                            <input type="date" value="{{ old('date_of_birth', $teacher->date_of_birth) }}"
                                                class="form-control" name="date_of_birth" required>
                                            <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Number <span style="color: red">*</span> </label>
                                            <input type="name" class="form-control" name="mobile_number"
                                                placeholder="Enter Teacher's Mobile Number"
                                                value="{{ old('mobile_number', $teacher->mobile_number) }}" required>
                                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Martial Status</label>
                                            <input type="text" class="form-control" name="martial_status"
                                                placeholder="Enter Teacher's Martial Status "
                                                value="{{ old('martial_status', $teacher->martial_status) }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                            @if (!empty($teacher->getProfile()))
                                                <img src="{{ $teacher->getProfile() }}" style="width: 100px">
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Current Address <span style="color: red">*</span></label>
                                            <textarea placeholder="Enter Teacher's Current Address" class="form-control" name="current_address" required>{{ old('current_address', $teacher->current_address) == '' ? null : old('current_address', $teacher->current_address) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Permenent Address </label>
                                            <textarea placeholder="Enter Teacher's Permenent Address" class="form-control" name="permanent_address">{{ old('permanent_address', $teacher->permanent_address) == '' ? null : old('permanent_address', $teacher->permanent_address) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Qualification</label>
                                            <textarea placeholder="Enter Teacher's Qualification" class="form-control" name="qualification">{{ old('qualification', $teacher->qualification) == '' ? null : old('qualification', $teacher->qualification) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Work Experience </label>
                                            <textarea placeholder="Enter Teacher's Work Exp" class="form-control" name="work_exp">{{ old('work_exp', $teacher->work_exp) == '' ? null : old('work_exp', $teacher->work_exp) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Teacher's email"
                                            value="{{ old('email', $teacher->email) }}" required>
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
