<div class="dropdown dropdown-cart" id="cartPortion">
    <a href="{{route('cart')}}" id="count1" class="cart_bt"><strong>{{$count1}}</strong></a>
    <div class="dropdown-menu">
        @foreach ($cart as $crt)
            @if ($crt->get_product)
        <ul>
            <li>
                <a href="product-detail-1.html">
                    @foreach ($crt->get_product->get_product_avatars as $avtr)
                    <figure><img src="{{ asset('/images/' . $avtr->front) }}" data-src="{{ asset('/images/' . $avtr->front) }}" alt="" width="50" height="50" class="lazy"></figure>
                    @endforeach
                    <strong><span>{{ $crt->qty }}x {{ $crt->get_product->product_name }}</span>{{ $crt->get_product->sale_price }}</strong>
                </a>
                <a onclick="itemDelete({{$crt->id}})" href="#" class="action"><i class="ti-trash"></i></a>
            </li>
        </ul>
        @endif
        @endforeach

        <div class="total_drop">
            <div class="clearfix">
            @php
                $amount = 0
            @endphp
            @foreach ($cart as $crt)
                @php
                    $amount += $crt->total
                @endphp
            @endforeach
                <strong>Total</strong>
                <span>{{$amount}} TK</span>
            </div>
        </div>


        <div class="total_drop">
            <a href="{{route('cart')}}" class="btn_1 outline">View Cart</a><a href="{{ route('cart.bill') }}" class="btn_1">Checkout</a>
        </div>
    </div>
</div>