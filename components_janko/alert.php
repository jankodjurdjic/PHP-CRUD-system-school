<div class="alert <?=$alert->alert_type; ?> alert-dismissible" role="alert" style="display: <?=$alert->alert_show; ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?=$alert->alert_message; ?>
</div>