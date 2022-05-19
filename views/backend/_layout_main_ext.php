<!-- Call Header -->
<?php $this->load->ext_view('views/backend/common/header.php'); ?>

<!-- Call Menu -->
<?php $this->load->ext_view('views/backend/common/menubar.php'); ?>

<!-- Call Content -->
<?php $this->load->ext_view($subview); ?>

<!-- Call Footer -->
<?php $this->load->ext_view('views/backend/common/footer.php'); ?>