 @if ($paginator->lastPage() > 1)
<?php
 $from = $paginator->currentPage()*$paginator->perPage();
 ($from >= $paginator->total())? $end = $paginator->total() : $end = $from ;
 $start = $from - $paginator->perPage() + 1;
?>

{!!$start!!}-{!!$end!!}/{!!$paginator->total()!!}
<div class="btn-group">
    <button class="btn btn-default btn-sm btn-previous" {{ ($paginator->currentPage() == 1) ? ' disabled="disabled"' : '' }} data-href="{{ $paginator->url(1) }}">
        <i class="fa fa-chevron-left">
        </i>
    </button>
    <button class="btn btn-default btn-sm btn-next"  {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled="disabled"' : '' }} data-href="{{ $paginator->url($paginator->currentPage()+1) }}">
        <i class="fa fa-chevron-right">
        </i>
    </button>
</div>
@endif

<script type="text/javascript">
    $(document).ready(function(){
    
        $(".btn-previous").click(function(){
            var hrefData = $(this).data('href');
            $('#entry-message').load(hrefData);
        });
        
        $(".btn-next").click(function(){
            var hrefData = $(this).data('href');
            $('#entry-message').load(hrefData);
        });
    });
</script>
<style type="text/css">
    a{
        cursor: pointer;
    }
</style>


