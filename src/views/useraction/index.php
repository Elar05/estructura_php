<?php require_once 'src/views/layout/head.php'; ?>
<!-- Styles -->
<?php require_once 'src/views/layout/header.php'; ?>

<!-- Content -->
<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="pd-20 card-box mb-30">
      <div class="clearfix mb-20">
        <div class="pull-left">
          <h4 class="text-blue h4">User Actions</h4>
        </div>
        <div class="pull-right">
          <a href="<?= URL ?>/useraction/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
      <?php $this->showMessages() ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->d['actions'] as $action) : ?>
            <tr>
              <td><?= $action['id'] ?></td>
              <td><?= $action['name'] ?></td>
              <td>
                <a href="<?= URL ?>/useraction/edit/<?= $action['id'] ?>" class="btn btn-warning btn-sm">Editar <i class="fa fa-pencil"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once 'src/views/layout/footer.php'; ?>
<!-- Scritps -->
<?php require_once 'src/views/layout/foot.php'; ?>