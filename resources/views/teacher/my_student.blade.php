@extends('layouts.app')

@section('title', 'SMS-My Student List')
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
                            <h1>My Student List Total : {{ $students->total() }} Students</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>




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
                                <th>Class Name</th>
                                <th>Email</th>
                                <th>Admission Number</th>
                                <th>Roll Number</th>
                                <th>Admission Date</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Caste</th>
                                <th>Blood Group</th>
                                <th>Religion</th>
                                <th>Gender</th>
                                <th>BirthDate</th>
                                <th>Mobile Number</th>
                                <th>Created Date</th>
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
                                    <td>{{ $student->class_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->admission_number }}</td>
                                    <td>{{ $student->roll_number }}</td>
                                    @if (!empty($student->admission_date))
                                        <td>{{ date('d-m-Y', strtotime($student->admission_date)) }}</td>
                                    @endif

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
