<!-- SIDEBAR -->
<aside id="main-sidebar" class="nicescroll">
    <div class="menu-section">
        <ul class="nav side-menu">
            <li class="active"><a href="<?php echo site_url('entry_data'); ?>"><i class="icon ion-folder"></i> <span class="title">Entry Data</span></a></li>
            <?php if (check_group_permission(['admin-opd'])) : ?>
            <li ><a href="<?php echo site_url('entry_data/lihat_data'); ?>"><i class="icon ion-person"></i> <span class="title">Lihat Data Data</span></a></li>
            <?php endif; ?>

        </ul>
    </div>
</aside>