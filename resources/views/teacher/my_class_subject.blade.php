@extends('layouts.app')

@section('title', 'SMS-My Classes & Subjects')

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
                            <h1>My Classes & Subjects</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            {{-- Table Card --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Classes & Subjects</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Class Name</th>
                                <th>Subject Name</th>
                                <th>Subject Type</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $index => $class)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $class->class_name }}</td>
                                    <td>{{ $class->subject_name }}</td>
                                    <td>
                                        @if ($class->subject_type == 0)
                                            Theory
                                        @else
                                            Practical
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($class->created_at)) }}</td>
                                    <td>
                                        <a href="/teacher/my_class_subject/class_timetable/{{ $class->class_id }}/{{ $class->subject_id }}"
                                            class="btn btn-primary">My Class Timetable</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{--
                    <div style="padding: 10px; float: right; ">
                        {{ $admins->appends(request()->query())->links() }}
                    </div> --}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection
