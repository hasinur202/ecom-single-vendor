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
