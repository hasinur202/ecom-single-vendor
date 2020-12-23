
@php $i=0; @endphp
@foreach ($levels as $level)
@php $i++; @endphp

<tr id="defaultRow" role="row" >
    <td class="sorting_1">{{ $i }}</td>
    <td class="sorting_1">
        <p id="cycle_no_n{{$level->id}}">{{ optional($level)->cycle_no }}</p>
    </td>
    <td class="sorting_1">
        <p id="cycle_value_n{{$level->id}}">{{ optional($level)->cycle_value }}</p>
        <input style="width:80px !important;
        display:none;" type="text" id="edit_cycle_value{{$level->id}}" value="{{ optional($level)->cycle_value }}" name="edit_cycle_value">
    </td>
    <td class="sorting_1">
        <p id="cycle_emoney_n{{$level->id}}">{{ optional($level)->e_money }}</p>
        <input style="width:80px !important;
        display:none;" type="text" id="edit_cycle_emoney{{$level->id}}" value="{{ optional($level)->e_money }}" name="edit_cycle_value">
    </td>
    <td class="sorting_1">
        <p id="cycle_commision_n{{$level->id}}">{{ optional($level)->commision }}</p>
        <input style="width:80px !important;
        display:none;" type="text" id="edit_commision{{$level->id}}" value="{{ optional($level)->commision }}" name="edit_cycle_value">
    </td>

    <td style="display: inline-flex;">
        <button id="edit_btn_n{{$level->id}}" onclick="editLevel({{ $level->id }})" style="margin-right: 5px" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </button>
        {{-- <button onclick="deleteLevel({{ $level->id }})" class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i>
        </button> --}}
        <button id="update_btn_e{{$level->id}}" onclick="updateLevel({{ $level->id }})" class="btn btn-success btn-sm" style="margin-right: 5px;display:none;">
            <i class="fa fa-check"></i>
        </button>
        <button id="undo_btn_d{{$level->id}}" onclick="closeEdit({{ $level->id }})" class="btn btn-danger btn-sm" style="margin-right: 5px;display:none;">
            <i class="fas fa-undo"></i>
        </button>
    </td>
</tr>
@endforeach
