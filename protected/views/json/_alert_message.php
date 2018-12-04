<div class="alert alert-<?= $alert->context ?> alert-dismissible show" role="alert" id="alert_box">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong><span class="fa fa-info-circle fa-lg"></span> INFO</strong><br><?= $alert->messages ?>
</div>