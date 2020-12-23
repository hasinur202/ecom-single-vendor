@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            
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
                  <h3 class="card-title">Any thing</h3>
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
                <h3 class="card-title">Any Thing</h3>
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
              <h3 class="card-title">Any Thing....</h3>
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
                      Qty</span>
                  </a>
                </li>


                <li class="nav-item" style="background:#ddd">
                    <a href="#" class="nav-link">
                      Level - 0
                      <span class="float-right text-danger">0</span>
                    </a>
                  </li>


                  
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Level - 0

                      {{-- @php $i=0; @endphp
                      @foreach ($level_holders->get_share_holders as $share_holder_qty)
                      @php $i++; @endphp

                      @endforeach --}}
                      <span class="float-right text-success">0</span>
                    </a>
                  </li>

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
    </script>
@endsection
@endsection
