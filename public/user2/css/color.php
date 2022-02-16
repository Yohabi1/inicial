<?php
header ("Content-Type:text/css");
$color = "#746EF1"; // Change your Color Here

function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
    $color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
    $color = "#746EF1";
}

function hex2rgba( $color, $opacity) {

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    if (strlen($color) == 6) {
        list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    $rgb = 'rgba('.$r. ',' .$g .',' .$b. ',' . $opacity.')';

    return $rgb;
}

?>

.navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li:hover,
.single-blog-wrap,
.transaction-table .table tbody tr td::before,
.social-area.social-area-2{
    background : <?php echo  $color ?>;
}

.navbar-area .nav-container .navbar-collapse .navbar-nav li:hover a,
.topbar-area .topbar-content span img, .topbar-area .topbar-content span i,
.section-title h6,
.single-investor-wrap .invest-details h6,
a:active, a:hover,
.single-blog-wrap .blog-details h5 a:hover,
.single-blog-wrap .blog-details .read-more-btn:hover,
.signin-form-area .signin-form .form-group .forgot-password a,
.signin-form-area .signin-bottom .have-account a,
.signin-form-area .signin-form .form-group .icon,
.transaction-table .table thead th,
.transaction-table .table tbody tr:hover td,
.single-fact-count:hover h2,
.banner-inner .video-play-btn:hover{
    color : <?php echo  $color ?>;
}

.single-blog-wrap .blog-details .read-more-btn{
    color : #000;
}

.back-to-top{
    background-color: <?php echo $color ?>;
}