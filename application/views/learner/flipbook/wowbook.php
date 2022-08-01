<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui,maximum-scale=2">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui,maximum-scale=1">
    <meta http-equiv="cleartype" content="on">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" sizes="196x196" href="<?php echo base_url(); ?>assets/img_flipbook/touch/touch-icon-196x196.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#222222">

    <!-- SEO: If mobile URL is different from desktop URL, add a canonical link to the desktop page -->
    <!--
    <link rel="canonical" href="http://www.example.com/" >
    -->

    <!-- Add to homescreen for Chrome on Android -->
    <!--
    <meta name="mobile-web-app-capable" content="yes">
    -->

    <!-- For iOS web apps. Delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
    <!--
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">
    -->

    <!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
    <!--
    <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
    -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_flipbook/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/wow_book/wow_book.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_flipbook/main.css">
    <script src="<?php echo base_url(); ?>assets/js_flipbook/vendor/modernizr-2.7.1.min.js"></script>
</head>
<body>
<!-- Add your site or application content here -->
<div class='book_container'>
    <input type="hidden" name="book_path" id="book_path" value="<?= $path ?>">
    <div id="book"></div>
</div>
<!-- if you don't need support for IE8 use jquery 2.1 -->
<!-- <script src="js/vendor/jquery-2.1.0.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js_flipbook/vendor/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_flipbook/helper.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/wow_book/pdf.combined.min.js"></script>
<script src="<?php echo base_url(); ?>assets/wow_book/wow_book.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script>
    $(function(){
        var bookOptions = {
            height   : 500
            ,width    : 800
            // ,maxWidth : 800
            ,maxHeight : 600

            ,centeredWhenClosed : true
            ,hardcovers : true
            ,pageNumbers: false
            ,toolbar : "lastLeft, left, right, lastRight, toc, zoomin, zoomout, slideshow, flipsound, fullscreen, thumbnails, download"
            ,thumbnailsPosition : 'left'
            ,responsiveHandleWidth : 50
            ,container: window
            ,containerPadding: "20px"
            // ,toolbarContainerPosition: "top" // default "bottom"
            // The pdf and your webpage must be on the same domain
            ,pdf: $("#book_path").val()
            // Uncomment the option toc to create a Table of Contents
            // ,toc: [                    // table of contents in the format
            // 	[ "Introduction", 2 ],  // [ "title", page number ]
            // 	[ "First chapter", 5 ],
            // 	[ "Go to codecanyon.net", "http://codecanyon.net" ] // or [ "title", "url" ]
            // ]
        };

        $('#book').wowBook( bookOptions ); // create the book

        // How to use wowbook API
        // var book=$.wowBook("#book"); // get book object instance
        // book.gotoPage( 4 ); // call some method
    })
</script>

</body>
</html>
