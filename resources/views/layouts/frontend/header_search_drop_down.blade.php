
<div id="searchData" style="position: absolute;
    margin-left: 22.7%;
    background: #fff;
    width: 43.7%;
    margin-top: 51px;
    height: 300px;
    overflow-y: scroll;opacity:0;">
    <div>

        <ul style="list-style: none;
            padding-right: 30px;">
            @foreach ($products as $pro)
            <li style="padding-top: 5px;
                padding-bottom: 5px;
                border-bottom: 1px solid #ddd;">
                <a href="#">{{$pro->product_name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div> 
