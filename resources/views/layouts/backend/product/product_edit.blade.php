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
                    <a href="{{route('products')}}" class="btn btn-primary" style="padding: 10px;">
                        <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fas fa-undo"></i>
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
    </section>
    <section class="content">
        <div class="row">
            <div class="card card-primary col-10 offset-1" style="padding-top: 8px;
                    border: 1px solid #ddd;
                    padding-bottom: 8px;
                ">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Update Product Info</h3>
                  <button
                    class="close"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
            <div class="card-body">
            <form action="{{route('product.update',$product->slug)}}" method="POST">
                @csrf
                <div class="card-body row">
                    <div class="row col-12">
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Category</label>
                            <input id="cat" type="text" value="{{$product->get_category->cat_name}}" class="form-control"
                            placeholder="Enter category name" readonly required/>
                            <input type="hidden" id="get_category_id" name="category_id" value="{{$product->get_category->id}}">
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">ChildCategory</label>
                            <input value="{{$product->get_child_category->child_name}}" id="child" type="text" class="form-control"
                            placeholder="Enter child name" readonly required/>
                            <input type="hidden" id="get_child_category_id" name="child_category_id" value="{{$product->get_child_category->id}}">

                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Child ChildCategory</label>
                            <select onchange="subChildId()" class="form-control" name="sub_child_category_id" id="sub_child_category_id">
                                <option value="{{$product->get_child_child_category->id}}" hidden selected="selected">{{$product->get_child_child_category->sub_child_name}}</option>
                                @foreach ($sub_child_categories as $sub_child)
                                    <option value="{{ $sub_child->id }}">
                                        {{ $sub_child->sub_child_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Select Brand</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                                <option value="{{$product->get_brand->id}}" selected="selected" hidden>{{$product->get_brand->brand_name}}</option>
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
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Product Name</label
                                >
                            <input
                                value="{{$product->product_name}}"
                                id="product_name"
                                name="product_name"
                                type="text"
                                class="form-control"
                                placeholder="Enter product name"
                            />
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Product Code</label
                                >
                            <input
                                value="{{$product->product_code}}"
                                id="product_code"
                                name="product_code"
                                type="text"
                                class="form-control"
                                placeholder="Enter product code"
                            />
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Product Color</label
                                >
                                <input
                                value="{{$product->color}}"
                                id="color"
                                name="color"
                                type="text"
                                class="form-control"
                                placeholder="Enter product color"
                            />
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                            >Select Position</label
                            >
                            <select class="form-control" name="position" id="position">
                                <option value="flash sale">flash sale</option>
                                <option value="upcoming product">upcoming product</option>
                                <option value="just for you">just for you</option>
                                <option value="own mall">own mall</option>
                                <option value="global product">global product</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        
                        <div class="form-group col-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">
                                Indoor Shipping Charge
                            </label>
                            <input
                                value="{{$product->indoor_charge}}"
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
                                Outdoor Shipping Charge
                            </label>
                            <input
                                value="{{$product->outdoor_charge}}"
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
                        <div class="col-12">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                            >Product Description</label
                            >
                            <textarea
                            id="description"
                            name="description"
                            type="text"
                            class="form-control"
                            placeholder="Enter product description"
                            >{{$product->description}}</textarea>
                        </div>
                    </div>
                 </div>
                    <button
                        id="submit"
                        type="submit"
                        style="width: 100%"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>
                </form>
            </div>

            </div>
            
           
        </div>
        </div>
    @section('js')
        <script>
            
        </script>
    @endsection
@endsection
