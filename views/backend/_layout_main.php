<!-- Call Header -->
<?php $this->load->view('backend/common/header.php'); ?>

<!-- Call Menu -->
<?php $this->load->view('backend/common/menubar.php'); ?>

<!-- Call Content -->
<?php $this->load->view($subview); ?>

<!-- Call Footer -->
<?php $this->load->view('backend/common/footer.php'); ?>