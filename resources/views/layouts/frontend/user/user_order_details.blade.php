@php $i=0; @endphp
@foreach ($userOrderDetails as $orderDetails)

@php $i++; @endphp

<tr>
    <td>{{ $i }}</td>
    <td>{{ $orderDetails->get_product->product_name }}</td>
    <td>{{ $orderDetails->get_product->e_money }}</td>
    <td>{{ $orderDetails->qty }}</td>
    <td>{{ $orderDetails->get_product->e_money*$orderDetails->qty }}</td>
    <td>{{ $orderDetails->total }}</td>
</tr>
@endforeach
