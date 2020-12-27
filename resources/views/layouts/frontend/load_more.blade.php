@php
    $length = 0;
@endphp
    @foreach ($all_product as $product)
    @php
        $length += 1;
    @endphp
    @if ($product->position == "just for you")
    <div class="col-4 col-md-4 col-xl-2">
        <div class="grid_item">
            @foreach ($product->get_product_avatars as $avtr)
            <figure>
                <a href="{{ route('quick',$product->slug) }}">
                    <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                    <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                </a>
            </figure>
            @endforeach
            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
            <a href="product-detail-1.html">
                <h3>{{$product->product_name}}</h3>
            </a>
            <div class="price_box">
                @foreach ($product->get_attribute->unique('product_id') as $attr)
                    <span class="new_price">{{$attr->sale_price}}</span>
                    <span class="old_price">{{$attr->promo_price}}</span>
                @endforeach
            </div>
            <ul>
                <li><a href="#0" onclick="addWishList({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                <li><a href="#0" onclick="addToCart({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
            </ul>
        </div>
    </div>
    @endif
    @endforeach
    <input type="hidden" id="len" value="{{$length}}">
