@extends('layouts.backend.app')
@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <hr>
    <section class="content">
        <div class="row">
            <div id="addRole" class="card card-primary col-4" style="margin-left: 15px;
                    padding-top: 8px;
                    height: 308px;
                    display: block;
                ">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Add New User Role</h3>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
              <form role="form" id="contact-form" action="{{route('store.role')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Name</label
                        >
                      <input
                        id="name"
                        name="name"
                        type="text"
                        class="form-control"
                        placeholder="Enter user name"
                      />
                    </div>
                    <div class="form-row align-items-center">
                      <div class="col-auto my-1" style="width:100%">
                        <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Select Role</label
                        >
                        <select
                          style="width:100%;"
                          name="role"
                          class="custom-select mr-sm-2"
                        >
                          <option value="super_admin" selected="selected">super_admin</option>
                          <option value="admin">admin</option>
                          <option value="vendor">vendor</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button
                    id="submit"
                    style="width: 100%"
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
                  <h3 class="card-title">Update User Role</h3>
                  <a
                    href="#"
                    onclick="closeForm()"
                    class="close"
                    >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </a>
                </div>
              <form role="form" id="contact-form" action="{{route('update.role')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Name</label
                        >
                      <input
                        readonly
                        id="editName"
                        name="editName"
                        type="text"
                        class="form-control"
                        placeholder="Enter user name"
                      />
                    </div>
                    <div class="form-row align-items-center">
                      <div class="col-auto my-1" style="width:100%">
                        <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Select Role</label
                        >
                        <select
                          id="editRole"
                          style="width:100%;"
                          name="editRole"
                          class="custom-select mr-sm-2"
                        >
                          <option value="" selected="selected" disabled hidden>Select Role</option>
                          <option value="super_admin">super_admin</option>
                          <option value="admin">admin</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button
                    style="width: 100%"
                    type="submit"
                    class="btn btn-success"
                  >
                    Submit
                  </button>
                </form>
            </div>
            <div class="card col-7" style="margin-left: 70px;">
                <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" style="width: 166px;">Name</th>
                        <th class="sorting" style="width: 219px;">Role Name</th>
                        <th class="sorting" style="width: 204px;">Status</th>
                        <th class="sorting" style="width: 99px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    @if($user->type != 'user')
                    <tr role="row" class="odd">
                      <td class="sorting_1">{{$user->name}}</td>
                      <td>
                        @if($user->type == 'super_admin')
                          <p class="badge badge-success">{{$user->type}}</p>
                        @elseif($user->type == 'share_holder')
                          <p class="badge badge-warning">{{$user->type}}</p>
                        @else
                          <p class="badge badge-info">{{$user->type}}</p>
                        @endif
                      </td>
                      <td>
                        @if($user->status == 0)
                        <p class="badge badge-success">Active</p>
                        @endif
                      </td>
                      <td style="display: inline-flex;">
                          <a style="margin-right: 5px;" href="#" class="btn btn-primary btn-sm" onclick="showId({{$user}})">
                            <i class="fa fa-edit"></i>
                          </a>
                        <form action="{{route('role.delete',$user->id)}}" method="post">
                          @csrf
                          <input type="text" name="role" value="user" hidden>
                          <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endif
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

        function showId(user) {
          if(document.getElementById("addRole"))
          document.getElementById("addRole").style.display = "none";
          document.getElementById("editRole").style.display = "block";
          $('#editName').val(user.name);
          $('#editRole').val(user.role);
        }
        function closeForm(){
          if( document.getElementById("editRole"))
          document.getElementById("editRole").style.display = "none";
          document.getElementById("addRole").style.display = "block";
          $('#editName').val();
          $('#editRole').val();
        }
      </script>
    {{-- <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#contact-form').on('submit', function(event){
          event.preventDefault();

          name = $('#name').val();

          $.ajax({
            url: "search-user",
            type: "POST",
            data:{
                name:name
            },
            success:function(response){
              console.log(response.search_user);
              $("#test").val(response.search_user)[0].name;
              // response.search_user.forEach(ele => {
              //   $('#test').val(ele.name);
              // });
              // $('#test').val(response.search_user.name);
              $("#contact-form")[0].reset();
            }
           });
          });
        </script>     --}}
    @endsection
@endsection
