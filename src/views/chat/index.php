<?php require_once 'src/views/layout/head.php'; ?>
<style>
  #chat-messages {
    height: 400px;
    overflow: auto;
  }
</style>
<?php require_once 'src/views/layout/header.php'; ?>

<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="bg-white border-radius-4 box-shadow mb-30">
        <div class="row no-gutters">
          <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="chat-list bg-light-gray">
              <div class="chat-search">
                <span class="ti-search"></span>
                <input type="text" placeholder="Search Contact">
              </div>
              <div class="notification-list chat-notification-list customscroll">
                <ul>
                  <?php foreach ($this->d['users'] as $user) :
                    $status = ($user['session_status'] === "1") ? "Online" : "Offline";
                    $class = ($user['session_status'] === "1") ? "green" : "orange";
                  ?>
                    <li class="chat-user" data-id="<?= $user['id'] ?>" data-name="<?= $user['name'] ?>" data-status="<?= $status ?>">
                      <a href="#">
                        <img src="<?= URL ?>/public/vendors/images/img.jpg" alt="">
                        <h3 class="clearfix"><?= $user['name'] ?></h3>
                        <p>
                          <i class="fa fa-circle text-light-<?= $class ?>"></i> <?= $status ?>
                        </p>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="chat-detail d-none" id="chat-content">
              <div class="chat-profile-header clearfix">
                <div class="left">
                  <div class="clearfix">
                    <div class="chat-profile-photo">
                      <img src="<?= URL ?>/public/vendors/images/profile-photo.jpg" alt="">
                    </div>
                    <div class="chat-profile-name">
                      <h3 id="userChatActive"></h3>
                      <span id="userChatActiveStatus"></span>
                    </div>
                  </div>
                </div>
                <div class="right text-right">
                  <div class="dropdown">
                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                      Setting
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">Export Chat</a>
                      <a class="dropdown-item" href="#">Search</a>
                      <a class="dropdown-item text-light-orange" href="#">Delete Chat</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="chat-box">
                <div class="chat-desc">
                  <ul id="chat-messages"></ul>
                </div>
                <div class="chat-footer">
                  <div class="file-upload"><a href="#"><i class="fa fa-paperclip"></i></a></div>
                  <div class="chat_text_area">
                    <textarea id="text-message" placeholder="Type your message…"></textarea>
                    <input type="hidden" id="userResponder">
                    <input type="hidden" id="userSender" value="<?= $this->user['id'] ?>">
                  </div>
                  <div class="chat_send">
                    <button class="btn btn-link" id="send-message"><i class="icon-copy ion-paper-airplane"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once 'src/views/layout/footer.php'; ?>
<script src="<?= URL ?>/public/js/chat.js"></script>
<?php require_once 'src/views/layout/foot.php'; ?>