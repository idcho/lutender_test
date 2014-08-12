<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
	<meta charset="UTF-8" />
	<title><?php if (isset($title)) echo $title; else echo "Default title for page"?></title>
	<meta name="description" content="<?php if (isset($description)) echo $description; else echo "Default description for page"?>" />
	<meta name="keywords" content="<?php if (isset($keywords)) echo $keywords; else echo "default, keywords, for, page"?>" />
	<link href="favicon.ico" rel="icon" />
	<!-- main theme CSS -->
	<link rel="stylesheet" type="text/css" href="assist/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="css/color.css" />
    <!-- google fonts include -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <!-- jquery parts -->
    <script type="text/javascript" src="assist/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="assist/jquery.retina.js"></script>
    <script type="text/javascript" src="assist/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="assist/jquery.infinitescroll.js"></script>
    <script type="text/javascript" src="assist/jquery.ui.totop.min.js"></script>
    <!-- Twitter bootstrap 2.2.1 -->
    <script type="text/javascript" src="assist/bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assist/fonts/font-awesome.css">
    <!-- scripts for core page functionality -->
    <!-- WARNING script must be in page header, because IE8 must load infinite scroll at the beginning | it's only for IE8 issue -->
    <script type="text/javascript">
    $(window).load(function() {
        // filter items when filter link is clicked
        $('#filters a').click(function(){
          $selector = $(this).attr('data-filter');
          $container.isotope({ filter: $selector });
          if (typeof $homepage == "undefined") window.location="index.php?filter="+$selector;
          return false;
        });
        // search button
        $('#search').click(function(){
                $('#searchform').slideToggle("fast", "linear");
            });
    
        // isotope masonry - defining pinboard
        $container = $('#pinboard');
        // retina support
        $('img').retina();
        // creating isotope
        $container.isotope({
          itemSelector : '.item',
          layoutMode : 'masonry'  
        });
    
        <?php 
        //provides dynamicaly load category prom GET value after click from subpage
        if ($_GET["filter"] != "") {
            echo "
            ".'$container'.".isotope({ filter: '*' });
            ".'$container'.".isotope( 'reloadItems' );
            ".'$container'.".isotope({ filter: '".$_GET["filter"]."' });
            ".'$selector'."='".$_GET["filter"]."';
            ";
            
        }
        
        ?>
        
        $container.infinitescroll({
          navSelector  : '#page-nav',    
          nextSelector : '#page-nav a', 
          itemSelector : '.item',
          animate      : false,
          loading: {
              msgText: '<i class="icon-time loadingicon"></i>',
              finishedMsg: '<i class="icon-ok-circle loadingicon"></i>',
              img: 'images/blank.png'
            }
          },
          
          // trigger Masonry as a callback
          function( newElements ) {
            var $newElems = $( newElements ).css({ opacity: 0 });
            // $('img').retina();
            $newElems.imagesLoaded(function(){
              // be carefull with this lines - provides filtering after loading new page to infinite        
              $container.isotope({ filter: '*' });
              $container.isotope( 'reloadItems' );
              $newElems.animate({ opacity: 1 });
              $container.isotope( 'appended', $newElems, true );
              $container.isotope({ filter: $selector });
              
            });
          }
        );
        
        // only for effect
        $('.hidelogo').click(function() {
            $('.logo').slideToggle('fast'); });
        // bootrsrap functions
        $('.dropdown-toggle').dropdown();
        $('.sharetooltip').tooltip();
    
        $().UItoTop({ easingType: 'easeOutQuart'});
    
    
    
        // footer caching position, you can delete this, if you dont want
        function setCookie(name, value, lifetime_days) {
            var exp = new Date();
            exp.setDate(new Date().getDate() + lifetime_days);
            document.cookie = name + '=' + value + ';expires=' + exp.toUTCString() + ';path=/';
        }
            
        function getCookie(name) {
            if(document.cookie) {
                var regex = new RegExp(escape(name) + '=([^;]*)', 'gm'),
                matches = regex.exec(document.cookie);
                if(matches) {
                    return matches[1];
                }
            }
        }
        
        // show list if cookie exists
        if(getCookie('showfooter') == 5) {
            $('#footer').show();
        }   
        if(getCookie('showfooter') == 9) {
            $('#footer').hide();
        }  
            
        // click handler to toggle elements and handle cookie
        $('#footericon').click(function() {
        // check the current state
            if($('#footer').is(':hidden')) {
                // set cookie
                    setCookie('showfooter', '5', 365);
                } else {
                    // delete cookie
                    setCookie('showfooter', '9', 365);
                }
                // toggle
                $('#footer').slideToggle('fast');
                return false;
        });
        
    });
	</script>
	<script type="text/javascript">
		// place here your google analytics code
	</script>
	
