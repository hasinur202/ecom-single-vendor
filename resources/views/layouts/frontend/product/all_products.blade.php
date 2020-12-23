
    @if($products != null)
    @foreach ($products as $pro)
        <div class="col-6 col-md-3">
            <div class="grid_item">
                @foreach ($pro->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$pro->slug) }}">
                        <img style="height: 200px !important;" class="img-fluid lazy" src="/images/{{$avtr->front}}"
                                data-src="/images/{{$avtr->front}}" alt="">
                        </a>
                    </figure>
                @endforeach
                <a href="{{ route('quick',$pro->slug) }}">
                    <h3>{{$pro->product_name}}</h3>
                </a>
                <div class="price_box">

                    @foreach($pro->get_attribute->unique('product_id') as $key => $price)
                    <span class="new_price">{{$price->sale_price}}</span>
                    <span class="old_price">{{$price->promo_price}}</span>
                    @endforeach
                </div>
                <ul>
                    <li>
                        <a href="#" onclick="addWishList({{$pro}})" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                            title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="addToCart({{$pro}})" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                            title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
    @endif
