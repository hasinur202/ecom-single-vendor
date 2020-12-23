@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div style="    width: 36%;
                        padding: 10px;
                        background-color: white;
                        border: 1px solid #ddd;
                        box-shadow: 1px 1px #ddd;
                        border-radius: 5px;display: inline-flex;">
                            <button class="btn btn-primary" onclick="showForm()" style="padding: 10px;">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                    style="margin-right: 5px;"></i>
                            </button>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Add Ads-Image
                                <span style="float: left;
                                margin-left: 15px;" class="badge badge-warning">0/0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div id="loading" class="col-4" style="margin-left: 15px;
                        padding-top: 8px;
                        height: 308px;
                        display: block;
                        color:#767676;
                        background-color:#ddd;
                        text-align:center;
                        float: left;
                        margin-right:70px;
                    ">
                    <h1 style="margin-top: 35%;opacity: .3;">Loading...</h1>
                </div>
                <div id="adsForm" class="card card-primary col-4" style="margin-left: 15px;
                        padding-top: 8px;
                        height: 100%;
                        display: none;
                        float: left;
                        margin-right:70px;
                    ">
                    <div class="card-header" id="cardHeader" style="color: #fff;
                      background-color: #007bff;
                      border-color: #007bff;
                      box-shadow: none;">
                        <h3 class="card-title">Add Ads Image</h3>
                        <h3 class="card-title" style="display: none;" id="cardTitle">Update Ads Image</h3>
                        <button onclick="closeForm()" class="close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="card-body" style="padding-top: 5px !important;padding-bottom:5px !important;">
                        <div class="panel-body">
                            <form style="margin-bottom: 10px;
                                    background-color: #ddd;
                                    border: 2px dashed #767676;
                                    margin-top: 10px;
                                    height:auto;padding: 20px;" id="adUpload">
                                    <input type="text" id="slug" name="slug" hidden>
                                <div class="form-group" id="divHide">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Select Position</label>
                                    <select class="form-control" name="position" id="position">
                                        <option value="" selected="selected" hidden>select position</option>
                                        <option value="popup">popup</option>
                                        <option value="top">top</option>
                                        <option value="body-top left">body-top left</option>
                                        <option value="body-top right">body-top right</option>
                                        <option value="body-bottom left">body-bottom left</option>
                                        <option value="body-bottom right">body-bottom right</option>
                                    </select>
                                    <p id="posError" style="display: none;background-color: #e68888;
                                    color: #fff;
                                    margin-top: 2px;
                                    font-size: 12px;
                                    width: 56%;">Position already in database.</p>
                                    <p id="posError1" style="display: none;background-color: #e68888;
                                    color: #fff;
                                    margin-top: 2px;
                                    font-size: 12px;
                                    width: 56%;">Position field is required.</p>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-form-label">Ad Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 100% !important;
                                        cursor: pointer;">
                                        <input style="opacity: 0;
                                          height: 100px;
                                          cursor: pointer;
                                          padding: 0px;" id="avatar" type="file" class="form-control" name="avatar">
                                        <img src="" id="avatar-img" style="height: 100px;
                                          width: 100% !important;
                                          cursor: pointer;margin-top: -134px;" />
                                    </div>
                                    <p id="imageError" style="display: none;background-color: #e68888;
                                    color: #fff;
                                    margin-top: 2px;
                                    font-size: 12px;
                                    width: 56%;">Image field is required.</p>
                                </div>
                                <button type="button" onclick="uploadAd()" class="btn btn-primary" style="width: 100%"
                                    id="submit">Submit</button>
                                <button type="button" onclick="updateAd()" class="btn btn-success" style="width: 100%"
                                    id="update">Submit</button>

                            </form>
                        </div>

                    </div>

                </div>
                <div class="card col-7">
                    <div class="card-header">
                        <h3 class="card-title">Ads List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="example1_length"><label>Show <select
                                                name="example1_length" aria-controls="example1"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                class="form-control form-control-sm" placeholder=""
                                                aria-controls="example1"></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 166px;">Banar</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 166px;">Position</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 219px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                                    style="width: 99px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ads as $ad)
                                                <tr>
                                                    <td>
                                                        <img id="uploaded_image" style="height: 50px;width: 120px;"
                                                            src="{{ asset('/images/' . $ad->avatar) }}" />
                                                    </td>
                                                    <td>{{ $ad->position }}</td>
                                                    <td>
                                                        @if ($ad->status == 0)
                                                            <button class="badge badge-warning">Inactive</button>
                                                        @else
                                                            <button class="badge badge-success">Active</button>
                                                        @endif
                                                    </td>
                                                    <td style="display:inline-flex;">
                                                        <button onclick="editAds({{ $ad }})" style="margin-right: 5px;"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('ads.delete', $ad->id) }}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-danger" type="submit">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Banar</th>
                                                <th rowspan="1" colspan="1">Position</th>
                                                <th rowspan="1" colspan="1">Status</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing
                                        1 to 10 of 57 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="example1_previous">
                                                <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"
                                                    class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="example1" data-dt-idx="1" tabindex="0"
                                                    class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                    data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                    data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                    data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                    data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                    data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                            <li class="paginate_button page-item next" id="example1_next"><a href="#"
                                                    aria-controls="example1" data-dt-idx="7" tabindex="0"
                                                    class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
    </div>

