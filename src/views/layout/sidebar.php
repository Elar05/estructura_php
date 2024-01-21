<div class="left-side-bar">
  <div class="brand-logo">
    <a href="<?= URL ?>">
      <img src="<?= URL ?>/public/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
      <img src="<?= URL ?>/public/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        <li>
          <a href="<?= URL ?>" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle">
            <span class="micon dw dw-user1"></span><span class="mtext"> Users</span>
          </a>
          <ul class="submenu">
            <li><a href="<?= URL ?>/user">Users</a></li>
            <li><a href="<?= URL ?>/typeuser">User Types</a></li>
            <li><a href="<?= URL ?>/useraction">User Actions</a></li>
          </ul>
        </li>
        <li>
          <a href="<?= URL ?>/chat" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="mobile-menu-overlay"></div>