<!DOCTYPE html>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
</script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<html lang="en">
    <!--head-->
    <head>
        <meta charset="utf-8">
        <title>Nutritívoz - Alimentación saludable para todos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!--CSS Call-->
        <link rel="stylesheet" href="<?= asset_url(); ?>css/normalize.css">
        <link rel="stylesheet" href="<?= asset_url(); ?>css/main.css">
        <link rel="stylesheet" href="<?= asset_url(); ?>css/responsive-design.css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js">
        <script src = "<?= asset_url(); ?>js/bam-percent-page-viewed.js" type = "text/javascript" ></script>
        <script src="<?= asset_url(); ?>js/bootstrap-number-input.js" ></script>
        <link rel="stylesheet" href="<?= asset_url(); ?>css/carrito.css">
        <!--<script src="<?= asset_url(); ?>js/carrito.js" ></script>-->
        <link rel="icon" type="<?= asset_url(); ?>imag/png" href="<?= asset_url(); ?>img/favicon.png" />

        <!--Google Analytics-->
        <script>
                    (function (i, s, o, g, r, a, m) {
                        i['GoogleAnalyticsObject'] = r;
                        i[r] = i[r] || function () {
                            (i[r].q = i[r].q || []).push(arguments)
                        }, i[r].l = 1 * new Date();
                        a = s.createElement(o),
                                m = s.getElementsByTagName(o)[0];
                        a.async = 1;
                        a.src = g;
                        m.parentNode.insertBefore(a, m)
                    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-78710540-1', {'allowAnchor': true});
            ga('send', 'pageview', {'page': location.pathname + location.search + location.hash});


        </script>


    </head>