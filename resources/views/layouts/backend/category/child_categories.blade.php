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
                <a href="{{ route('sub.child.category') }}" style="padding: 10px;" class="btn btn-primary">
                    <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                    style="margin-right: 5px;"></i>
                </a>
                <p style="margin-left: 5px;
                font-weight: 700;
                margin-bottom: 0px;">Sub-Category
                    <span style="float: left;
                margin-left: 15px;" class="badge badge-warning">0/0</span>
                </p>
            </div>
          </div>
      </div>
    </section>
    <section class="content">
        <div class="row">
            <div id="addChildCat" class="card card-primary col-4" style="margin-left: 15px;
                    padding-top: 8px;
                    height: 315px;
                    display: block;
                ">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Add New Child-Category</h3>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
              <form role="form" id="contact-form-add">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Select Category</label
                        >
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="" selected="selected" hidden>select category</option>
                            @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->cat_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Child Category Name</label
                        >
                      <input
                        id="child_name"
                        name="child_name"
                        type="text"
                        class="form-control"
                        placeholder="Enter sub category name"
                      />
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
            <div id="editChildCat" class="card card-primary col-4" style="margin-left: 15px;
                    padding-top: 8px;
                    height: 315px;
                    display: none;
                ">
                <div class="card-header" style="color: #fff;
                background-color: #28a745;
                border-color: #28a745;
                box-shadow: none;">
                  <h3 class="card-title">Update Child-Category</h3>
                  <a
                    href="#"
                    onclick="closeForm()"
                    class="close"
                    >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </a>
                </div>
              <form role="form" id="contact-form" action="{{ route('update.child') }}" method="POST">
                  @csrf
                  <div class="card-body">
                      <input type="text" id="id" name="id" hidden>
                    <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Select Category</label
                        >
                        <select class="form-control" name="edit_category_id" id="edit_category_id">
                            @foreach ($cats as $cat)
                            <option selected="selected" value="{{ $cat->id }}">
                                {{ $cat->cat_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Child Category Name</label
                        >
                      <input
                        required
                        id="edit_child_name"
                        name="edit_child_name"
                        type="text"
                        class="form-control"
                        placeholder="Enter sub category name"
                      />
                    </div>
                  </div>
                  <button
                    type="submit"
                    style="width: 100%"
                    class="btn btn-success"
                  >
                    Submit
                  </button>
                </form>
            </div>
            <div class="card col-7" style="margin-left: 70px;">
                <div class="card-header">
                <h3 class="card-title">All Child Categories is here</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" style="width: 166px;">
                            Category
                        </th>
                        <th class="sorting_asc" style="width: 166px;">
                            Child-Category
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
                        @foreach ($childs as $child)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{ $child->get_category->cat_name }}</td>
                                <td class="sorting_1">{{ $child->child_name }}</td>
                                <td>
                                    @if($child->status == 0)
                                    <p class="badge badge-warning">Inactive</p>
                                    @else
                                    <p class="badge badge-success">Active</p>
                                    @endif
                                </td>
                                <td style="display: inline-flex;">
                                    <button onclick="editSubCat({{ $child }})" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    {{-- <form action="{{ route('delete.child',$child->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form> --}}
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
      <script>

        function editSubCat(child){
          if(document.getElementById("addChildCat"))
          document.getElementById("addChildCat").style.display = "none";
          document.getElementById("editChildCat").style.display = "block";
          $('#edit_category_id').val(child.get_category.id);
          $('#edit_child_name').val(child.child_name);
          $('#id').val(child.id);
        }
        function closeForm(){
          if( document.getElementById("editChildCat"))
          document.getElementById("editChildCat").style.display = "none";
          document.getElementById("addChildCat").style.display = "block";
        //   $('#edit_cat_name').val();
        }

        $("#contact-form-add").submit(function(event){
          event.preventDefault();

          $.ajax({
              url: "{{ route('child.add') }}",
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
                      title: 'Child Category Uploaded Successfully'
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
        })
      </script>
    @endsection
@endsection
