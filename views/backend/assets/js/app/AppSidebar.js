$(document).ready(function () {
    // Menubar
    $('.sidebar-main-toggle').on('click', function () {
        if ($('body').is('.menubar-collapsed')) {
            $('body').removeClass('menubar-collapsed');
            if ($('body').is('.menu-static-header')) {
                $('body').removeClass('sh2');
            }
            $('.side-menu li.active ul').slideDown();
        } else {
            $('body').addClass('menubar-collapsed');
            if ($('body').is('.menu-static-header')) {
                $('body').addClass('sh2');
            }
            $('.side-menu li ul').slideUp();
        }
    });

    // On hover
    $('#main-sidebar').hover(function () {
        if ($('body').is('.menubar-collapsed')) {
            $('body').addClass('menubar-visible');
            $('.side-menu li.active ul').slideDown();
        }
    }, function () {
        if ($('body').is('.menubar-collapsed')) {
            $('body').removeClass('menubar-visible');
            $('.side-menu li ul').slideUp();
        }
    });

    $('.side-menu li ul').slideUp();
    $('.side-menu li').removeClass('active');
    $('.side-menu li').on('click', function () {
        if ($(this).is('.active')) {
            $(this).removeClass('active');
            $('ul', this).slideUp();
        } else {
            // $('.side-menu li').removeClass('active');
            // $('.side-menu li ul').slideUp();
            // $(this).addClass('active');
            $('.side-menu li').removeClass('active');
            if (!$('.side-menu li').hasClass('active')) {
                $('.side-menu li ul').slideUp();
            }
            $(this).toggleClass('active');
            $('ul', this).slideToggle();
        }
    });

    $('.side-menu a').each(function () {
        var href = this.href,
            url = window.location.href

        href.indexOf('.html') > -1 ? href = href.replace('.html', '') : href = href

        // console.log(href)

        if (href != '') {
            if (url.indexOf(href) > -1) {
                $(this).parent('li').addClass('current-page')
                $(this).parents('ul').parent('li').addClass('active')
            }
        }
    })

});

$(window).on('load', function () {
    if (!$('body').hasClass('menubar-collapsed')) {
        $('.side-menu li.active ul').slideDown();
    }
});