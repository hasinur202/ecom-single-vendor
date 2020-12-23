@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-3">
                <div id="disableDiv" style="width: 100%;
                    padding: 5px;
                    background-color: white;
                    border: 1px solid #ddd;
                    box-shadow: 1px 1px #ddd;
                    border-radius: 5px;display: inline-flex;">
                    <button class="btn btn-primary" onclick="addlevel()" style="padding: 10px;">
                        <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                            style="margin-right: 5px;"></i>
                    </button>
                    <p style="margin-left: 5px;
                    font-weight: 700;
                    margin-bottom: 0px;">Add Share Holder Level
                        <span style="float: left;
                    margin-left: 15px;" class="badge badge-warning">0/0</span>
                    </p>
                </div>
            </div>
            <div class="col-sm-2">
                <div id="disableDiv" style="width: 100%;
                    padding: 5px;
                    background-color: white;
                    border: 1px solid #ddd;
                    box-shadow: 1px 1px #ddd;
                    border-radius: 5px;display: inline-flex;">

                    <a href="{{route('user.role')}}" style="padding: 10px;" class="btn btn-primary">
                        <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                            style="margin-right: 5px;"></i>

                      </a>
                    <p style="margin-left: 5px;
                    font-weight: 700;
                    margin-bottom: 0px;">Add Role
                        <span style="float: left;
                    margin-left: 15px;" class="badge badge-warning">0/0</span>
                    </p>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="showLevel" style="display: none;" class="row">
            <div class="card card-primary col-4" style="margin-left: 15px; padding-top: 8px;">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Add Share Holder level</h3>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
              <form>
                  <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">Level No.</label>
                      <input
                        id="cycle_no"
                        name="cycle_no"
                        type="text"
                        class="form-control"
                        placeholder="Example: 1"
                      />
                    </div>
                    <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Level Value</label>
                        <input
                          id="cycle_value"
                          name="cycle_value"
                          type="text"
                          class="form-control"
                          placeholder="Example: 20"
                        />
                      </div>
                      <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">E-Money</label>
                        <input
                          id="e_money"
                          name="e_money"
                          type="text"
                          class="form-control"
                          placeholder="E-Money "
                        />
                      </div>
                      <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Level Wise Commision [%]</label>
                        <input
                          id="commision"
                          name="commision"
                          type="text"
                          class="form-control"
                          placeholder="Example: 10 "
                        />
                      </div>
                  </div>
                  <button
                    id="submit"
                    style="width: 100%"
                    type="button"
                    onclick="storeLevel()"
                    class="btn btn-primary"
                  >
                    Submit
                  </button>
                </form>
            </div>
            <div class="card col-7" style="margin-left: 70px;">
                <div class="card-header">
                <h3 class="card-title">Share Holder level table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr role="row">
                        <th>SI# </th>
                        <th>Level No.</th>
                        <th>Level Value</th>
                        <th>E-Money</th>
                        <th>Commision [%]</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbl">
                        @include('layouts.backend.dashboardTbl')
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <div id="defaultMode">
        <div class="card col-lg-5">
            <div class="card-header">
              <h3 class="card-title">ShareHolder Level Info</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-footer bg-white p-0" style="display: block;">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Level #
                    <span class="float-right text-danger">
                      ShareHolder Qty</span>
                  </a>
                </li>


                <li class="nav-item" style="background:#ddd">
                    <a href="#" class="nav-link">
                      Level - 0
                      <span class="float-right text-danger">{{ $zeroLevelsCount }}</span>
                    </a>
                  </li>


                  @foreach($level_wise_holder as $level_holders)
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Level - {{ $level_holders->cycle_no }}

                      @php $i=0; @endphp
                      @foreach ($level_holders->get_share_holders as $share_holder_qty)
                      @php $i++; @endphp

                      @endforeach
                      <span class="float-right text-success">{{ $i }}</span>
                    </a>
                  </li>
                  @endforeach

              </ul>
            </div>
            <!-- /.footer -->
          </div>

        <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
                </div>
                <div class="icon">
                <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
                </div>
                <div class="icon">
                <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
      </div>
    </div>




    </section>
    <!-- /.content -->
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
        function addlevel(){
            $("#showLevel").show();
            $("#defaultMode").hide();
        }

        function editLevel(id){
          $("#cycle_value_n"+id).hide();
          $("#edit_cycle_value"+id).show();
          $("#cycle_emoney_n"+id).hide();
          $("#edit_cycle_emoney"+id).show();
          $("#cycle_commision_n"+id).hide();
          $("#edit_commision"+id).show();
          $("#edit_btn_n"+id).hide();
          $("#update_btn_e"+id).show();
          $("#undo_btn_d"+id).show();
        }

        function closeEdit(id){
          $("#cycle_value_n"+id).show();
          $("#edit_cycle_value"+id).hide();
          $("#cycle_emoney_n"+id).show();
          $("#edit_cycle_emoney"+id).hide();
          $("#cycle_commision_n"+id).show();
          $("#edit_commision"+id).hide();
          $("#edit_btn_n"+id).show();
          $("#update_btn_e"+id).hide();
          $("#undo_btn_d"+id).hide();
        }

        function storeLevel(){
            $.ajax({
                url:"{{ route('level.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:"POST",
                dataType:"html",
                data:{
                    'cycle_no':$("#cycle_no").val(),
                    'cycle_value':$("#cycle_value").val(),
                    'e_money':$("#e_money").val(),
                    'commision':$("#commision").val(),
                },
                success: function(response) {
                    $("#tbl").html(response);

                    $("#cycle_no").val('');
                    $("#cycle_value").val('');
                    $("#e_money").val('');
                    $("#commision").val('');
                },
                error: function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Wrong data entry.'
                  })

                }
            })
        }

/*
        function deleteLevel(id){
            $.ajax({
                url:"{{ route('level.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:"POST",
                dataType:"html",
                data:{
                    'id':id,
                },
                success: function(response) {
                    $("#tbl").html(response);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps!',
                        text:'Something Went Wrong.'
                    })
                }
            })
        }
*/

        function updateLevel(id){
            $.ajax({
                url:"{{ route('level.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:"POST",
                dataType:"html",
                data:{
                    'edit_cycle_value':$("#edit_cycle_value"+id).val(),
                    'edit_e_money':$("#edit_cycle_emoney"+id).val(),
                    'edit_commision':$("#edit_commision"+id).val(),
                    'id':id
                },
                success: function(response) {
                    $("#tbl").html(response);

                },
                error: function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Wrong data entry.'
                  })
                }
            })
        }
    </script>
@endsection
@endsection
