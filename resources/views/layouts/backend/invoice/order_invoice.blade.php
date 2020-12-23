<style>
    #invoice {
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        height:auto;
        padding: 15px
    }

    .invoice header {
        padding: 5px 0;
        margin-bottom: 10px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 5px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.2em;
        background: #3989c6
    }

 

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

</style>

    <div class="content-wrapper">
        <div id="invoice">
            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <header>
                        <div class="row">
                            <div class="col">
                                <a target="_blank" href="#">
                                    <h3>logo</h3>
                                </a>
                            </div>
                            
                        </div>
                    </header>
                    <main>
                        <div class="contacts" style="display: inline-flex;width: 100%;">
                            <div class="invoice-to" style="width: 25%;">
                                <div class="text-gray-light">INVOICE TO:</div>
                                <h3 class="to">{{ $datas->name }}</h3>
                                <div class="address">{{ $datas->address }}</div>
                                <div class="email"><a href="mailto:john@example.com">{{ $datas->email }}</a></div>
                                <div class="email"><a href="#">{{ $datas->phone }}</a></div>
                            </div>
                            <div class="invoice-details" style="
                                width: 31%;
                                margin-left: 70%;
                            ">
                                <h3>Invoice No: {{$datas->transaction_id}}</h3>
                                <div>Date of Invoice: {{ $datas->created_at }}</div>
                            </div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Product Name</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Shipp.Ch</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas->get_order_details as $pro)
                                    <tr>
                                        <td class="no">{{ $pro->id }}</td>
                                        <td class="text-left">{{ $pro->get_product->product_name }}</td>
                                        <td class="unit">{{ $pro->qty }}</td>
                                        <td class="qty">{{ $pro->shipp_charge }}</td>
                                        @foreach ($pro->get_product->get_attribute as $attr)
                                        @if ($pro->product_id == $attr->product_id && $pro->size == $attr->size)
                                            <td class="total">{{ $attr->sale_price }}</td>
                                        @endif
                                        @endforeach
                                        
                                        <td class="total">{{ $pro->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td></td>
                                    <td colspan="2">GRAND TOTAL: </td>
                                    <td>{{ $datas->amount }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </main>
                    
                    <footer>
                        <div class="thanks">Thank you!</div>
                        Invoice was created on a computer and is valid without the signature and seal.
                    </footer>
                </div>
                <div></div>
            </div>
        </div>
    </div>