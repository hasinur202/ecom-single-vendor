@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About Page</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <form action="{{ route('about.store') }}" method="POST" role="form">
                    @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Setup About Info</h3>
                    </div>
                    <div class="card-body">
                        <input name="id" hidden type="text" value="{{ optional($about)->id }}" />

                        <div class="form-group">
                            <label style="width: 100%">About Description</label>
                            <textarea name="description" value="{{ optional($about)->description }}" type="text" class="textarea" placeholder="Enter description *">
                                {{ optional($about)->description }}
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 100%">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
        </form>
        </div>

        </div>
    </section>
    <!-- /.content -->
  </div>

@section('js')
<script>



</script>

@endsection
@endsection
