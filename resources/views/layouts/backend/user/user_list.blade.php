@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User List</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
            <div class="col-md-12">

                <div class="col-md-8" style="float:left;">
                    <div class="card" style="width: 50rem">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Designation</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $user->name }}</td>
                                            <td class="sorting_1">
                                                <p class="badge badge-success">{{ $user->type }}</p>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phn }}</td>
                                            <td>
                                                @if ($user->verified == 0)
                                                    <p class="badge badge-warning">Not Verified</p>
                                                @else
                                                    <p class="badge badge-success">Verified</p>
                                                @endif
                                            </td>

                                            <td style="display: inline-flex;">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="updateUser({{ $user }})">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button onclick="deleteUser({{ $user->id }})"
                                                    class="btn btn-danger btn-sm">
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

                <div class="col-md-3" style=" float: right;">

                    <div id="loading" style="
                            height: 308px;
                            display: block;
                            color:#767676;
                            background-color:#ddd;
                        ">
                        <h1 style="padding-top: 35%; text-align:center; opacity: .3;">Loading...</h1>
                    </div>

                    <div id="editUser" class="card card-primary" style="
                        height: 100%;
                        display: none;
                    ">
                        <div class="card-header" style="color: #fff;
                    background-color: #28a745;
                    border-color: #28a745;
                    box-shadow: none;">
                            <h3 class="card-title">Update User Info</h3>
                            <a href="#" onclick="closeForm()" class="close">
                                <span style="color: #fff" aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <form role="form" id="contact-form">
                            @csrf
                            <div class="card-body" style="padding-top: 5px !important;padding-bottom:5px !important;">
                                <div class="form-group">
                                    <input type="text" id="userId" name="userId" hidden>
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Name</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                        placeholder="Enter user name" />
                                </div>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                        placeholder="Enter user email" />
                                </div>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Phone Number</label>
                                    <input id="phn" name="phn" type="number" class="form-control"
                                        placeholder="Enter user phn number" />
                                </div>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Address</label>
                                    <input id="address" name="address" type="text" class="form-control"
                                        placeholder="Enter user address" />
                                </div>
                            </div>
                            <button type="submit" style="width: 100%;" class="btn btn-success">
                                Submit
                            </button>
                        </form>
                    </div>

                </div>


            </div>
            </div>
        </section>
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
        function updateUser(user) {
            if (document.getElementById("loading"))
                document.getElementById("loading").style.display = "none";
            document.getElementById("editUser").style.display = "block";
            $('#name').val(user.name);
            $('#email').val(user.email);
            $('#phn').val(user.phn);
            $('#address').val(user.address);
            $('#userId').val(user.id);
        }

        function closeForm() {
            if (document.getElementById("editUser"))
                document.getElementById("editUser").style.display = "none";
            document.getElementById("loading").style.display = "block";
            $('#name').val();
            $('#email').val();
            $('#phn').val();
            $('#address').val();
        }

        function deleteUser(id) {
            id = id;
            $.ajax({
                url: "delete-user",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#contact-form').on('submit', function(event) {
            event.preventDefault();

            userId = $('#userId').val();
            name = $('#name').val();
            email = $('#email').val();
            phn = $('#phn').val();
            address = $('#address').val();

            $.ajax({
                url: "update-user",
                type: "POST",
                data: {
                    userId: userId,
                    name: name,
                    email: email,
                    phn: phn,
                    address: address
                },
                success: function(response) {
                    window.location.reload();
                    // console.log(response);
                    // $("#test").val(response.search_user)[0].name;
                    // response.search_user.forEach(ele => {
                    //   $('#test').val(ele.name);
                    // });
                    // $('#test').val(response.search_user.name);
                    // $("#contact-form")[0].reset();
                }
            });
        });

    </script>
    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#contact-form').on('submit', function(event) {
            event.preventDefault();

            name = $('#name').val();
            email = $('#email').val();
            phn = $('#phn').val();
            address = $('#address').val();

            $.ajax({
                url: "search-user",
                type: "POST",
                data: {
                    name: name
                },
                success: function(response) {
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

    </script> --}}
@endsection
@endsection
