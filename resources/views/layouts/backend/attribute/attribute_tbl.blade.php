@foreach ($attributes as $key =>$attr)
<tr id="id{{$attr->id}}" role="row" class="odd">
  <td class="sorting_1">{{ $attr->get_product->product_name }}</td>
  <td class="sorting_1">
    <p id="size_n{{$attr->id}}">{{ $attr->size }}</p>
    <input id="size_e{{$attr->id}}" type="text" style="display: none; width:70px" value="{{$attr->size}}">
  </td>
  <td class="sorting_1">
    <p id="pur_n{{$attr->id}}">{{$attr->pur_price}}</p>
    <input id="pur_e{{$attr->id}}" type="text" style="display: none; width:100px" value="{{$attr->pur_price}}">
  </td>
  <td class="sorting_1">
    <p id="sale_n{{$attr->id}}">{{$attr->sale_price}}</p>
    <input id="sale_e{{$attr->id}}" type="text" style="display: none; width:100px" value="{{$attr->sale_price}}">
  </td>
  <td class="sorting_1">
    <p id="promo_n{{$attr->id}}">{{$attr->promo_price}}</p>
    <input id="promo_e{{$attr->id}}" type="text" style="display: none; width:100px" value="{{$attr->promo_price}}">
  </td>
  <td class="sorting_1">
    <p id="dis_n{{$attr->id}}">{{$attr->discount}}</p>
    <input id="dis_e{{$attr->id}}" type="text" style="display: none; width:70px" value="{{$attr->discount}}">
  </td>
  <td class="sorting_1">
    <p id="stock_n{{$attr->id}}">{{$attr->stock}}</p>
    <input id="stock_e{{$attr->id}}" type="text" style="display: none; width:70px;" value="{{$attr->stock}}">
  </td>
  <td style="display: inline-flex;">
      <button style="margin-right: 5px;" id="btn_n{{$attr->id}}" class="btn btn-primary btn-sm" onclick="showId({{$attr->id}})">
        <i class="fa fa-edit"></i>
      </button>
      <button style="margin-right: 5px;display:none;" id="btn_e{{$attr->id}}" class="btn btn-success btn-sm" onclick="updateAttribute({{$attr->id}})">
        <i class="fa fa-check"></i>
      </button>
      <button style="margin-right: 5px;display:none;" id="btn_d_e{{$attr->id}}" class="btn btn-danger btn-sm" onclick="closeEdit({{$attr->id}})">
        <i class="fas fa-undo"></i>
      </button>
    {{-- <form id="btn_d_n{{$attr->id}}" action="" method="post">
      @csrf
      <input type="text" name="role" value="user" hidden>
      <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa fa-trash"></i>
      </button>
    </form> --}}
  </td>
</tr>
@endforeach