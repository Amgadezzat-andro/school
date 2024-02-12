@extends('layouts.app')

@section('title', 'SMS-My Student Subjects')
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
                            <h1>My Student <span class="text-danger">{{$student->name}}</span> Subjects</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            {{-- Table Card --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Student Subjects</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Subject Name</th>
                                <th>Subject Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $key => $subject)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $subject->subject_name }}</td>
                                    <td>
                                        @if ($subject->type == 0)
                                            Theory
                                        @else
                                            Practical
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection

