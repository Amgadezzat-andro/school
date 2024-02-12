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
                                            <input type="name" class="form-control" name="name"
                                                placeholder="Enter Student's First Name"
                                                value="{{ old('name', $student->name) }}" required>
                                            <div style="color: red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red">*</span> </label>
                                            <input type="name" class="form-control" name="last_name"
                                                placeholder="Enter Student's Last Name"
                                                value="{{ old('last_name', $student->last_name) }}" required>
                                            <div style="color: red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red">*</span></label>
                                            <select class="form-control" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male"
                                                    {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}> Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Birth Date <span style="color: red">*</span></label>
                                            <input type="date"
                                                value="{{ old('date_of_birth', $student->date_of_birth) }}"
                                                class="form-control" name="date_of_birth" required>
                                            <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Caste</label>
                                            <input type="name" class="form-control" name="caste"
                                                placeholder="Enter Student's Caste"
                                                value="{{ old('caste', $student->caste) }}">
                                            <div style="color: red">{{ $errors->first('caste') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion</label>
                                            <input type="name" class="form-control" name="religion"
                                                placeholder="Enter Student's Religion"
                                                value="{{ old('religion', $student->religion) }}">
                                            <div style="color: red">{{ $errors->first('religion') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile Number <span style="color: red">*</span> </label>
                                            <input type="name" class="form-control" name="mobile_number"
                                                placeholder="Enter Student's Mobile Number"
                                                value="{{ old('mobile_number', $student->mobile_number) }}" required>
                                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                            @if (!empty($student->getProfile()))
                                                <img src="{{ $student->getProfile() }}" style="width: 100px">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Blood Group</label>
                                            <input type="name" class="form-control" name="blood_group"
                                                placeholder="Enter Student's Blood Group"
                                                value="{{ old('blood_group', $student->blood_group) }}">
                                            <div style="color: red">{{ $errors->first('blood_group') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Weight</label>
                                            <input type="name" class="form-control" name="weight"
                                                placeholder="Enter Student's Weight"
                                                value="{{ old('weight', $student->weight) }}">
                                            <div style="color: red">{{ $errors->first('weight') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Height</label>
                                            <input type="name" class="form-control" name="height"
                                                placeholder="Enter Student's Height "
                                                value="{{ old('height', $student->height) }}">
                                            <div style="color: red">{{ $errors->first('height') }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Email address <span style="color: red">*</span> </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Student's email"
                                            value="{{ old('email', $student->email) }}" required>
                                        {{-- !Validation Errors ! --}}
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
