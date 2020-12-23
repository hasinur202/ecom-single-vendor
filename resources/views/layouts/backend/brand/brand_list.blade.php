
@extends('layouts.backend.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row col-8 offset-2">
                    <div class="col-sm-3" style="margin-left: -20px !important;">
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
            </div>
        </section>
        <section class="content">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Brand List</h3>
                        <button data-toggle="modal" data-target="#addModal" class="btn btn-primary" style="float: right;">
                            <i style="padding-right: 5px;" class="fas fa-plus"></i>Add Brand
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI #</th>
                                    <th>Brand Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>
                                            <p id="brand_n{{$brand->id}}">{{ $brand->brand_name }}</p>
                                            <input id="brand_e{{$brand->id}}" type="text" style="display: none; width:100px" value="{{ $brand->brand_name }}">
                                        </td>
                                        <td>
                                            <p id="des_n{{$brand->id}}">{{ $brand->br_description }}</p>
                                            <textarea name="" id="des_e{{$brand->id}}" cols="30" style="display: none; width: 200px;
                                                height: 50px;" rows="10">{{ $brand->br_description }}</textarea>

                                        </td>
                                        <td>
                                            <button id="edit_btn_n{{ $brand->id }}" onclick="editBrand({{ $brand->id }})" style="margin-right: 5px;"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button id="submit_btn_e{{ $brand->id }}" onclick="updateBrand({{ $brand->id }})" style="margin-right: 5px;display:none;"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button id="undo_btn_e{{ $brand->id }}" onclick="closeBrand({{ $brand->id }})" style="margin-right: 5px;display:none;"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-undo"></i>
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


        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNewLabel">Add Banner</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="brandInfo" role="form" action="{{ route('brand.add') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Brand Name</label>
                                    <input name="brand_name" type="text" class="form-control"
                                        placeholder="Brand name"/>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Brand Description</label>
                                <textarea name="br_description" type="text"
                                class="form-control" placeholder="Enter brand description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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

    function editBrand(id) {
         $("#brand_n"+id).hide();
         $("#brand_e"+id).show();
         $("#des_n"+id).hide();
         $("#des_e"+id).show();
         $("#edit_btn_n"+id).hide();
         $("#submit_btn_e"+id).show();
         $("#undo_btn_e"+id).show();
    }

    function closeBrand(id){
        $("#brand_n"+id).show();
         $("#brand_e"+id).hide();
         $("#des_n"+id).show();
         $("#des_e"+id).hide();
         $("#edit_btn_n"+id).show();
         $("#submit_btn_e"+id).hide();
         $("#undo_btn_e"+id).hide();
    }


    function updateBrand(id) {
        $.ajax({
            url: "{{ route('brand.update') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id,
                'brand_name':$("#brand_e"+id).val(),
                'description':$("#des_e"+id).val()
            },
            success: function(response) {
                window.location.reload();
                Toast.fire({
                    icon: 'success',
                    title: 'Attribute successfully'
                });
            },
            error:function(){
                Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!'
                  })
            }
        })
    };


</script>

@endsection
@endsection
