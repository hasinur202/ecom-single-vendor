@foreach ($products as $pro)


<tr role="row" class="odd">
    <td class="sorting_1">{{ $pro->product_name }}</td>
    <td class="sorting_1">{{ $pro->get_brand->brand_name }}</td>
    <td class="sorting_1">{{ $pro->product_code }}</td>
    <td class="sorting_1">{{ $pro->color }}</td>
    <td class="sorting_1">
        @if ($pro->position == 'flash sale' && $pro->flash_timing == null && $pro->flash_status == null)
            <p style="cursor: pointer;" data-toggle="modal"
                data-target="#flashTimingModal" class="badge badge-danger">Set Timing
            </p>
        @elseif($pro->position == 'flash sale' && $pro->flash_timing != null &&
            $pro->flash_status == 0)
            <p style="cursor: pointer;" class="badge badge-warning">Pending</p>
        @elseif($pro->flash_timing != null && $pro->flash_status == 1)
            <p class="badge badge-success">Running</p>
        @else
            <p style="cursor: pointer;" onclick="addToFlash({{$pro->id}})" class="badge badge-info">Not flash sale</p>
        @endif
    </td>
    <td>
        @if ($pro->status == 0)
            <p onclick="productStatus({{$pro->id}})" style="cursor: pointer;margin: 0px;" class="badge badge-warning">Inactive</p>
        @else
            <p onclick="productStatus({{$pro->id}})" style="cursor: pointer;margin: 0px;" class="badge badge-success">Active</p>
        @endif

        @php
            $id = null;    
        @endphp
        @foreach ($pro->get_product_avatars  as $avtr)
            @php
                $id = $avtr->product_id;
            @endphp
            <a href="{{ route('product.avatars', $pro->slug) }}"
                class="badge badge-info">Images</a>
        @endforeach

        @if ($pro->id != $id)
        <p style="cursor: pointer" onclick="addProductAvatar(`{{$pro->product_name}}`,{{ $pro->id }})"
            class="badge badge-danger">Images</p>
        @endif
        
    </td>

    <td style="display: inline-flex;">
        <a href="{{ route('product.edit', $pro->slug) }}" style="margin-right: 5px;"
            class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>
        {{-- <form action="{{ route('product.delete', $pro->id) }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
            </button>
        </form> --}}
    </td>
</tr>
@endforeach

<div class="modal fade" id="flashTimingModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Flash Timing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row col-md-8 offset-2">
                    <div class="form-group" style="width: 100%">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Flash Date</label>
                        <input type="date" id="date" class="form-control" name="birthday">
                    </div>
                    <div class="form-group" style="width: 100%">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Flash Time</label>
                        <input onchange="getData()" type="time" class="form-control" id="time" step="1">

                    </div>
                    <input type="hidden" name="flash_timing" class="form-control" id="dateTime">
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="updateFlashSale()" style="width: 100%;" class="btn btn-success">Start
                    Timing</button>

            </div>
        </div>
    </div>
</div>