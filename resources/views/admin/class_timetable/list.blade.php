@extends('layouts.app')

@section('title', 'SMS-Class Timetable List')
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
                            <h1>Assign New Class Timetable</h1>
                        </div>


                    </div>
                </div><!-- /.container-fluid -->
            </section>




            <!-- Search Form -->
            <div class="card card-primary">
                <!-- form start -->
                <form action="" method="get">
                    <div class="card-header">
                        <h3 class="card-title">Search Class Timetable</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Class Name</label>
                                <select class="form-control getClass" name="class_id" required>
                                    <option value="">Select</option>
                                    @foreach ($getClass as $class)
                                        <option value="{{ $class->id }}"
                                            {{ Request::get('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-3">
                                <label>Subject Name</label>
                                <select class="form-control getSubject" name="subject_id" required>
                                    <option value="">Select</option>
                                    @if (!empty($getSubject))
                                        @foreach ($getSubject as $subject)
                                            <option value="{{ $subject->subject_id }}"
                                                {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                                {{ $subject->subject_name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                <a href="/admin/class_timetable/list" class="btn btn-success"
                                    style="margin-top: 30px">Clear</a>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->


            @if (!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                <form action="/admin/class_timetable/add" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                    <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

                    {{-- Table Card --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Class Timetable</h3>
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
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($week as $WeekV)
                                        <tr>


                                            <td>
                                                <input type="hidden" name="timetable[{{ $i }}][week_id]"
                                                    value="{{ $WeekV['week_id'] }}">
                                                {{ $WeekV['week_name'] }}
                                            </td>
                                            <td><input value="{{$WeekV['start_time']}}" class="form-control" type="time" name="timetable[{{ $i }}][start_time]" id="">
                                            </td>
                                            <td><input value="{{$WeekV['end_time']}}" class="form-control" type="time" name="timetable[{{ $i }}][end_time]" id="">
                                            </td>
                                            <td><input value="{{$WeekV['room_number']}}" style="width: 200px" class="form-control" type="text"
                                                    name="timetable[{{ $i }}][room_number]" id=""></td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center ; padding: 20px ">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                            {{--
                                <div style="padding: 10px; float: right; ">
                                    {{ $admins->appends(request()->query())->links() }}
                                </div> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </form>
            @endif



        </div>




    </div>
    <!-- /.content-wrapper -->

@endsection

@section('script')
    <script type="text/javascript">
        $('.getClass').change(function(e) {
            var class_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "/admin/class_timetable/get_subject",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id: class_id,
                },
                dataType: "json",
                success: function(response) {
                    $('.getSubject').html(response.html);
                }
            });

        });
    </script>
@endsection
