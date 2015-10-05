<ol class="breadcrumb">
    You are here:
    <? foreach($breadcrumbs as $breadcrumb) : ?>
        <? if($breadcrumb['active']) : ?>
            <li class="active"><?=$breadcrumb['title']; ?></li>
        <? else : ?>
            <li><a href="<?=$breadcrumb['link']; ?>"><?=$breadcrumb['title']; ?></a></li>
        <? endif; ?>
    <? endforeach; ?>
</ol>