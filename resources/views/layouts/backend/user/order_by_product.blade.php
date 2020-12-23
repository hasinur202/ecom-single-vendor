<table id="getProduct" class="table table-bordered table-striped">
    <thead>
        <tr role="row">
            <th style="width: 166px;">
                Product Name
            </th>

            <th style="width: 166px;">
                Purchase Price
            </th>
            <th style="width: 166px;">
                Sale Price
            </th>
            <th style="width: 166px;">
                Promo Price
            </th>
            <th style="width: 166px;">
                Discount
            </th>
        </tr>
    </thead>
    <tbody>
            @foreach($details as $detail)
                <tr role="row" class="class="sorting_1"">
                    <td class="sorting_1">
                        {{optional($detail->get_product)->product_name}}
                    </td>
                    @foreach ($detail->get_product->get_attribute as $attr)
                    @if ($attr->product_id == $detail->product_id && $attr->size == $detail->size)
                    <td class="sorting_1">{{optional($attr)->pur_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->sale_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->promo_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->discount}} %</td>
                    @endif
                    @endforeach
                </tr>
            @endforeach
    </tbody>
</table>