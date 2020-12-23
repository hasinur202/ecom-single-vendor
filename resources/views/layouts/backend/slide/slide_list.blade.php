
@extends('layouts.backend.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid offset-1">
                <div class="row mb-2">

                    <h1>Banner</h1>

                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="card col-10 offset-1">
                    <div class="card-header">
                        <h3 class="card-title">Banar List</h3>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#bannerAddModal" style="float: right;">
                                <i class="fa fa-plus"></i> Add Banner
                            </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI #</th>
                                    <th>Banner</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banars as $banar)
                                    <tr>
                                        <td>{{ $banar->id }}</td>
                                        <td>
                                            <img style="height: 50px;width: 120px;" src="{{ asset('/images/' . $banar->image) }}" />
                                        </td>
                                        <td>

                                            {{ $banar->product_name }}

                                        </td>

                                        <td style="display:inline-flex;">

                                            <button onclick="editBanar({{ $banar }})" data-toggle="modal" data-target="#bannerEditModal" style="margin-right: 5px;"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>


                                            <button class="btn btn-danger btn-sm" onclick="deleteBanar({{ $banar }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>


            <div class="modal fade" id="bannerAddModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">Add Banner</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                        <form id="banarUpload">
                            @csrf
                            <div class="col-md-6 offset-3">

                                <div class="form-group">
                                    <label for="banner-product" class="col-form-label">Product Name</label>
                                    <select class="select2 form-control" name="product_name" style="width: 100%">
                                        <option value="" selected="selected" hidden>Select product name</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6 offset-3">
                                <div class="form-group">
                                    <label for="image" class="col-form-label">Banar Image</label>
                                    <div style="height: 9.5rem; border: dashed 1.5px blue;
                                            background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                            width: 100% !important; cursor: pointer;">
                                        <input id="image" type="file" class="form-control" name="image" style="opacity: 0; height: 9.5rem; cursor: pointer; padding: 0px;">
                                        <img src="" id="image-img" style="height: 9.5rem; width: 100% !important; cursor: pointer;margin-top: -184px;" />
                                    </div>
                                    <input style="display:none;border: none; width: 75%; background-color:#f15353; color: #fff;
                                  font-size: 10px;margin-top:2px;" type="text" id="imageError" name="imageError" readonly>
                                </div>

                            </div>
                        </form>
                        <div class="modal-footer col-md-6 offset-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button onclick="uploadBanar()" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<div class="modal fade" id="bannerEditModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addNewLabel">Update Banner</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form id="banarUpdate">
                @csrf
                <input type="text" id="slug" name="slug" hidden>

                <div class="col-md-6 offset-3">

                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="product_name" class="select2 form-control" data-placeholder="Select a State" style="width: 100%;">
                        @foreach ($products as $product)
                          <option value="{{ $product->product_name }}"
                            @foreach ($banars as $banar)
                              @if ($banar->product_name == $product->product_name)

                              selected

                              @endif
                            @endforeach
                          >{{ $product->product_name }}
                        </option>
                        @endforeach
                        </select>
                      </div>

                </div>

                <div class="col-md-6 offset-3">
                    <div class="form-group">
                        <label for="image" class="col-form-label">Banar Image</label>
                        <div style="height: 9.5rem; border: dashed 1.5px blue;
                                background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                width: 100% !important; cursor: pointer;">
                            <input id="editImage" type="file" class="form-control" name="image" style="opacity: 0; height: 9.5rem; cursor: pointer; padding: 0px;">
                            <img src="" id="image-edit" style="height: 9.5rem; width: 100% !important; cursor: pointer;margin-top: -184px;" />
                        </div>
                        <input style="display:none;border: none; width: 75%; background-color:#f15353; color: #fff;
                      font-size: 10px;margin-top:2px;" type="text" id="imageError" name="imageError" readonly>
                    </div>

                </div>
            </form>
            <div class="modal-footer col-md-6" style="float: right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="updateBanar()" class="btn btn-primary">Update</button>
            </div>
        </div>

    </div>
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
    //Initialize Select2 Elements
    $('.select2').select2({
        'height':'38px',
    });
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    });
</script>

<script type="text/javascript">
    function editBanar(banar) {
        $("#slug").val(banar.image);
        $("#product_id").val(banar.product_name);

        $("#image-edit").attr('src', "{{ asset('/images/') }}/" + banar.image);
    }

    function uploadBanar() {
        $.ajax({
            url: "{{ route('banar.upload') }}",
            method: "POST",
            data: new FormData(document.getElementById("banarUpload")),
            enctype: 'multipart/form-data',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                
                window.location.reload();
                Toast.fire({
                    icon: 'success',
                    title: 'Upload successfull'
                })
                
            },
             error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Fill up all field with unique data.'
                })
            }
        })
    };


    function updateBanar() {
        $.ajax({
            url: "{{ route('banar.update') }}",
            method: "POST",
            data: new FormData(document.getElementById("banarUpdate")),
            enctype: 'multipart/form-data',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                
                window.location.reload();
                Toast.fire({
                    icon: 'success',
                    title: 'Upload successfull'
                })
                
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Fill up all field with unique data.'
                })
            }
        })
    };

    function deleteBanar(banar) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        id = banar.id;
        image = banar.image;

        $.ajax({
            url: "{{ route('banar.delete') }}",
            type: "POST",
            data: {
                id: id,
                image: image,
            },
            success: function(response) {
                window.location.reload();
                Toast.fire({
                    icon: 'success',
                    title: 'Delete successfull'
                })
            }
        });
    }


    function imageUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function urlImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-edit').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        imageUrl(this);
    });
    $("#editImage").change(function() {
        urlImage(this);
    });

</script>

@endsection
@endsection
