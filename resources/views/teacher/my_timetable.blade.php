@extends('layouts.app')

@section('title', 'SMS-Class Timetable List')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="col-md-12">


            {{-- HEADER --}}
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>My Timetable</h1>
                        </div>


                    </div>
                </div><!-- /.container-fluid -->
            </section>







            {{-- Table Card --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Class : {{ $getClass->name }} - Subject : {{ $getSubject->name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Week</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room Number</th>
                            </tr>
                        </thead>
                        @foreach ($result as $time)
                            <tbody>
                                <td>
                                    {{ $time['week_name'] }}
                                </td>
                                <td>
                                    {{ !empty($time['start_time']) ? date('h:i A', strtotime($time['start_time'])) : '' }}
                                </td>
                                <td>
                                    {{ !empty($time['end_time']) ? date('h:i A', strtotime($time['end_time'])) : '' }}
                                </td>
                                <td>
                                    {{ $time['room_number'] }}
                                </td>

                            </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->




        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
