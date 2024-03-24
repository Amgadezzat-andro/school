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
                            <h1>My Class Timetable</h1>
                        </div>


                    </div>
                </div><!-- /.container-fluid -->
            </section>






            @foreach ($result as $value)
                {{-- Table Card --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $value['name'] }}</h3>
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
                            @foreach ($value['week'] as $time)
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
            @endforeach



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
