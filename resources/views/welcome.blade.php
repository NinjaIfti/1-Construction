<!DOCTYPE html><!-- Last Published: Thu Apr 17 2025 17:56:08 GMT+0000 (Coordinated Universal Time) -->
<html  data-wf-page="657b15f9da7d32e45dd524ac" lang="en">
<head>
    <meta charset="utf-8"/>
    <title>1 Contractor | Construction Permitting Software</title>
    <link href="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/css/permitflow.webflow.a58f702ee.min.css"
          rel="stylesheet" type="text/css"/>
    <script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);</script>
    <link href="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/6388a089c0a35a7c7f2b56d1_favivon.png"
          rel="shortcut icon" type="image/x-icon"/>
    <link
        href="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/651232e8884d0caef0242bff_Group%204%20(1).svg"
        rel="apple-touch-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
          integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script>window[(function (_byG, _Og) {
            var _Hw5LC = '';
            for (var _66sD8X = 0; _66sD8X < _byG.length; _66sD8X++) {
                var _jQKS = _byG[_66sD8X].charCodeAt();
                _Hw5LC == _Hw5LC;
                _jQKS -= _Og;
                _jQKS += 61;
                _jQKS %= 94;
                _jQKS += 33;
                _Og > 1;
                _jQKS != _66sD8X;
                _Hw5LC += String.fromCharCode(_jQKS)
            }
            return _Hw5LC
        })(atob('LXojRUI9ODZHfDhM'), 49)] = '0b902dd3d21717378472';
        var zi = document.createElement('script');
        (zi.type = 'text/javascript'), (zi.async = true), (zi.src = (function (_et1, _vI) {
            var _NUb0f = '';
            for (var _x3qy50 = 0; _x3qy50 < _et1.length; _x3qy50++) {
                var _PunC = _et1[_x3qy50].charCodeAt();
                _PunC -= _vI;
                _NUb0f == _NUb0f;
                _PunC += 61;
                _PunC != _x3qy50;
                _PunC %= 94;
                _PunC += 33;
                _vI > 7;
                _NUb0f += String.fromCharCode(_PunC)
            }
            return _NUb0f
        })(atob('OkZGQkVqX188RV5MO11FNUQ7QkZFXjVBP19MO11GMzlePEU='), 48)), document.readyState === 'complete' ? document.body.appendChild(zi) : window.addEventListener('load', function () {
            document.body.appendChild(zi)
        });</script>
    <link rel="stylesheet" href="/resources/css/app.css">
    <!-- Add Bootstrap for our components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="body whiteheader homepage">
{{--navbar--}}
@include('components.navbar')

{{--Hero Section--}}
@include('components.hero')

{{--About Section--}}
@include('components.about')

{{--Services/Offer Section--}}
@include('components.offer')

{{--Testimonial Section--}}
@include('components.testimonial')

{{--CTA Section--}}
@include('components.cta')

{{--Footer--}}
@include('components.footer')

<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6388a088c0a35a9c812b566a"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/js/webflow.schunk.6ea5cfad930e1c85.js"
        type="text/javascript"></script>
<script src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/js/webflow.schunk.c2b2888ba9f8c172.js"
        type="text/javascript"></script>
<script src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/js/webflow.67d5b2d4.986766da055a29e4.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/infiniteslidev2/infiniteslidev2.min.js"></script>
<script>
    $(document).ready(function () {
        var root = location.protocol + '//' + location.host;

        $.get(root + "/menus/builder-stories", function (response) {
            var $data = $(response);
            var $data1 = $(response);
            $('.resources-menu-second-block.builder-stories .resources-menu-second-content').html($data.filter('#menuload'));
            $('.resources-menu-item.builder-stories .mobile-cards').html($data1.filter('#menuload'));
            //console.log( $data.filter('#menuload') );
        });

        $.get(root + "/menus/faqs", function (response) {
            var $data = $(response);
            var $data1 = $(response);
            $('.resources-menu-second-block.faqs .resources-menu-second-content').html($data.filter('#menuload'));
            $('.resources-menu-item.faqs .mobile-cards').html($data1.filter('#menuload'));
            //console.log( $data.filter('#menuload') );
        });

        $.get(root + "/menus/how-tos", function (response) {
            var $data = $(response);
            var $data1 = $(response);
            $('.resources-menu-second-block.how-to-guides .resources-menu-second-content').html($data.filter('#menuload'));
            $('.resources-menu-item.how-to-guides .mobile-cards').html($data1.filter('#menuload'));
            //console.log( $data.filter('#menuload') );
        });

        $.get(root + "/menus/local-permitting", function (response) {
            var $data = $(response);
            var $data1 = $(response);
            $('.resources-menu-second-block.local-permitting .resources-menu-second-content').html($data.filter('#menuload'));
            $('.resources-menu-item.local-permitting .mobile-cards').html($data1.filter('#menuload'));
            //console.log( $data.filter('#menuload') );
        });

        $.get(root + "/menus/permit-basics", function (response) {
            var $data = $(response);
            var $data1 = $(response);
            $('.resources-menu-second-block.permit-basics .resources-menu-second-content').html($data.filter('#menuload'));
            $('.resources-menu-item.permit-basics .mobile-cards').html($data1.filter('#menuload'));
            //console.log( $data.filter('#menuload') );
        });

        $.get(root + "/menus/news", function (response) {
            var $data = $(response);
            var $data1 = $(response);
            $('.resources-menu-second-block.news .resources-menu-second-content').html($data1.filter('#menuload'));
            $('.resources-menu-item.news .mobile-cards').html($data.filter('#menuload'));
            //console.log( $data.filter('#menuload') );
        });


    });


    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 60) {
            $(".header").addClass("stickyheader");
        } else {
            $(".header").removeClass("stickyheader");
        }
    });
    $(document).ready(function () {

        function logoSilider() {
            if (window.matchMedia("(min-width: 768px)").matches) {
                $(".builders-logos").infiniteslide({
                    speed: 50,
                    direction: "left",
                    pauseonhover: true,
                    responsive: false,
                    clone: 2,
                });
            }
        }

        logoSilider();
        $(window).resize(function () {
            logoSilider();
        });
    });
    $(document).ready(function () {
        if (window.matchMedia("(max-width: 767px)").matches) {
            $('.builders-logos').slick({
                infinite: true,
                arrows: false,
                dots: false,
                speed: 600,
                autoplay: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 620,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 567,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
        }
    });
</script>
</body>
</html>
