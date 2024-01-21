<?php require_once 'src/views/layout/head.php'; ?>
<!-- Styles -->
<?php require_once 'src/views/layout/header.php'; ?>

<!-- Content -->
<div class="main-container">
  <div class="pd-20 card-box mb-30">
    <div class="clearfix">
      <div class="pull-left">
        <h4 class="text-blue h4"><?= $this->d['title'] ?></h4>
      </div>
      <div class="pull-right">
        <a href="<?= URL ?>/typeuser" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
      </div>
    </div>
    <form action="<?= URL . $this->d['action'] ?>" method="post">
      <input type="hidden" name="id" value="<?= $this->d['type']['id'] ?? '' ?>">
      <?php $this->showMessages() ?>
      <div class="form-group">
        <label for="name">Name Action</label>
        <input class="form-control" type="text" name="name" id="name" value="<?= $this->d['type']['name'] ?? '' ?>">
      </div>

      <button class="btn btn-info"><?= $this->d['textButton'] ?></button>
    </form>
  </div>
</div>

<?php require_once 'src/views/layout/footer.php'; ?>
<!-- Scritps -->
<?php require_once 'src/views/layout/foot.php'; ?>