@section('js')
    <script>
        function showForm() {
            $("#adUpdate").attr('id', 'adUpload');
            $("#update").hide();
            $("#submit").show();
            $("#cardTitle").hide();

            document.getElementById("loading").style.display = "none";
            document.getElementById("adsForm").style.display = "block";
            $('#divHide').show();
        }

        function closeForm() {
            $("#avatar-img").attr('src', "#");
            document.getElementById("adsForm").style.display = "none";
            document.getElementById("loading").style.display = "block";
            $('#slug').val();
            $('#position').val();
            $('#divHide').show();
        }

        function editAds(ad) {
            $("#adUpload").attr('id', 'adUpdate');
            $("#submit").hide();
            $("#update").show();
            $("#cardTitle").show();
            $("#cardHeader").css({
                'color': '#fff',
                'background-color': '#28a745',
                'border-color': '#28a745',
                'box-shadow': 'none',
            });
            $("#avatar-img").attr('src', "{{ asset('/images/') }}/" + ad.avatar);
            document.getElementById("adsForm").style.display = "block";
            document.getElementById("loading").style.display = "none";
            $('#slug').val(ad.slug);
            $('#position').val(ad.position);
            $('#divHide').hide();
        }

        function avatarUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#avatar").change(function() {
            avatarUrl(this);
        });

        function uploadAd() {
            $("#submit").prop('disabled', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ads.upload') }}",
                method: "POST",
                data: new FormData(document.getElementById("adUpload")),
                enctype: 'multipart/form-data',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        if (response.errors[0] && response.errors[1]) {
                            document.getElementById("posError1").style.display = "block";
                            setTimeout('$("#posError1").hide()', 6000);

                            document.getElementById("imageError").style.display = "block";
                            setTimeout('$("#imageError").hide()', 6000);
                            $("#submit").prop('disabled', false);
                        } else if(response.errors[0]=="The avatar field is required.") {
                            document.getElementById("imageError").style.display = "block";
                            setTimeout('$("#imageError").hide()', 6000);
                            $("#submit").prop('disabled', false);
                        }else if(response.errors[0]=="The position field is required.") {
                            document.getElementById("posError1").style.display = "block";
                            setTimeout('$("#posError1").hide()', 6000);
                            $("#submit").prop('disabled', false);
                        }
                    } else {
                        if(response.match){
                            $("#posError").css('display','block');
                            $("#submit").prop('disabled', false);
                            setTimeout(() => {
                            $("#posError").css('display','none');

                            }, 5000);
                        }else{
                            console.log(response.status);
                            window.location.reload();
                        }

                    }
                }
            })
        };

        function updateAd() {
            $("#update").prop('disabled', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ads.update') }}",
                method: "POST",
                data: new FormData(document.getElementById("adUpdate")),
                enctype: 'multipart/form-data',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    window.location.reload();


                }
            })
        };

    </script>
@endsection
@endsection
