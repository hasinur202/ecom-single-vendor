@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-2">
                        <div id="disableDiv" style="width: 102%;
                            padding: 5px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <button class="btn btn-primary" onclick="addProduct()" style="padding: 10px;">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                    style="margin-right: 5px;"></i>
                            </button>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Add Product
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">0/0</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="disableDiv" style="width: 88%;
                            padding: 5px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <button class="btn btn-primary" onclick="addProductAvatar()" style="padding: 10px;">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                    style="margin-right: 5px;"></i>
                            </button>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Add Product Images
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">0/0</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="disableDiv" style="width: 100%;
                            padding: 5px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <a href="{{route('attributes')}}" class="btn btn-primary" style="padding: 10px;">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                    style="margin-right: 5px;"></i>
                            </a>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Add Product Attribute
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
                <div class="col-lg-12">
                <div id="addProductForm" class="card card-primary" style="padding-top: 8px;
                        border: 1px solid #ddd;
                        padding-bottom: 8px;
                        display: none;
                    ">
                    <div class="card-header" style="background-color: #007bff;
                        color: #fff;">
                        <h3 class="card-title">Add New Product Info</h3>
                        <button onclick="formClose()" class="close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="productInfo" style="display: none;">
                        @csrf
                        <div class="card-body row col-12">
                            <div class="row col-12">
                            <div class="form-group col-3">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Category</label>
                                <input id="cat" type="text" class="form-control"
                                placeholder="Enter category name" readonly required/>
                                <input type="hidden" id="get_category_id" name="category_id" value="">
                            </div>
                            <div class="form-group col-3">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">ChildCategory</label>
                                <input id="child" type="text" class="form-control"
                                placeholder="Enter child name" readonly required/>
                                <input type="hidden" id="get_child_category_id" name="child_category_id" value="">

                            </div>
                            <div class="form-group col-3">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Select Child ChildCategory</label>
                                <select onchange="subChildId()" class="form-control" name="sub_child_category_id" id="sub_child_category_id">
                                    <option value="" hidden selected="selected">select</option>
                                    @foreach ($sub_childs as $sub_child)
                                        <option value="{{ $sub_child->id }}">
                                            {{ $sub_child->sub_child_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Select Brand</label>
                                <select class="form-control" onclick="getId()" name="brand_id" id="brand_id">
                                    <option value="" selected="selected" hidden>select brand name</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="row col-12">
                                <div class="form-group col-3">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Product Name</label>
                                    <input id="product_name" name="product_name" type="text" class="form-control"
                                        placeholder="Enter product name" />
                                </div>
                                <div class="form-group col-3">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Product Code</label>
                                    <input id="product_code" name="product_code" type="text" class="form-control"
                                        placeholder="Enter product code" />
                                </div>
                                <div class="form-group col-3">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Color</label>
                                    <input id="color" name="color" type="text" class="form-control"
                                        placeholder="Enter product color" />
                                </div>
                                <div class="form-group col-3">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect"
                                        >E-Money</label
                                        >
                                    <input
                                        id="e_money"
                                        name="e_money"
                                        type="number"
                                        min="0" 
                                        step="any"
                                        class="form-control"
                                        placeholder="0.00%"
                                    />
                                </div>
                            </div>
                            <div class="form-group row col-12">
                                <div class="form-group col-6">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">
                                        In Dhaka Shipping Charge
                                    </label>
                                    <input
                                        id="indoor_charge"
                                        name="indoor_charge"
                                        type="number"
                                        min="0" 
                                        step="any"
                                        class="form-control"
                                        placeholder="indoor charge"
                                    />
                                </div>
                                <div class="form-group col-6">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">
                                        Out Dhaka Shipping Charge
                                    </label>
                                    <input
                                        id="outdoor_charge"
                                        name="outdoor_charge"
                                        type="number"
                                        min="0" 
                                        step="any"
                                        class="form-control"
                                        placeholder="outdoor charge"
                                    />
                                </div>
                            </div>
                            <div class="form-group row col-12">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Product Description</label>
                                <textarea id="description" name="description" type="text" class="form-control"
                                    placeholder="Enter product description"></textarea>
                            </div>
                        </div>
                        <button id="submit" type="submit" style="width: 100%" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                    <div id="productAvatarInfo" class="card-body row col-12" style="display: none;">

                        <div class="form-group">
                            <input type="text" id="single_error" name="single_error" readonly style="display:none;border: none;
                            width: 22%;
                            background-color: #f15353;
                            color: #fff;
                            font-size: 10px; margin-top:2px;">
                            <p id="stayImageWarning" style="background-color: rgb(241, 230, 83);
                            color: #000;
                            font-weight: 700;
                            width: 33%;
                            display:none;
                            padding: 5px;">This product images already uploaded.</p>
                            <form id="avatarUpload" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-12">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Select Product</label>
                                    <select class="form-control" onclick="getId()" name="prod_name" id="prod_name">
                                        <option value="" selected="selected" hidden>select product name</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input style="display:none;border: none;
                                    width: 22%;
                                    background-color: #f15353;
                                    color: #fff;
                                    font-size: 10px; margin-top:2px;" type="text" id="error" name="error" readonly>
                                <div class="row col-12" id="imgField">
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
                                            <img src="#" id="front-img" style="height: 100px;
                                          width: 100% !important;
                                          cursor: pointer;
                                          margin-top: -134px;" />
                                        </div>
                                        <input style="display:none;border: none;
                                            width: 75%;
                                            background-color:#f15353;;
                                            color: #fff;
                                            font-size: 10px;margin-top:2px;" type="text" id="frontError" name="frontError"
                                            readonly>
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
                                            <img src="#" id="back-img" style="height: 100px;
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
                                            <img src="#" id="left-img" style="height: 100px;
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
                                            <img src="#" id="right-img" style="height: 100px;
                                          width: 100% !important;
                                          cursor: pointer;
                                          margin-top: -134px;" />
                                        </div>
                                    </div>
                                </div>
                                <button id="submitData" class="btn btn-primary" style="width: 100%;"
                                    type="submit">Submit</button>

                            </form>
                        </div>

                    </div>

                </div>
                <div id="editProductForm" class="card card-primary col-8 offset-2" style="padding-top: 8px;
                        border: 1px solid #ddd;
                        padding-bottom: 8px;
                        display: none;
                    ">
                    <div class="card-header" style="color: #fff;
                    background-color: #28a745;
                    border-color: #28a745;
                    box-shadow: none;">
                        <h3 class="card-title">Update Product</h3>
                        <a href="#" onclick="closeForm()" class="close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <form role="form" id="contact-form" action="#" method="POST">
                        @csrf
                        <div class="card-body">
                            <input type="text" id="id" name="id" hidden>
                            <div class="form-group">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Select SubCategory</label>
                                <select class="form-control" name="edit_child_category_id" id="edit_child_category_id">
                                    {{-- @foreach ($childs as $sub_cat)
                                        <option selected="selected" value="{{ $sub_cat->id }}">
                                            {{ $sub_cat->child_name }}
                                        </option>
                                    @endforeach --}}
                                </select>

                            </div>
                            <div class="form-group">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Sub SubCategory Name</label>
                                <input required id="edit_sub_child_name" name="edit_sub_child_name" type="text"
                                    class="form-control" placeholder="Enter sub sub-category name" />
                            </div>
                        </div>
                        <button type="submit" style="width: 100%" class="btn btn-success">
                            Submit
                        </button>
                    </form>
                </div>
                <div id="product_table" class="card col-12" style="border: 1px solid #ddd;display:block;">
                    <div class="card-header">
                        <h3 class="card-title">All Products is here</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>Product Name</th>
                                    <th>
                                        Brand Name
                                    </th>
                                    <th>
                                        Product Code
                                    </th>
                                    <th>
                                        Color
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="countRow">
                                @include('layouts.backend.product.product_tbl')
                            </tbody>
                        </table>
                    </div>
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
        function productStatus(id){
            $.ajax({
                url: "{{ route('product.status') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    window.location.reload();

                }
            })
        }

        function subChildId(){
            $.ajax({
                url: "{{ route('get.cat.subCat') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $('#sub_child_category_id option:selected').val() ? $('#sub_child_category_id option:selected').val() : ''
                },
                success: function(response) {
                    $('#cat').val(response.datas.get_child_category.get_category.cat_name);
                    $('#child').val(response.datas.get_child_category.child_name);
                    $('#get_category_id').val(response.datas.category_id);
                    $('#get_child_category_id').val(response.datas.child_category_id);

                }
            })
        }

        function getData() {
            var countDownDate = new Date(document.getElementById("date").value + " " + document.getElementById("time")
                .value).getTime();

            document.getElementById("dateTime").value = countDownDate;
        }

        function getId() {

            $.ajax({
                url: "{{ route('avatars') }}",
                method: "get",
                dataType: 'JSON',
                success: function(response) {
                    response.data.forEach(element => {

                        if (element.product_id == $("#prod_name").val()) {
                            $("#imgField").hide();
                            $("#submitData").hide();
                            setTimeout(() => {
                                $("#stayImageWarning").show();

                            }, 100);
                        } else {
                            $("#imgField").show();
                            $("#submitData").show();
                            $("#stayImageWarning").hide();
                        }
                    });

                }
            })
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

            $('#avatarUpload').on('submit', function(event) {
                event.preventDefault();
                document.getElementById("submitData").disabled = true;
                $.ajax({
                    url: "{{ route('avatar.upload') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {

                        document.getElementById("product_table").style.display = "block";
                        document.getElementById("addProductForm").style.display = "none";
                        Toast.fire({
                            icon: 'success',
                            title: 'Product image successfully'
                        });

                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                })
            });

        });

        function formClose() {
            document.getElementById("addProductForm").style.display = "none";
            document.getElementById("product_table").style.display = "block";
        }

        function editProduct() {
            document.getElementById("addProductForm").style.display = "none";
            document.getElementById("editProductForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("editProductForm").style.display = "none";
            document.getElementById("addProductForm").style.display = "block";
        }

        function addProduct() {
            document.getElementById("addProductForm").style.display = "block";
            document.getElementById("product_table").style.display = "none";
            document.getElementById("productInfo").style.display = "block";
            document.getElementById("productAvatarInfo").style.display = "none";
        }

        function addProductAvatar() {
            document.getElementById("addProductForm").style.display = "block";
            document.getElementById("product_table").style.display = "none";
            document.getElementById("productInfo").style.display = "none";
            document.getElementById("productAvatarInfo").style.display = "block";
        }

        $(document).ready(function() {
            $("#productInfo").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('product.add') }}",
                    method: "post",
                    data:new FormData(this),
                    dataType: 'html',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        window.location.reload();
                        Toast.fire({
                            icon: 'success',
                            title: 'Product upload successfully'
                        });
                        document.getElementById("product_table").style.display = "block";
                        document.getElementById("addProductForm").style.display = "none";
                        $("#countRow").html(response);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                })

            })
        })

    </script>
@endsection
@endsection