</head>
<body>

     <div class="navbar navbar-fixed-top">
      <div class="navbar-inner maincolor">
        <div class="container">
          <a class="btn btn-inverse pull-right micon-hide marright hidelogo" data-toggle="collapse" data-target=".menu-main"><i class="icon-home"></i></a>
		  <div class="logo-secondary"><a href="index.php"><img src="images/logo-minimal.png" /></a></div>
          <div class="nav-collapse collapse menu-main">
            <ul class="nav maincolor">
              <li><a href="index.php">Home</a></li>
              <li><a href="item-page1.php">Sample page</a></li>
			  <li><a href="typography.php">Typography</a></li>
              <li><a href="technology.php">Technology</a></li>
			  <li><a href="https://creativemarket.com/ninebit/1506-NewsBoard-Responsive-Masonry-Theme" target="_new">Buy theme!</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Dropdown menu <i class="icon-caret-down"></i></a>
                <ul id="menu3" class="dropdown-menu maincolor" role="menu" aria-labelledby="drop5">
                  <li><a tabindex="-1" href="#">Action</a></li>
                  <li><a tabindex="-1" href="#">Another action</a></li>
                  <li><a tabindex="-1" href="#">Something else here</a></li>
                  <li><a tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div></div>
        </div>
      </div>


      <div class="navbar navbar-filter navbar-static-top menubar">
      <div class="navbar-inner contrastcolor">
        <div class="container">
          <a class="btn btn-inverse pull-right micon-hide marright" data-toggle="collapse" data-target=".menu-filter"><i class="icon-th"></i></a>
            <div class="logo maincolor"><a href="index.php"><img src="images/logo.png" /></a></div>
            <div class="menu-icon "><a href="#" id="search" rel="popover"><i class="icon-search icon-large contrastcolor icon-srch"></i></a>
            <div id="searchform" class="contrastcolor" style="display:none;">

            <form class="navbar-search pull-left" action="#searching.php" id="searchid">
              <span class="add-on handpoint maincolor" id="buttn-search" onclick="$('#searchid').submit();return false;"><i class="icon-circle-arrow-right icon-large icon-top "></i></span>
              <input type="text" class="search-query maincolor" placeholder="...">
            </form>

            </div>
            <i class="icon-filter icon-large contrastcolor"></i></div>
              <div class="nav-collapse collapse menu-filter">
                <ul class="nav contrastcolor" id="filters">
                  <li><a href="#" data-filter="*">All</a></li>
                  <li><a href="#" data-filter=".cat1">Apple</a></li>
                  <li><a href="#" data-filter=".cat2">Samsung</a></li>
    			  <li><a href="#" data-filter=".cat3">HTC</a></li>
                  <li><a href="#" data-filter=".cat4">Microsoft</a></li>
                  <li><a href="#" data-filter=".cat5">HP</a></li>
                  <li><a href="#" data-filter=".cat6">Sony</a></li>
                  <li><a href="#" data-filter=".cat7">Asus</a></li>
                </ul>
              </div>
           
           </div>
        </div>
      </div>
    <div class="resetheader"></div>
	