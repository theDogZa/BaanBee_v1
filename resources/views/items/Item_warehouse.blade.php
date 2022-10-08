<div class="table table-responsive">
    <table class="table table-bordered table-striped table-hover" id="tblexample">
        <thead>
            <tr>
                <th class='text-center'>
                    {{__("item.label_item_warehouse_name")}}
                </th>
                <th class='text-center'>
                    {{__("item.label_item_warehouse_min_qty")}}
                </th>
                <th class='text-center'>
                    {{ __("item.label_item_warehouse_qty")}}
                </th>
                <th class='text-center'>
                    {{ __("item.label_item_warehouse_max_qty")}}
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($Item_warehouse)==0)
            <tr id="row-bank">
                <td class="text-center" colspan="200"> {{ ucfirst(__('core.no records')) }} </td>
            </tr>
            @endif @foreach($Item_warehouse as $item)
            <tr>
                <td class="text-center">
                    {!! $item->warehouse_code." - ".$item->warehouse_name !!}
                </td>
                <td class="text-center">
                    {!! (!empty( $item->min_qty ))? $item->min_qty : "-" !!}
                </td>
                <td class="text-center">
                    {!! $item->qty !!}
                </td>
                <td class="text-center">
                    {!! (!empty( $item->max_qty ))? $item->max_qty : "-" !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!--
/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 06/04/2018 13:51
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-28 22:12:49 *
 */
-->