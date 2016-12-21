 @if ($paginator->lastPage() > 1)
<?php
 $from = $paginator->currentPage()*$paginator->perPage();
 ($from >= $paginator->total())? $end = $paginator->total() : $end = $from ;
 $start = $from - $paginator->perPage() + 1;
?>

<button class="btn btn-default"> {!!$start!!}&nbsp;-&nbsp;{!!$end!!}&nbsp;of&nbsp;{!!$paginator->total()!!} </button>
<div class="btn-group pull-right">
    <a class="btn btn-success btn-simple btn-previous" {{ ($paginator->currentPage() == 1) ? ' disabled="disabled"' : '' }} data-href="{{ $paginator->url(1) }}"><i class="ion-android-arrow-back"></i></a>
    <a class="btn btn-success btn-simple btn-next" {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled="disabled"' : '' }} data-href="{{ $paginator->url($paginator->currentPage()+1) }}"><i class="ion-android-arrow-forward"></i></a>
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


