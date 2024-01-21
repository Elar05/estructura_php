<?php require_once 'src/views/layout/head.php'; ?>
<!-- Styles -->
<?php require_once 'src/views/layout/header.php'; ?>

<!-- Content -->
<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="pd-20 card-box mb-30">
      <div class="clearfix mb-20">
        <div class="pull-left">
          <h4 class="text-blue h4">User Types</h4>
        </div>
        <div class="pull-right">
          <a href="<?= URL ?>/typeuser/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
      <?php $this->showMessages() ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Permissions</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->d['types'] as $type) : ?>
            <tr>
              <td><?= $type['id'] ?></td>
              <td><?= $type['name'] ?></td>
              <td>
                <button class="btn btn-success btn-sm permissions" data-toggle="modal" data-target="#modal-permissions" data-id="<?= $type['id'] ?>">Permissions <i class="fa fa-cubes" aria-hidden="true"></i></button>
              </td>
              <td>
                <a href="<?= URL ?>/typeuser/edit/<?= $type['id'] ?>" class="btn btn-warning btn-sm">Editar <i class="fa fa-pencil"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="modal fade" id="modal-permissions" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Permissions</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="typeUserId">
              <?php foreach ($this->d['actions'] as $action) : ?>
                <div class="custom-control custom-checkbox mb-5">
                  <input type="checkbox" class="custom-control-input actionCheck" value="<?= $action['id'] ?>" id="action_<?= $action['id'] ?>">
                  <label class="custom-control-label" for="action_<?= $action['id'] ?>"><?= $action['name'] ?></label>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'src/views/layout/footer.php'; ?>
<!-- Scritps -->
<script src="<?= URL ?>/public/js/typeuser.js"></script>

<?php require_once 'src/views/layout/foot.php'; ?>