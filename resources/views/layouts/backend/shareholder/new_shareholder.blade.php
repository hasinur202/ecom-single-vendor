
@extends('layouts.backend.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid offset-1">
                <div class="row mb-2">
                    <h1>Share Holder</h1>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="card col-10 offset-1">
                    <div class="card-header">
                        <h3 class="card-title">New ShareHolder List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI #</th>
                                    <th>Name</th>
                                    <th>Token</th>
                                    <th>NID Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($shareholders as $shareholder)
                                @php
                                    $i++;
                                @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $shareholder->get_users->name }}</td>
                                        <td>
                                            <a href="{{ url('generate-token/'.$shareholder->user_id.'/'.$shareholder->get_users->name) }}" class="badge badge-success">Generate Token</a>
                                        </td>
                                        <td>
                                            Front -
                                            <button onclick="nidFront({{ $shareholder }})" data-toggle="modal" data-target="#viewNidPhoto" style="margin-right: 5px;"
                                                class="badge badge-success">
                                                <i class="fas fa-search-plus"></i>
                                            </button><br>

                                            Back -
                                            <button onclick="nidBack({{ $shareholder }})" data-toggle="modal" data-target="#viewNidPhoto"
                                                class="badge badge-success">
                                                 <i class="fas fa-search-plus"></i>
                                            </button>

                                        </td>
                                        <td>
                                            pending
                                        </td>

                                        <td style="display:inline-flex;">
                                            <button onclick="viewShareholder({{ $shareholder }})" data-toggle="modal" data-target="#viewDetails" style="margin-right: 5px;"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <a href="{{ url('delete-shareholder/'.$shareholder->id.'') }}" class="btn btn-danger btn-sm">
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


        <div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">ShareHolder Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name_label">ShareHolder Name</label>
                                    <input name="name" id="name" value="" type="text" class="form-control" readonly placeholder="Enter contact number" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ShareHolders Account No.</label>
                                    <input name="account_no" id="account_no" value="" type="text" class="form-control" readonly placeholder="Enter contact number" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="mbl_label">Mobile No.</label>
                                    <input name="phone" id="phone" value="" type="text" class="form-control" readonly placeholder="Enter contact number" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Type</label>
                                    <input name="account_type" id="acc_type" value="" type="text" class="form-control" readonly placeholder="Enter contact number" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="nid_label">NID No.</label>
                                    <input name="nid" id="nid" value="" type="text" class="form-control" readonly placeholder="Enter contact number" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ShareHolders Address</label>
                                    <input name="address" id="address" value="" type="text" class="form-control" readonly placeholder="Enter contact number" />
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" id="nid_img_label1" class="col-form-label">NID Photo (Front)</label>
                                    <div style="height: 9.5rem; border: dashed 1.5px blue;
                                            background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                            width: 100% !important; cursor: pointer;">
                                        <img src="" id="image-img1" style="height: 9.5rem; width: 100% !important; cursor: pointer;margin-top: -2px;" />
                                    </div>
                                    <input style="display:none;border: none; width: 75%; background-color:#f15353; color: #fff;
                                  font-size: 10px;margin-top:2px;" type="text" id="imageError" name="imageError" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" id="nid_img_label2" class="col-form-label">NID Photo (Back)</label>
                                    <div style="height: 9.5rem; border: dashed 1.5px blue;
                                            background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                            width: 100% !important; cursor: pointer;">
                                        <img src="" id="image-img2" style="height: 9.5rem; width: 100% !important; cursor: pointer;margin-top: -2px;" />
                                    </div>
                                    <input style="display:none;border: none; width: 75%; background-color:#f15353; color: #fff;
                                  font-size: 10px;margin-top:2px;" type="text" id="imageError" name="imageError" readonly>
                                </div>
                            </div>

                            <div class="modal-footer" style="margin:auto">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="viewNidPhoto" tabindex="-1" role="dialog" style="margin-left:20px !important;" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span style="float: right;padding-right:10px;" aria-hidden="true">&times;</span>
                    </button>
                    <img src="" id="image-img3" style="height: 35rem; width: 100% !important; cursor: pointer;margin-top: -2px;" />
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

    function nidBack(shareholder){
        if(shareholder.nid == null){
            $("#image-img3").attr('src', "{{ asset('/images/') }}/" + shareholder.get_nominees.nom_image2);

        }else{
            $("#image-img3").attr('src', "{{ asset('/images/') }}/" + shareholder.image_back);
        }
    }

    function nidFront(shareholder){
        if(shareholder.nid == null){
            $("#image-img3").attr('src', "{{ asset('/images/') }}/" + shareholder.get_nominees.nom_image1);

        }else{
            $("#image-img3").attr('src', "{{ asset('/images/') }}/" + shareholder.image_front);
        }
    }


    function viewShareholder(shareholder){
        if(shareholder.nid == null){
            $("#name").val(shareholder.get_nominees.nominee_name);
            $("#account_no").val(shareholder.account_no);
            $("#acc_type").val(shareholder.acc_type);
            $("#phone").val(shareholder.get_nominees.nom_mobile);
            $("#nid").val(shareholder.get_nominees.nom_nid);
            $("#address").val(shareholder.get_users.address);

            $("#image-img1").attr('src', "{{ asset('/images/') }}/" + shareholder.get_nominees.nom_image1);
            $("#image-img2").attr('src', "{{ asset('/images/') }}/" + shareholder.get_nominees.nom_image2);

            $("#name_label").text('Nominee Name');
            $("#mbl_label").text('Nominee Mobile');
            $("#nid_label").text('Nominee NID');
            $("#nid_img_label1").text('Nominee NID Photo - front');
            $("#nid_img_label2").text('Nominee NID Photo - back');

        }else{
            $("#name").val(shareholder.get_users.name);
            $("#account_no").val(shareholder.account_no);
            $("#acc_type").val(shareholder.acc_type);
            $("#phone").val(shareholder.get_users.phn);
            $("#nid").val(shareholder.nid);
            $("#address").val(shareholder.get_users.address);


            $("#image-img1").attr('src', "{{ asset('/images/') }}/" + shareholder.image_front);
            $("#image-img2").attr('src', "{{ asset('/images/') }}/" + shareholder.image_back);

            $("#name_label").text('ShareHolders Name');
            $("#mbl_label").text('Mobile No.');
            $("#nid_label").text('NID No.');
            $("#nid_img_label1").text('NID Photo - front');
            $("#nid_img_label2").text('NID Photo - back');
        }

    }




</script>

<script type="text/javascript">




</script>

@endsection
@endsection
