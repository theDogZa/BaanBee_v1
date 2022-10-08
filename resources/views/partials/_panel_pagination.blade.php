<div class="paginator">
    <div class="col-sm-4 col-xs-12">
        <p>
            {!! __('pagination.pageof', ['currentPage' => $results->currentPage(),'lastPage' => $results->lastPage()]) !!} , 
            {!! __('pagination.showrecord', ['count' => $results->count(),'total' => $results->total()]) !!}
        </p>
    </div>
    <div class="col-sm-8 col-xs-12">
        <div class="pull-right">
            {{ $results->appends(Input::except('page'))->links('pagination.default') }}
        </div>
    </div>
</div>



<!--
/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 22:43
 * Version : v.10000
 */
-->
