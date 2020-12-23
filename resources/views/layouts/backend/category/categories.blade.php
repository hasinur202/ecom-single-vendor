@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <div id="disableDiv" style="width: 70%;
                            padding: 5px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <a href="{{ route('child.category') }}" style="padding: 10px;" class="btn btn-primary">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                style="margin-right: 5px;"></i>
                            </a>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Child Category
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">0/0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
     
        <section class="content">
            <div class="row">
                <div id="addCat" class="card card-primary col-4" style="margin-left: 15px;
                        padding-top: 8px;
                        height: 382px;
                        display: block;
                    ">
                    <div class="card-header" id="cardHeader" style="background-color: #007bff;
                    color: #fff;">
                        <h3 class="card-title" id="cardTitle-add">Add New Category</h3>
                        <h3 class="card-title" style="display: none;" id="cardTitle-update">Update Category</h3>
                        <button type="button" onclick="closeForm()" class="close" aria-label="Close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" id="addCate">
                        @csrf
                        <img style="display: none;
                        position: absolute;
                        z-index: 9999;
                        background-color: #fff;
                        opacity: .8;
                        height: 318px;
                        width: 351px;" id="loading" src="{{ asset('/images/loader1.gif') }}" alt="">

                        <div class="card-body" style="position: relative">
                            <input type="text" id="id" name="id" hidden>
                            <div class="form-group">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Category Name</label>
                                <input id="cat_name" name="cat_name" type="text" class="form-control"
                                    placeholder="Enter category name" />
                                <p id="catError" style="display: none;background-color: #e68888;
                                color: #fff;
                                margin-top: 2px;
                                font-size: 12px;
                                width: 56%;">Category field is required.</p>
                                <p id="uniqueError" style="display: none;background-color: #e68888;
                                color: #fff;
                                margin-top: 2px;
                                font-size: 12px;
                                width: 64%;">Category name has already been taken.</p>

                            </div>
                            <div class="form-group">
                              <label for="image" class="col-form-label">Cover Photo</label>
                              <div style="height: 100px;
                                  border: dashed 1.5px blue;
                                  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                  width: 100% !important;
                                  cursor: pointer;">
                                  <input style="opacity: 0;
                                    height: 100px;
                                    cursor: pointer;
                                    padding: 0px;" id="cover" type="file" class="form-control" name="cover">
                                  <img src="" id="cover-img" style="height: 100px;
                                    width: 100% !important;
                                    cursor: pointer;margin-top: -134px;" />
                              </div>
                              <p id="coverError" style="display: none;background-color: #e68888;
                              color: #fff;
                              margin-top: 2px;
                              font-size: 12px;
                              width: 56%;">Image field is required.</p>
                            </div>
                        </div>
                        
                    </form>
                    <button id="submit" style="width: 100%" onclick="addCategory()" class="btn btn-primary">
                        Submit
                    </button>

                    <button id="update" style="width: 100%;display:none;" onclick="updateCategory()" class="btn btn-success">
                      Submit
                    </button>
                </div>

                <div class="card col-7" style="margin-left: 70px;">
                    <div class="card-header">
                        <h3 class="card-title">All Categories is here</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" style="width: 166px;">
                                        Category Name
                                    </th>
                                    <th class="sorting_asc" style="width: 166px;">
                                        Category Cover
                                    </th>
                                    <th class="sorting" style="width: 204px;">
                                        Explor
                                    </th>
                                    <th class="sorting" style="width: 204px;">
                                        Status
                                    </th>
                                    <th class="sorting" style="width: 99px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    @if ($cat->status == 1)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $cat->cat_name }}</td>
                                            <td class="sorting_1">
                                            <img style="width: 100%;
                                            height: 39px;" src="{{ asset('/images/' . $cat->cover) }}" alt="">
                                            </td>
                                            <td>
                                                @if ($cat->explor == 0)
                                                <p style="cursor: pointer;" onclick="active({{$cat->id}})" class="badge badge-warning">Inactive</p>
                                                @else
                                                <p style="cursor: pointer;" onclick="inactive({{$cat->id}})" class="badge badge-info">Active</p>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="badge badge-success">Active</p>
                                            </td>
                                            <td style="display: inline-flex;">
                                                <button style="margin-right: 5px;" href="#"
                                                    class="btn btn-primary" onclick="editCat({{ $cat }})">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" onclick="deleteCat({{ $cat }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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

        function editCat(cat) {
            $("#cover-img").attr('src', "{{ asset('/images/') }}/" + cat.cover);
            document.getElementById("addCat").style.display = "block";
            $("#addCate").attr('id', 'updateCategory');
            $("#submit").hide();
            $("#update").show();
            $("#cardTitle-update").show();
            $("#cardTitle-add").hide();
            $("#cardHeader").css({
                'color': '#fff',
                'background-color': '#28a745',
                'border-color': '#28a745',
                'box-shadow': 'none',
            });
            $('#id').val(cat.id);
            $('#cat_name').val(cat.cat_name);
            $('#explor').val(cat.explor);
        }

        function closeForm() {
            $("#cardHeader").css({
                'color': '#fff',
                'background-color': '#007bff',
                'border-color': '#28a745',
                'box-shadow': 'none',
            });
            $("#cover-img").attr('src', "#");
            document.getElementById("addCat").style.display = "block";
            $('#id').val();
            $('#explor').val();
            $("#updateCategory").attr('id', 'addCate');
            $("#update").hide();
            $("#submit").show();
            $("#cardTitle-add").show();
            $("#cardTitle-update").hide();
        }

        function coverUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#cover-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#cover").change(function() {
            coverUrl(this);
        });

        function addCategory() {
            $("#loading").show();

            $.ajax({
                url: "{{ route('category.add') }}",
                method: "POST",
                data: new FormData(document.getElementById("addCate")),
                enctype: 'multipart/form-data',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    window.location.reload();
                    $("#loading").hide();
                    Toast.fire({
                        icon: 'success',
                        title: 'Category created successfull'
                    })
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Wrong data entry.'
                    })
                }
            })
        };

        function updateCategory() {
            $("#update").prop('disabled', true);
            $.ajax({
                url: "{{ route('category.update') }}",
                method: "POST",
                data: new FormData(document.getElementById("updateCategory")),
                enctype: 'multipart/form-data',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        if (response.errors[0]) {
                          document.getElementById("catError").style.display = "block";
                          setTimeout('$("#catError").hide()', 6000);
                          $("#update").prop('disabled', false);
                        }
                    } else {

                        window.location.reload();
                        swal("Successfull!", "Update successfully.", "success");
                    }

                },
                error: function() {
                    swal("Wrong data", {
                        icon: "error"
                    });
                }
            })
        };

        function deleteCat(cat) {
            id = cat.id;
            status = cat.status;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('category.delete') }}",
                type: "POST",
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }

        function active(id){
            $.ajax({
                url: "{{ route('category.active') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    window.location.reload();
                    Toast.fire({
                        icon:'success',
                        title:'Category explore successfull.'
                    });
                }
            });
        }

        function inactive(id){
            $.ajax({
                url: "{{ route('category.inactive') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    window.location.reload();
                    Toast.fire({
                        icon:'success',
                        title:'Category inactive successfull.'
                    });
                }
            });
        }

    </script>
@endsection
@endsection
