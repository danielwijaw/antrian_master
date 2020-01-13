

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin') ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Antrian Dashboard</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('/') ?>">
          <i class="fas fa-fw fa-archive"></i>
          <span>Pendaftaran</span></a>
      </li>
        <?php 
            $icon = [
              'jenis_penjamin' => "fas fa-fw fa-book",
              'poliklinik' => "fas fa-fw fa-book-medical",
              'dokter' => "fas fa-fw fa-briefcase-medical",
              'user_admin' => "fas fa-fw fa-briefcase",
              'level_user' => "fas fa-fw fa-building",
              'jadwal_dokter' => "fas fa-fw fa-calendar-day",
              'libur_dokter' => "fas fa-fw fa-calendar-times"
            ];
            $json = file_get_contents(base_url('backend/category'));
            $obj = json_decode($json, true);
            foreach($obj['results'] as $key => $value){
        ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/permalink/'.$value['url']) ?>">
          <i class="<?php echo $icon[$value['url']] ?>"></i>
          <span><?php echo $value['text']; ?></span></a>
      </li>
        <?php } ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('/admin/report') ?>">
          <i class="fas fa-fw fa-cog"></i>
          <span>Laporan</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
