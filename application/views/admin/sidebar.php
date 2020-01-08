    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin') ?>">
        <div class="sidebar-brand-text mx-3">Antrian Dashboard</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

        <?php 
            $json = file_get_contents(base_url('backend/category'));
            $obj = json_decode($json, true);
            foreach($obj['results'] as $key => $value){
        ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/permalink/'.$value['url']) ?>">
          <i class="fas fa-fw fa-cog"></i>
          <span><?php echo $value['text']; ?></span></a>
      </li>
        <?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->