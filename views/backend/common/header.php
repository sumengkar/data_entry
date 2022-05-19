<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo 'Admin Dashboard'; ?></title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">

    <!-- LIBS JS -->
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/Chart.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/toastr.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/jquery.ui.nestedSortable.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/libs/jquery.multi-select.js"></script>

    <!-- Load dynamic header script from plugin -->
    <?php //echo plugin_admin_enqueue_scripts() ?>

    <!-- APP JS-->
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/app/App.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL; ?>js/app/AppSidebar.js"></script>

    <!-- LIBS CSS -->
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/bootstrap-switch.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>js/libs/iCheck/skins/square/green.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/select2.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/toastr.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/libs/multi-select.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_URL; ?>css/style.css">

</head>
<body>
    <!-- HEADER -->
    <header id="main-header">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <ul class="nav navbar-nav visible-xs-block list-unstyled">
                        <li><a data-toggle="collapse" data-target="#navbar-mobile" class="" aria-expanded="true"><i class="glyphicon glyphicon-option-vertical"></i></a></li>
                        <li><a class="sidebar-main-toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a></li>
                    </ul>
                    <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>"><img alt="" src="<?php echo ADMIN_ASSETS_URL; ?>images/logo_light.png"></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav hidden-xs">
                        <li>
                            <a class="sidebar-control sidebar-main-toggle">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li class="dropdown">
                            <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon ion-ios-bell"></i>
                                <span class="visible-xs-inline-block position-right">
                                    Messages
                                </span>
                                <span class="badge brand-warning">
                                    2
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-content">
                                <div class="dropdown-content-heading">
                                    Message
                                    <ul class="icons-list list-unstyled">
                                        <li>
                                            <a data-toggle="tooltip" href="#" title="Create message">
                                                <i class="icon ion-edit">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="dropdown-content-body list-unstyled nicescroll">
                                    <li class="media">
                                        <div class="media-left">
                                            <img alt="" class="img-circle img-sm" src="assets/images/users/user-default.jpg"/>
                                                <span class="badge brand-danger media-badge">
                                                    5
                                                </span>
                                            </img>
                                        </div>
                                        <div class="media-body">
                                            <a class="media-heading" data-toggle="chat-item">
                                                <span class="text-bold">
                                                    James Alexander
                                                </span>
                                                <span class="media-annotation pull-right">
                                                    04:58
                                                </span>
                                            </a>
                                            <span class="text-muted">
                                                who knows, maybe that would be the best thing for me...
                                            </span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img alt="" class="img-circle img-sm" src="assets/images/users/user-default.jpg"/>
                                                <span class="badge brand-danger media-badge">
                                                    4
                                                </span>
                                            </img>
                                        </div>
                                        <div class="media-body">
                                            <a class="media-heading" data-toggle="chat-item">
                                                <span class="text-bold">
                                                    Margo Baker
                                                </span>
                                                <span class="media-annotation pull-right">
                                                    12:16
                                                </span>
                                            </a>
                                            <span class="text-muted">
                                                That was something he was unable to do because...
                                            </span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img alt="" class="img-circle img-sm" src="assets/images/users/user-default.jpg"/>
                                        </div>
                                        <div class="media-body">
                                            <a class="media-heading" data-toggle="chat-item">
                                                <span class="text-bold">
                                                    Jeremy Victorino
                                                </span>
                                                <span class="media-annotation pull-right">
                                                    22:48
                                                </span>
                                            </a>
                                            <span class="text-muted">
                                                But that would be extremely strained and suspicious...
                                            </span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img alt="" class="img-circle img-sm" src="assets/images/users/user-default.jpg"/>
                                        </div>
                                        <div class="media-body">
                                            <a class="media-heading" data-toggle="chat-item">
                                                <span class="text-bold">
                                                    Beatrix Diaz
                                                </span>
                                                <span class="media-annotation pull-right">
                                                    Tue
                                                </span>
                                            </a>
                                            <span class="text-muted">
                                                What a strenuous career it is that I've chosen...
                                            </span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img alt="" class="img-circle img-sm" src="assets/images/users/user-default.jpg"/>
                                        </div>
                                        <div class="media-body">
                                            <a class="media-heading" data-toggle="chat-item">
                                                <span class="text-bold">
                                                    Richard Vango
                                                </span>
                                                <span class="media-annotation pull-right">
                                                    Mon
                                                </span>
                                            </a>
                                            <span class="text-muted">
                                                Other travelling salesmen live a life of luxury...
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="dropdown-content-footer">
                                    <a data-toggle="tooltip" href="#" title="All messages">
                                        <i class="icon ion-more"></i>
                                    </a>
                                </div>
                            </div>
                        </li> -->
                        <li class="dropdown dropdown-user">
                            <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown">
                                <img alt="" style="width: 31px; height: 31px;" src="<?php echo get_gravatar( $this->session->userdata['email'], 180 ); ?>">
                                    <span style="margin-right: 10px;">
                                        <?php echo $this->session->userdata['firstname'] . ' ' . $this->session->userdata['lastname'] ?>
                                    </span>
                                    <i class="icon ion-ios-arrow-down"></i>
                                </img>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="<?php echo site_url('user/edit/' . $this->session->userdata['user_id']); ?>"> <i class="icon ion-settings"> </i> Account settings </a> </li>
                                <li>
                                    <?php echo anchor('user/logout', '<i class="icon ion-log-out"></i> Logout'); ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>