@extends('layouts.app')

@section('title', 'SMS-Parent List')
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
                            <h1>Parent List Total : {{ $parents->total() }} Parents</h1>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>




            <!-- Search Form -->
            <div class="card card-primary">
                <!-- form start -->
                <form action="" method="get">
                    <div class="card-header">
                        <h3 class="card-title">Search Parent</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Parent's First Name"
                                    value="{{ old('name',Request::get('name'))  }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter Parent's Last Name"
                                    value="{{ old('name',Request::get('last_name'))  }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="" selected>All</option>
                                    <option value='male' {{ Request::get('gender') == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value='female' {{ Request::get('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Occupation</label>
                                <input type="text" class="form-control" name="occupation" placeholder="Enter Parent's Occupation"
                                    value="{{ old('occupation', Request::get('occupation')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Parent's Address"
                                    value="{{ old('address', Request::get('address')) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Email address</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Parent's email"
                                    value="{{ Request::get('email') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number" placeholder="Enter Parent's Mobile Number"
                                    value="{{ old('mobile_number', Request::get('mobile_number')) }}">
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
                            <div class="form-group col-md-3">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date"
                                    placeholder="Enter Parent's created Date" value="{{ Request::get('date') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                <a href="{{ url('admin/parent/list') }}" class="btn btn-success"
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
                    <h3 class="card-title">Parent List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-responsive ">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Profile Pic</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Occupation</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parents as $key => $parent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $parent->name }}</td>
                                    <td>{{ $parent->last_name }}</td>
                                    <td>{{ $parent->email }}</td>
                                    <td>
                                        @if (!empty($parent->getProfile()))
                                            <img src="{{ $parent->getProfile() }}" alt=""
                                                style=" height: 50px; width: 50px; border-radius: 50%">
                                        @else
                                            <p class="text-danger">Not Found</p>
                                        @endif
                                    </td>
                                    <td>{{ $parent->gender }}</td>
                                    <td>{{ $parent->mobile_number }}</td>
                                    <td>{{ $parent->occupation }}</td>
                                    <td>{{ $parent->address }}</td>
                                    <td>
                                        @if ($parent->status == 1)
                                            <p class="text-success">Active</p>
                                        @else
                                            <p class="text-danger">InActive</p>
                                        @endif
                                    </td>

                                    <td>{{ date('d-m-Y', strtotime($parent->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/parent/edit/' . $parent->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ url('admin/parent/delete/' . $parent->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="padding: 10px; float: right; ">
                        {{ $parents->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
