<?php 
/*
Plugin Name: RSV 360 View
Plugin URI: http://www.rapidsort.in
Description: Plugin for displaying Image as 360 view
Author: Rapid Sort
Version: 1.0
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
function rsv360_enqueued_assets() {
	wp_enqueue_script( 'jquery-reel', plugin_dir_url( __FILE__ ) . 'jquery.reel.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-mousewheel', plugin_dir_url( __FILE__ ) . 'jquery.mousewheel.min.js', array(), '1.0', true );	
}
add_action( 'wp_enqueue_scripts', 'rsv360_enqueued_assets',40 );
	

function rsv360_func( $atts ) {
    $a = shortcode_atts( array(
        'src' => 'image',
    ), $atts );
	
	
if(!isset($atts['image'])){
	$atts['image']=plugin_dir_url( __FILE__ )."image.jpg";
}
if(!isset($atts['width'])){
	$atts['width']="900";
}
if(!isset($atts['height'])){
	$atts['height']="300";
}
if(!isset($atts['stitched'])){
	$atts['stitched']="4320";
}
	

$output="<img class='reel result' src='".$a['src']."'";	
foreach($atts as $k=>$v){
	if($k=="width" || $k=="height"){
		$output.=$k."=".$v." ";
	}else{
		$output.="data-".$k."=".$v." ";
	}
}
$output.=">";	
return $output;
}
add_shortcode( 'rsv360_view', 'rsv360_func' );


add_action( 'admin_menu', 'rsv360_plugin_menu' );
function rsv360_plugin_menu() {
	add_options_page( 'RSV 360 View Options', 'RSV 360 View', 'manage_options', 'rsv-360-view', 'rsv360_plugin_options' );
}
function rsv360_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	?>

<h2>RSV 360 View Options</h2>
<p>Plugin for displaying Image as 360 Degree View</p>
<div class="updated ">
  <p><strong>Use This Short Code:</strong> [rsv360_view image="image.jpg" width="900" height="300" stitched="4320" responsive="true"]</p>
</div>
<h3>Other Properties</h3>
<table class="widefat" cellspacing="0">
  <thead>
    <tr>
      <th class="manage-column column-columnname" scope="col"><strong>Type</strong></th>
      <th class="manage-column column-columnname" scope="col"><strong>Option</strong></th>
      <th class="manage-column column-columnname" scope="col"><strong>Default</strong></th>
      <th class="manage-column column-columnname" scope="col"><strong>Description</strong></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
    <th class="manage-column column-columnname" scope="col"><strong>Type</strong></th>
      <th class="manage-column column-columnname" scope="col"><strong>Option</strong></th>
      <th class="manage-column column-columnname" scope="col"><strong>Default</strong></th>
      <th class="manage-column column-columnname" scope="col"><strong>Description</strong></th>
    </tr>
  </tfoot>
  <tbody>
    <tr>
      <td class="type">jQuery</td>
      <td class="option"> area </td>
      <td class="default">undefined</td>
      <td class="usage"> Use jQuery to extend the area sensitive to mouse or touch interaction.
        Will use the area of the image if left <strong>undefined</strong> . </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Object</td>
      <td class="option"> attr </td>
      <td class="default">{}</td>
      <td class="usage"> Initial attribute-value pairs map for the IMG tag.
        Useful for dynamically setting up image dimensions. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> brake </td>
      <td class="default">0.23</td>
      <td class="usage"> Braking force applied when slowing down the free spinning when dragged or thrown. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> clickfree </td>
      <td class="default">false</td>
      <td class="usage"> Binds to mouse leave/enter events instead of down/up mouse events. </td>
    </tr>
    <tr>
      <td class="type">String</td>
      <td class="option"> cursor </td>
      <td class="default">undefined</td>
      <td class="usage"> Mouse cursor overriding the default one. 
        You can use either <strong>hand</strong> for a grabbing palm of hand or any valid CSS `cursor` value. 
        Reel's cursors are by default served by Reel's
        CDN . </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> cw </td>
      <td class="default">false</td>
      <td class="usage"> If your Reel image motion doesn't follow the mouse when dragged 
        (moves in opposite direction), set this to <strong>true</strong> to indicate clockwise organization of frames. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> delay </td>
      <td class="default">0</td>
      <td class="usage"> Delay before Reel starts playing by itself (in seconds). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> directional </td>
      <td class="default">false</td>
      <td class="usage"> Two sets of frames are used when <strong>true</strong> - one set for forward followed by one for backward motion. </td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> draggable </td>
      <td class="default">true</td>
      <td class="usage"> Allows mouse or finger drag interaction when <strong>true</strong> (allowed by default). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> duration </td>
      <td class="default">undefined</td>
      <td class="usage"><em class="new">NEW</em> Animation playback duration (in seconds). </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> entry </td>
      <td class="default">undefined</td>
      <td class="usage"> Speed of the opening animation in Hz. Defaults to value of
        speed option. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> footage </td>
      <td class="default">6</td>
      <td class="usage"> Number of frames per line (when horizontal) or 
        per column (when vertical). </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> frame </td>
      <td class="default">1</td>
      <td class="usage"> Initial frame. Plugin instance starts with this frame. Frame 1 is the top left corner of the image. Thus loaded with the highest priority (as all frames in the top row 
        not matter if horizontal or vertical). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> frames </td>
      <td class="default">36</td>
      <td class="usage"> Total number of frames. </td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> framelock </td>
      <td class="default">false</td>
      <td class="usage"><em class="new">NEW</em> In multi-row setup, this allows the frame to be locked in place 
        leaving just the vertical interaction possible. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Function</td>
      <td class="option"> graph </td>
      <td class="default">undefined</td>
      <td class="usage"> Custom graph function. </td>
    </tr>
    <tr>
      <td class="type">String</td>
      <td class="option"> hint </td>
      <td class="default">""</td>
      <td class="usage"> Text hint for hotspot tooltip. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> horizontal </td>
      <td class="default">true</td>
      <td class="usage"> Flow of frames on the sheet. 
        Default is line-by-line rather than column-by-column. </td>
    </tr>
    <tr>
      <td class="type">String</td>
      <td class="option"> image </td>
      <td class="default">undefined</td>
      <td class="usage"> Allows to override default sprite resolution based on IMG src filename by passing the path to the image sprite directly. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">String</td>
      <td class="option"> images </td>
      <td class="default">""</td>
      <td class="usage"> Filename string for series of images like `"image_###.jpg"`, where the `#` counter placeholder is replaced with an actual counter numbers. 
        This is much faster than the alternative Array notation. </td>
    </tr>
    <tr>
      <td class="type">Array</td>
      <td class="option"> images </td>
      <td class="default">[]</td>
      <td class="usage"> You can also define images as a raw Array to gain complete control. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> indicator </td>
      <td class="default">0</td>
      <td class="usage"> Can display a range progress indicator inside the image. By passing a positive value in pixels a black rectangle marker will stick to the bottom edge of your image. 
        Customize the color by CSS. Its class name is <strong>reel-indicator</strong></td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> inversed </td>
      <td class="default">false</td>
      <td class="usage"> Flags inversed organization of frames in orbital object movie. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">String</td>
      <td class="option"> klass </td>
      <td class="default">""</td>
      <td class="usage"> You can pass your custom CSS class name for the plugin 
        DOM node. It will accompany the fixed <strong>reel</strong> base class. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> laziness </td>
      <td class="default"> 6 </td>
      <td class="usage"> On "lazy" devices tempo is divided by this divisor 
        for better performance. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> loops </td>
      <td class="default">true</td>
      <td class="usage"> Can be used to suppress default wrap around behavior of the sequence. Use this option when your captured sequence 
        is a incomplete revolution. </td>
    </tr>
    <tr>
      <td class="type">String</td>
      <td class="option"> monitor </td>
      <td class="default">undefined</td>
      <td class="usage"> For development you can monitor any stored value 
        in the upper left corner of the viewport by passing its name.
        Customize it using CSS. Its class name is <strong>reel-monitor</strong></td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> opening </td>
      <td class="default">0</td>
      <td class="usage"> Duration of opening animation (in seconds). </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> orbital </td>
      <td class="default">0</td>
      <td class="usage"> View centering tolerance (in frames) for dual-orbit object movies. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> orientable </td>
      <td class="default">false</td>
      <td class="usage"><em class="new">NEW</em> Enables interaction via device's built-in gyroscope (if available). </td>
    </tr>
    <tr>
      <td class="type">String</td>
      <td class="option"> path </td>
      <td class="default">undefined</td>
      <td class="usage"> URL path to be prepended to either
        image or
        images filenames. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">String</td>
      <td class="option"> preload </td>
      <td class="default">"fidelity"</td>
      <td class="usage"> Preloading mode affecting the order of images loaded. <strong>linear</strong> gives you loading from number 1 to the last frame, 
        whilst <strong>fidelity</strong> produces more evenly spread-out order. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> preloader </td>
      <td class="default">4</td>
      <td class="usage"> Size (height) of a image loading indicator (in pixels). Indicator appears along the bottom edge of Reel image 
        when using
        images sequence. 
        Customize it using CSS. Its class name is <strong>reel-preloader</strong></td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> rebound </td>
      <td class="default">0.5</td>
      <td class="usage"> Time spent on the edge (in seconds) of a non-looping panorama before it bounces back. </td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> responsive </td>
      <td class="default">false</td>
      <td class="usage"><em class="new">NEW</em> If switched to responsive mode, Reel will obey dimensions of its parent container, 
        will grow to fit and will adjust the interaction and UI accordingly (and also on resize). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> revolution </td>
      <td class="default">undefined</td>
      <td class="usage"> Distance in pixels the mouse must be dragged to cause one full revolution
        (when <strong>undefined</strong> it defaults to double the viewport width or half the
        stitched option). </td>
    </tr>
    <tr>
      <td class="type">Object</td>
      <td class="option"> revolution </td>
      <td class="default">undefined</td>
      <td class="usage"> For multi-row movies you can optionally define individual revolutions for both <strong>x</strong> and <strong>y</strong> axis. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> row </td>
      <td class="default">1</td>
      <td class="usage"> Initial row for multi-row setups. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> rows </td>
      <td class="default">0</td>
      <td class="usage"> Number of rows for a multi-row setup (default 0 means single-row setup). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> rowlock </td>
      <td class="default">false</td>
      <td class="usage"><em class="new">NEW</em> In multi-row setup, this allows the row to be locked in place 
        leaving just the horizontal interaction possible. </td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> scrollable </td>
      <td class="default">true</td>
      <td class="usage"> Allows page scroll (allowed by default; applies only to touch devices). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> shy </td>
      <td class="default">false</td>
      <td class="usage"><em class="new">NEW</em> In shy mode, Reel will preinitialize, but won't load until actually clicked. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> spacing </td>
      <td class="default">0</td>
      <td class="usage"> Spacing between frames on the sheet (in pixels). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> speed </td>
      <td class="default">0</td>
      <td class="usage"> Animated rotation speed in revolutions per second (Hz). Animation is disabled by default (0). </td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> steppable </td>
      <td class="default">true</td>
      <td class="usage"> Allows to step the view (horizontally) by clicking on image. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> stitched </td>
      <td class="default"> 0 </td>
      <td class="usage"> Pixel width of stitched panorama image. If supplied the default frame-by-frame behavior changes to panoramic behavior which works with the classic style 
        panorama. </td>
    </tr>
    <tr>
      <td class="type">String</td>
      <td class="option"> suffix </td>
      <td class="default">"-reel"</td>
      <td class="usage"> A portion of the sheet filename inserted right before image type extension. For example, for an image /path/to/image.jpg 
        the sheet will be /path/to/image<strong>-reel</strong>.jpg by default. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> tempo </td>
      <td class="default">25</td>
      <td class="usage"> Shared animation ticker tempo in ticks per second. Doesn't affect the speed. </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> timeout </td>
      <td class="default">2</td>
      <td class="usage"> Idle timeout after which animation is resumed (in seconds). </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Boolean</td>
      <td class="option"> throwable </td>
      <td class="default">true</td>
      <td class="usage"> Allows drag &amp; throw interaction (allowed by default). </td>
    </tr>
    <tr>
      <td class="type">Number</td>
      <td class="option"> throwable </td>
      <td class="default"></td>
      <td class="usage"> Maximal velocity when thrown. </td>
    </tr>
    <tr class="alternate" valign="top">
      <td class="type">Number</td>
      <td class="option"> velocity </td>
      <td class="default">0</td>
      <td class="usage"> Initial velocity of user interaction; washes off quickly with
        brake . </td>
    </tr>
    <tr>
      <td class="type">Boolean</td>
      <td class="option"> vertical </td>
      <td class="default">false</td>
      <td class="usage"> Switches orbital object movie to vertical mode. </td>
    </tr>
  </tbody>
</table>
<?php	
	echo '</div>';
}
?>
