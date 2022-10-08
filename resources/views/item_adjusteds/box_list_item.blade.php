<br>
<button type="button" class="btn btn-primary btn-sm" title="Add" id="btn-box-model-items"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
<div class="x_panel x_panel_line ">
    <div class="x_title">
        <h2><i class="fa fa-list" aria-hidden="true"></i> Item Lists</h2>
            @include('partials._panel_toolbox')
            <div class="clearfix"></div>
    </div>
    <div class="x_content">      
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-hover jambo_table" id="tbllist">
                <thead>
                    <tr>
                        <th class='text-center'>
                           #
                        </th>
                        <!-- <th class='text-center'>
                            {{__("item.label_item_warehouse_name")}}
                        </th> -->
                        <th class='text-center'>
                           {{__("item_adjusted.label_list_item")}}
                        </th> 
                        <th class='text-center'>
                           {{__("item_adjusted.label_list_qty")}}
                        </th>
                        <th class='text-center'>
                           {{__("item_adjusted.label_list_price")}}
                        </th>
                        <th class='text-center'>
                            {{__("item_adjusted.label_list_adj_type")}}                           
                        </th>
                        <th class='text-center'>
                            {{__("item_adjusted.label_list_adj_qty")}}
                        </th>
                        <th class='text-center'>
                            {{__("item_adjusted.label_list_new_qty")}}
                        </th>
                        <th class='text-center'>
                            {{__("item_adjusted.label_list_desc")}}
                        </th>
                        <th class='text-center'>
                           {{__("item_adjusted.label_list_action")}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                  
                    <!-- <tr id="row-bank">
                        <td class="text-center" colspan="200"> {{ ucfirst(__('core.no records')) }} </td>
                    </tr> -->
                  
                    <tr class="row-list row-bank" id="1" >
                        <td class="text-center td-num">
                           1
                        </td>
                        <!-- <td class="text-center">
                          {!!  Form::select('parent_id',['' => ''], @$example['parent_id'] , array('placeholder'=>__("example.placeholder_parent_id"),'class' => 'select2_single form-control','','','data-parsley-errors-container'=>'#errors-messages-box-parent_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_parent_id")]) )) !!}
                        </td> -->
                        <td class="text-center input-select form-group">
                          {!!  Form::select('item_id[]',['' => '']+$Items, @$item_adjusted['Items'] , array('id'=>'item-row-1', 'class' => 'item-list select2 form-control select-items','required','','data-parsley-errors-container'=>'#errors-messages-box-item_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_list_item")]) )) !!}
                        <span class="span-messages" id="errors-messages-box-item_id"></span>
                        </td>
                        <td class="text-center">
                            {!! Form::number('qty', @$item_adjusted['qty'], 
                            array('placeholder'=>__("item_adjusted.placeholder_list_qty"),'class' => 'form-control input-qty' ,'readonly' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_qty")]) ))   !!}
                        </td>
                        <td class="text-center">
                           {!! Form::number('price', @$item_adjusted['price'], 
                            array('placeholder'=>__("item_adjusted.placeholder_list_price"),'class' => 'form-control input-number','readonly' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_price")]) ))   !!}
                        </td>
                        <td class="text-center input-select">
                           {!!  Form::select('parent_id',['' => ''], @$example['parent_id'] , array('placeholder'=>__("example.placeholder_parent_id"),'class' => 'select2 form-control','','','data-parsley-errors-container'=>'#errors-messages-box-parent_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_parent_id")]) )) !!}
                        </td>
                        <td class="text-center form-group">
                          {!! Form::number('adj_qty', @$item_adjusted['adj_qty'], 
                            array('placeholder'=>__("item_adjusted.placeholder_list_adj_qty"),'class' => 'form-control input-qty','required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_list_adj_qty")]) ))   !!}
                        </td>
                        <td class="text-center">
                          {!! Form::number('new_qty', @$item_adjusted['new_qty'], 
                            array('placeholder'=>__("item_adjusted.placeholder_list_new_qty"),'class' => 'form-control input-qty' ,'readonly' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_doc_num")]) ))   !!}
                        </td>
                        <td class="text-center">
                          {!! Form::text('desc', @$item_adjusted['desc'], 
                            array('placeholder'=>__("item_adjusted.placeholder_list_desc"),'class' => 'form-control' ,'' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_doc_num")]) ))   !!}
                        </td>
                        <td class="text-center td-btn-del">
                           <button type="button" class="btn btn-danger btn-sm btn-del-line" disabled="disabled" title="Del" data-id="1"><i class="fa fa-trash" aria-hidden="true"></i> Del</button>
                        </td>
                    </tr>

                    <tr id="row-btn-plus">
                        <td class="text-center">
                           <button type="button" class="btn btn-primary btn-sm" title="Add" id="plus-row"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                        </td>
                        <!-- <td class="text-center"></td> -->
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    
                </tbody>
            </table>
                     
        </div>

    </div>
</div>


