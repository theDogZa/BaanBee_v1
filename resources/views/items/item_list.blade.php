
 @include('partials.items._search_model')
 
<div class="table table-responsive">
    <form id="form-list-items">
    <table class="table table-bordered table-striped table-hover jambo_table" id="tbllist">
        <thead>
            <tr>
                <th class='text-center'>
                    <input type="checkbox" class="checkbox-lg checkbox-color-blue" id="check_all" data-class-all="chk-item-list" style=" margin-right: 10px;">   (All)
                </th>
                <th class='text-center'>
                    {{ __('item.th_item_code') }}
                </th>
                <th class='text-center'>
                    {{ __('item.th_item_name') }}
                </th>
                <th class='text-center'>
                    {{ __('item.th_item_sale_price') }}
                </th>
                <th class='text-center'>
                    {{ __('item.th_item_qty') }}
                </th>
            </tr>
        </thead>
        <tbody>
            
                @if(count($results)==0)
                <tr id="row-bank">
                    <td class="text-center" colspan="200"> {{ ucfirst(__('core.no records')) }} </td>
                </tr>
                @endif 
                @foreach($results as $item)
                <tr class="row-checkbox-list" data-id="{!! $item->id !!}">
                    <td class="text-center td-num">
                        <input type="checkbox" class="checkbox-lg checkbox-color-blue chk-item-list" name="items-list[]" value="{!! $item->id !!}" id="item_id_{!! $item->id !!}" >
                    </td>
                    <td class="text-center"> {!! $item->item_code !!} </td>
                    <td>{!! $item->item_name !!} </td>
                    <td class="text-right">{!! $item->sale_price !!}</td>
                    <td class="text-center">{!! $item->item_qty !!}</td>
                </tr>
                @endforeach
            
        </tbody>
    </table>
</form>
</div>
 @include('partials._panel_pagination')
