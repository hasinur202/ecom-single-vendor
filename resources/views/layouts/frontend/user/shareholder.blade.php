@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/leave_review.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/checkout.css') }}" rel="stylesheet">

@endsection

<main class="bg_gray">
    <div class="container margin_60_35">
        <form id="shareholderFormData">
            @csrf

        <div class="row justify-content-center">
            <h3 style="margin-bottom:3rem" class="col-lg-10">Shareholder Registration Form</h3>
            <div class="col-lg-10">
                <div class="col-lg-5" style="float: left">
                    <div class="form-group">
                        <label>Your Account Number*</label>
                        <input class="form-control" name="account_no" type="text" placeholder="Account number">
                    </div>
                    <div class="form-group">
                        <label>Accounnt Type*</label>
                        <select name="acc_type" class="form-control">
                            <option value="" selected hidden>Select Account Type</option>
                            <option value="bkash">bKash</option>
                            <option value="rocket">Rocket</option>
                            <option value="nogot">Nogot</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Your NID No.</label>
                        <input class="form-control" name="nid" type="text" placeholder="National Identity Number">
                    </div>
                </div>

                <div class="col-lg-7" style="float: right">
                    <div class="col-lg-6" style="float: left">
                        <div class="form-group">
                            <label for="nid">NID Photo (front side) *</label>
                            <div style="height: 7.7rem; border: dashed 1.5px blue;
                                background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                width: 100% !important; cursor: pointer;">
                                <input id="image1" type="file" class="form-control" name="image_front" style="opacity: 0; height: 7.8rem; cursor: pointer; padding: 0px;">
                                <img src="#" id="image-front" style="height: 7.7rem; width: 100% !important; cursor: pointer;margin-top: -154px;" />

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="float: right">
                        <div class="form-group">
                            <label for="nid">NID Photo (back side) *</label>
                            <div style="height: 7.7rem; border: dashed 1.5px blue;
                                background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                width: 100% !important; cursor: pointer;">
                                <input id="image2" type="file" class="form-control" name="image_back" style="opacity: 0; height: 7.8rem; cursor: pointer; padding: 0px;">
                                <img src="#" id="image-back" style="height: 7.7rem; width: 100% !important; cursor: pointer;margin-top: -154px;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="form-group">
                    <label class="container_check" style="color: blue; margin-left:15px;" id="other_addr">Do not have NID or NID photo???
                    <input type="checkbox">
                    <span class="checkmark"></span>
                    </label>
                </div>

                <div id="other_addr_c" >
                    <div class="col-lg-5" style="float: left">
                        <div class="form-group">
                            <label>Nominees Name*</label>
                            <input class="form-control" name="nominee_name" type="text" placeholder="Write nominees Name">
                        </div>
                        <div class="form-group">
                            <label>Nominees Mobile No.*</label>
                            <input class="form-control" name="nom_mobile" type="text" placeholder="Write Nominees Mobile">
                        </div>

                        <div class="form-group">
                            <label>Nominees NID No.*</label>
                            <input class="form-control" name="nom_nid" type="text" placeholder="National Identity Number">
                        </div>
                    </div>

                    <div class="col-lg-7" style="float: right">
                        <div class="col-lg-6" style="float: left">
                            <div class="form-group">
                                <label for="nid">Nominees NID Photo (front side) *</label>
                                <div style="height: 7.7rem; border: dashed 1.5px blue;
                                    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                    width: 100% !important; cursor: pointer;">
                                    <input id="image3" type="file" class="form-control" name="nom_image1" style="opacity: 0; height: 7.8rem; cursor: pointer; padding: 0px;">
                                    <img src="#" id="image-front2" style="height: 7.7rem; width: 100% !important; cursor: pointer;margin-top: -154px;" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="float: right">
                            <div class="form-group">
                                <label for="nid">NID Photo (back side) *</label>
                                <div style="height: 7.7rem; border: dashed 1.5px blue;
                                    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                    width: 100% !important; cursor: pointer;">
                                    <input id="image4" type="file" class="form-control" name="nom_image2" style="opacity: 0; height: 7.8rem; cursor: pointer; padding: 0px;">
                                    <img src="#" id="image-back2" style="height: 7.7rem; width: 100% !important; cursor: pointer;margin-top: -154px;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </form>
    <button onclick="shareholderFormSubmit()" class="btn_1 col-lg-10">Submit</button>
    </div>
</main>

@section('js')

<script>


    function shareholderFormSubmit() {
        $.ajax({
            url: "{{ route('shareholder.store') }}",
            method: "POST",
            data: new FormData(document.getElementById("shareholderFormData")),
            enctype: 'multipart/form-data',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                window.location.href = '/';
                Toast.fire({
                    icon:'success',
                    title:'Success!',
                    text:'Your form submitted successfully.'
                })
            },
            error: function(response) {
                if (response.status == 422) {
                    Swal.fire({
                        icon:'error',
                        title:'Opps!',
                        text:'Wrong Data Entry.'
                    })

                }else if(response.status == 500){
                    Swal.fire({
                        icon:'error',
                        title:'Error!',
                        text:'Submitted Failed. Try Again..!'
                    })

                }else if(response.status == 404){
                    Swal.fire({
                        icon:'error',
                        title:'Field Required..!'
                    })
                }else if(response.status == 502){
                    Swal.fire({
                        icon:'error',
                        title:'Opps!',
                        text:'You have already registered..!'
                    })
                }
            }


        })
    };








    $("#image1").change(function() {
        imageUrl(this);
    });

    $("#image2").change(function() {
        imageUrl2(this);
    });
    $("#image3").change(function() {
        imageUrl3(this);
    });

    $("#image4").change(function() {
        imageUrl4(this);
    });

    function imageUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-front').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function imageUrl2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-back').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function imageUrl3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-front2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function imageUrl4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-back2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }








    function itemDelete(id){
        $.ajax({
            url: "{{ route('cart.item.delete') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success:function(response)
            {
                $("#count1").text(response.count1);
                window.location.reload();
            }
        })
    }

</script>

<script>
    // Other address Panel
    $('#other_addr input').on("change", function (){
        if(this.checked)
            $('#other_addr_c').fadeIn('fast');
        else
            $('#other_addr_c').fadeOut('fast');
    });

    function searchProduct(){
        
        $.ajax({
            url: "{{ route('search') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'name':$("#data").val()
            },
            dataType: 'html',
            success: function(response) {
                if ($("#data").val() != null) {
                    if (window.screen.availWidth < 600) {
                        $("#searchData1").html(response);
                        $("#searchData1").show();
                    }else{
                        $("#searchData").html(response);
                        $("#searchData").show();
                    }
                    
                }else{
                    $("#searchData").fadeOut();
                    $("#searchData1").hide();
                }
            },
        })
        $(document).on('click', 'li', function(){
            $("#data").val($(this).text());
            $("#searchData").fadeOut();
            $("#searchData1").fadeOut();
            window.location.href="/"+$("#data").val();
        });
    }
</script>

@endsection
@endsection
