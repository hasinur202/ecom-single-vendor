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
                            <a href="{{route('products')}}" style="padding: 10px;" class="btn btn-primary">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                style="margin-right: 5px;"></i>
                            </a>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Add Product
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">0/0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <hr>
        <section class="content">
            <div class="row">
                <div id="editproductAvatarInfo" class="card card-primary col-8 offset-2" style="padding-top: 8px;
                        border: 1px solid #ddd;
                        padding-bottom: 8px;
                        display: none;
                        height:258px;
                    ">
                    <div class="card-header" style="color: #fff;
                    background-color: #28a745;
                    border-color: #28a745;
                    box-shadow: none;">
                        <h3 class="card-title">Update Product Image</h3>
                        <button onclick="formClose()" class="close" aria-label="Close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="form-group" id="showAvatarForm">
                        <form id="update_avatar" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="text" id="slug" name="slug" hidden>
                            <div class="row col-12">
                                <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Front Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                        <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="front" type="file" class="form-control" name="front">
                                        <img src="" id="front-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;" />
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Back Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                        <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="back" type="file" class="form-control" name="back">
                                        <img src="" id="back-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;" />
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Left Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                        <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="left" type="file" class="form-control" name="left">
                                        <img src="" id="left-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;" />
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Right Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                        <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="right" type="file" class="form-control" name="right">
                                        <img src="" id="right-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;" />
                                    </div>
                                </div>
                            </div>
                            <button id="submitData" class="btn btn-success" style="width: 100%;"
                                type="submit">Submit</button>

                        </form>
                    </div>
                </div>
                <div id="product_table" class="card col-10 offset-1" style="border: 1px solid #ddd;display:block;">
                    <div class="card-header">
                        <h3 class="card-title">All Products is here</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc">
                                        Product Name
                                    </th>
                                    <th class="sorting_asc">
                                        Front Image
                                    </th>
                                    <th class="sorting_asc">
                                        Back Image
                                    </th>
                                    <th class="sorting_asc">
                                        Left Image
                                    </th>
                                    <th class="sorting_asc">
                                        Right Image
                                    </th>

                                    <th class="sorting">
                                        Status
                                    </th>
                                    <th class="sorting">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($avatars as $avtr)
                                    <tr role="row" class="odd">
                                        @if ($avtr->product_id == $avtr->get_product->id)

                                            <td class="sorting_1">{{ $avtr->get_product->product_name }}</td>
                                        @endif
                                        <td class="sorting_1">
                                            <img style="height: 50px;width: 120px;"
                                                src="{{ asset('/images/' . $avtr->front) }}" />
                                        </td>
                                        <td class="sorting_1">
                                            <img style="height: 50px;width: 120px;"
                                                src="{{ asset('/images/' . $avtr->back) }}" />
                                        </td>
                                        <td class="sorting_1">
                                            <img style="height: 50px;width: 120px;"
                                                src="{{ asset('/images/' . $avtr->left) }}" />
                                        </td>
                                        <td class="sorting_1">
                                            <img style="height: 50px;width: 120px;"
                                                src="{{ asset('/images/' . $avtr->right) }}" />
                                        </td>
                                        <td>
                                            @if ($avtr->status == 0)
                                                <p class="badge badge-warning">Inactive</p>
                                            @else
                                                <p class="badge badge-success">Active</p>
                                            @endif
                                        </td>
                                        <td style="display: inline-flex;">
                                            <button onclick="editProductAvatar({{ $avtr }})" style="margin-right: 5px;"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        @section('js')
            <script>
                $(function() {
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
            <script>
                function editProductAvatar(avtr) {

                    document.getElementById("editproductAvatarInfo").style.display = "block";
                    document.getElementById("product_table").style.display = "none";
                    $('#slug').val(avtr.slug);
                    document.getElementById("front-img").src = "{{ asset('/images/') }}/" + avtr.front;
                    document.getElementById("back-img").src = "{{ asset('/images/') }}/" + avtr.back;
                    document.getElementById("left-img").src = "{{ asset('/images/') }}/" + avtr.left;
                    document.getElementById("right-img").src = "{{ asset('/images/') }}/" + avtr.right;
                }

                function formClose() {
                    if (document.getElementById("editproductAvatarInfo"))
                        document.getElementById("editproductAvatarInfo").style.display = "none";
                    document.getElementById("product_table").style.display = "block";

                    $('#id').val();
                }



                function frontUrl(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#front-img').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                function backUrl(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#back-img').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                function leftUrl(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#left-img').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                function rightUrl(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#right-img').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("#front").change(function() {
                    frontUrl(this);
                });
                $("#back").change(function() {
                    backUrl(this);
                });
                $("#left").change(function() {
                    leftUrl(this);
                });
                $("#right").change(function() {
                    rightUrl(this);
                });


                $(document).ready(function() {


                    $('#update_avatar').on('submit', function(event) {
                        document.getElementById("submitData").disabled = true;
                        event.preventDefault();
                        $.ajax({
                            url: "{{ route('avatar.update') }}",
                            method: "POST",
                            data: new FormData(this),
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,

                            success: function(response) {
                                document.getElementById("editproductAvatarInfo").style.display = "none";
                                document.getElementById("product_table").style.display = "block";
                                window.location.reload();
                                swal("Successfull!", "Update successfully.", "success");
                            },
                            error: function() {
                                swal("Wrong input", {
                                    icon: "error"
                                });
                            }
                        })
                    });

                });

            </script>
        @endsection
    @endsection
