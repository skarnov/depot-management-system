<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.ico">
    </head>

    <body>
        <script>
            var jQ = new Array();
        </script>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-secondary">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item text-nowrap">
                        <a class="nav-link text-light" href="<?php echo base_url() ?>app/logout">Sign out</a>
                    </li>
                </ul>
            </div>
        </nav>        
        <nav id="sideNav" class="navbar bg-secondary col-md-2 mt-5 float-md-left">
            <ul class="navbar-nav main-menu">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>product">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>branch">Branch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>stock">Stocks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>inventory">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>cashbook">Cashbook</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>dealer">Dealer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo base_url() ?>sales">Sales</a>
                </li>
            </ul>
        </nav>
        <?php echo $home ?>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            for (var i in jQ) {
                jQ[i]();
            }
            $('#sideNav').show();
            $('#main').show();
            if (localStorage.getItem('clicked') === 'on') {
                $('#sideNav').hide();
                $('#main').toggleClass('col-md-12 mt-5 float-md-right pt-5');
            }
            $('.navbar-brand').click(function () {
                if (localStorage.getItem('clicked') === 'on') {
                    localStorage.setItem('clicked', 'off');
                    $('#sideNav').toggle();
                    $('#main').toggleClass('col-md-12 mt-5 float-md-right pt-5');
                } else {
                    localStorage.setItem('clicked', 'on');
                    $('#sideNav').toggle();
                    $('#main').toggleClass('col-md-12 mt-5 float-md-right pt-5');
                }
            });
        </script>
    </body>
</html>