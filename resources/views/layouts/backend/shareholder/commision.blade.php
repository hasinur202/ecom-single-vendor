
@extends('layouts.backend.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <div style="width: 100%;
                            padding: 5px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#payCommision" style="padding: 10px;">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                    style="margin-right: 5px;"></i>
                            </button>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-top: 10px;">Provide Commision
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Commision History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Commision</th>
                                        <th>Success Details</th>
                                        <th>Success (Total)</th>
                                        <th>Remaining (Total)</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commisionData as $commision)
                                        <tr>
                                            <td>
                                                {{ $commision->created_at }}
                                            </td>
                                            <td>{{ $commision->commision_value }} Tk.</td>

                                            <td>
                                                @php
                                                    $total_success = 0;
                                                @endphp
                                                @foreach ($commision->get_commisionDetails as $com_details)
                                                @php
                                                    $total_success = $total_success + $com_details->level_money;
                                                @endphp

                                                <span class="badge badge-info">Level - {{ $com_details->level_no }}
                                                : Tk. - {{ $com_details->level_money }}</span> <br>
                                                @endforeach

                                            </td>
                                            <td>{{ $total_success }} Tk.</td>
                                            <td>{{ $commision->commision_value - $total_success }} Tk.</td>
                                            <td>{{ $commision->comment }}</td>
                                            <td style="display:inline-flex;">
                                                <a href="{{ url('delete_commision/'.$commision->id) }}" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
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

            <div class="modal fade" id="payCommision" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background: #e6e0f0;">
                      <h5 class="modal-title" id="addNewLabel">Provide Commision to ShareHolder</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('commision.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label >Commision Amount*</label>
                                <input name="commision" id="commision" value="" type="text" class="form-control" placeholder="Enter Commision" />
                            </div>
                            <div class="form-group">
                                <label>Comment (optional)</label>
                                <textarea name="comment" class="form-control" placeholder="Say Something"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Decline</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
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
