<div class="table-responsive">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>SI #</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php $i=0; @endphp
            @foreach ($userOrderDetails as $ordered_product)
            @php $i++; @endphp
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $ordered_product->get_product->product_name }}</td>
                    <td>{{ $ordered_product->qty }}</td>
                    <td>{{ $ordered_product->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
