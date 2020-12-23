
@extends('layouts.backend.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subscriber</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Subscribers List</h3>
                        <a class="btn btn-info btn-sm" style="float: right;" href="{{ url('export-subscriber-list') }}">Export
                            <i style="padding-left: 5px;" class="fas fa-file-excel"></i>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI #</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->id }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>
                                            @if($subscriber->status == 1)
                                            <a href="{{ url('update-subscriber-status/'.$subscriber->id.'/0') }}">
                                                <span class="badge badge-info">Active</span>
                                            </a>
                                            @else
                                            <a href="{{ url('update-subscriber-status/'.$subscriber->id.'/1') }}">
                                                <span class="badge badge-danger">Inactive</span>
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ $subscriber->created_at }}</td>
                                        <td>
                                            <a href="{{ url('delete-subscriber/'.$subscriber->id.'') }}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
        </div>

        </div>

    </section>
</div>
@section('js')

<script>
    $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
    });
</script>

<script type="text/javascript">



</script>

@endsection
@endsection
