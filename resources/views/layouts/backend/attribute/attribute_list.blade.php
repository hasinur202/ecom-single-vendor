@extends('layouts.backend.app')
@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <div class="container-fluid" style="margin-left: 4.5rem;">
        <div class="row mb-2">
            <div class="col-sm-3" style="max-width: 23% !important;">
                <div style="width: 100%;
                    padding: 5px;
                    background-color: white;
                    border: 1px solid #ddd;
                    box-shadow: 1px 1px #ddd;
                    border-radius: 5px;display: inline-flex;">
                    <button class="btn btn-primary" onclick="addAttrVal()" style="padding: 10px;">
                        <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                            style="margin-right: 5px;"></i>
                    </button>
                    <p style="margin-left: 5px;
                    font-weight: 700;
                    margin-bottom: 0px;">Add Product Attribute
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
                  <a href="{{route('products')}}" style="padding: 10px;" class="btn btn-primary">
                      <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fas fa-undo"
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
    <section class="content">
        <div class="row">
            <div id="addAttrVal" class="card card-primary col-12" style="
                    padding-top: 8px;
                    display: none;
                ">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Add Product Attribute</h3>
                  <button
                    type="button"
                    class="close"
                    onclick="closeAttrForm()"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
              <form method="POST" action="{{route('store.attribute')}}">
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                        >Select Product</label
                      >
                      <select
                        id="product_id"
                        name="product_id"
                        style="width:100%;"
                        class="custom-select mr-sm-2"
                      >
                        <option value="" selected="selected" hidden>select</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                      </select>
                    </div>
                      <div class="field_wrapper">
                        <div style="margin-bottom: 5px;">
                            <input id="size" style="width: 16%" placeholder="size" name="size[]" type="text" name="size[]" value=""/>
                            <input id="sale_price" style="width: 16%" placeholder="sales price" type="text" name="sale_price[]" value=""/>
                            <input id="pur_price" style="width: 16%" placeholder="purchase price" type="text" name="pur_price[]" value=""/>
                            <input id="promo_price" style="width: 16%" placeholder="promo price" type="text" name="promo_price[]" value=""/>
                            <input id="discount" style="width: 16%" placeholder="discount %" type="text" name="discount[]" value=""/>
                            <input id="qty" style="width: 16%" placeholder="qty" type="text" name="qty[]" value=""/>
                            <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                  </div>
                  <button
                    style="width: 100%;margin-bottom: 8px;"
                    type="submit"
                    class="btn btn-primary"
                  >
                    Submit
                  </button>
                </form>
            </div>
            <div id="editRole" class="card card-primary col-4" style="margin-left: 15px;
                    padding-top: 8px;
                    height: 308px;
                    display: none;
                ">
                <div class="card-header" style="color: #fff;
                background-color: #28a745;
                border-color: #28a745;
                box-shadow: none;">
                  <h3 class="card-title">Update Attribute Name</h3>
                  <a
                    href="#"
                    onclick="closeForm()"
                    class="close"
                    >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </a>
                </div>
              <form role="form">
                  <input type="hidden" id="slug" value="">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Name</label
                        >
                      <input
                        id="editName"
                        name="editName"
                        type="text"
                        class="form-control"
                        placeholder="Enter attribute name"
                      />
                    </div>
                    {{-- <div class="form-row align-items-center">
                        <div class="col-auto my-1" style="width:100%">
                          <label class="mr-sm-2" for="inlineFormCustomSelect"
                            >Select Attribute Value</label
                          >
                          <select
                            id="value"
                            style="width:100%;"
                            class="custom-select mr-sm-2"
                          >
                            <option value="" selected="selected" hidden>select</option>
                            @foreach ($attribute_values as $attr)
                                <option value="{{$attr->value}}">{{$attr->value}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div> --}}
                  </div>
                  <button
                    onclick="updateAttribute()"
                    style="width: 100%"
                    class="btn btn-success"
                  >
                    Submit
                  </button>
                </form>
            </div>
            <div class="card col-10 offset-1">
                <div class="card-header">
                <h3 class="card-title">Products Attributes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr role="row">
                        <th style="width: 166px;">Product Name</th>
                        <th style="width: 166px;">Size</th>
                        <th style="width: 166px;">Purchase Price</th>
                        <th style="width: 166px;">Sales Price</th>
                        <th style="width: 166px;">Promo Price</th>
                        <th style="width: 166px;">Discount</th>
                        <th style="width: 166px;">Stock</th>
                        <th style="width: 99px;">Action</th>
                    </tr>
                    </thead>
                    <tbody id="attrValues">
                      @include('layouts.backend.attribute.attribute_tbl')
                    </tbody>
                </table>
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
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
      <script>

        function showId(id) {
          $('#size_n'+id).hide();
          $('#size_e'+id).show();
          $('#sale_n'+id).hide();
          $('#sale_e'+id).show();
          $('#pur_n'+id).hide();
          $('#pur_e'+id).show();
          $('#promo_n'+id).hide();
          $('#promo_e'+id).show();
          $('#dis_n'+id).hide();
          $('#dis_e'+id).show();
          $('#stock_n'+id).hide();
          $('#stock_e'+id).show();
          $('#btn_n'+id).hide();
          $('#btn_d_n'+id).hide();
          $('#btn_e'+id).show();
          $('#btn_d_e'+id).show();
        }



        function closeEdit(id){
          $('#size_n'+id).show();
          $('#size_e'+id).hide();
          $('#sale_n'+id).show();
          $('#sale_e'+id).hide();
          $('#pur_n'+id).show();
          $('#pur_e'+id).hide();
          $('#promo_n'+id).show();
          $('#promo_e'+id).hide();
          $('#dis_n'+id).show();
          $('#dis_e'+id).hide();
          $('#stock_n'+id).show();
          $('#stock_e'+id).hide();
          $('#btn_n'+id).show();
          $('#btn_d_n'+id).show();
          $('#btn_e'+id).hide();
          $('#btn_d_e'+id).hide();
        }

        function addAttrVal(){
            document.getElementById("addAttrVal").style.display = "block";
        }

        function closeAttrForm(){
          $("#addAttrVal").hide();
        }

        function updateAttribute(id){

            $.ajax({
                url: "{{ route('update.attribute') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                    "size": $('#size_e'+id).val(),
                    "pur_price": $('#pur_e'+id).val(),
                    "sale_price": $('#sale_e'+id).val(),
                    "promo_price": $('#promo_e'+id).val(),
                    "discount": $('#dis_e'+id).val(),
                    "qty": $('#stock_e'+id).val()
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
        }
      </script>
      <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div style="margin-bottom: 5px;"><input id="size" placeholder="size" style="width: 16%;margin-right: 4px;" type="text" name="size[]" value=""/><input id="sale_price" style="width: 16%;margin-right: 3px;" placeholder="sales price" type="text" name="sale_price[]" value=""/><input id="pur_price" style="width: 16%;margin-right: 3px;" placeholder="purchase price" type="text" name="pur_price[]" value=""/><input id="promo_price" style="width: 16%;margin-right: 3px;" placeholder="promo price" type="text" name="promo_price[]" value=""/><input id="discount" style="width: 16%;" placeholder="discount %" type="text" name="discount[]" value=""/><input id="qty" style="width: 16%;" placeholder="qty" type="text" name="qty[]" value=""/><a href="javascript:void(0);" class="remove_button"><i style="margin-left: 5px;" class="fa fa-minus"/></a></div>';
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
        </script>
    @endsection
@endsection
