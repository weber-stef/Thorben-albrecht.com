<?php
/**
 * @version 3.0
 * @package LocationMap
 * @copyright 2009 OrdaSoft
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @description Location map for Joomla 3.0
*/
//require_once(dirname(__FILE__)."/mod_location_map.php");
defined( '_JEXEC' ) or die( 'Restricted access' );
$pr = rand();
?>
<style>
#map_canvas<?php echo $pr; ?> img {
max-width: none !important;
}
</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" ></script>
<noscript>Javascript is required to use Google Maps location Joomla module <a href="http://ordasoft.com/location-map.html">Google Maps location module
for Joomla </a>, 

<a href="http://ordasoft.com/location-map.html">Google Maps location module
for Joomla</a></noscript>
<script type="text/javascript">
window.addEvent('domready', function() {
     var map;
     var marker = new Array();
     var infowindow = new Array();
     var myOptions = {
       zoom: <?php echo $params->get('zoom'); ?>,
       center: new google.maps.LatLng(<?php echo $params->get('latitude'); ?>, <?php echo $params->get('longitude'); ?>),
       <?php if ($params->get('menu_map') == 0) echo "mapTypeControl: false,";?>
       <?php if ($params->get('control_map') == 0) echo "zoomControl: false, panControl: false, streetViewControl: false,";?>
       mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     var map = new google.maps.Map(document.getElementById("map_canvas<?php echo $pr; ?>"), myOptions);

     <?php
     $text = explode("\n", $params->get('messag'));
     for ($i = 0; $i < count($text); $i++)
     {
	$value = explode(";", $text[$i]);
     ?>
        marker.push(new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo trim($value[0]); ?>, <?php echo trim($value[1]); ?>),
        map: map
	}));

	infowindow.push(new google.maps.InfoWindow({
	content: "<?php echo trim($value[2]); ?>"
	}));
	
	google.maps.event.addListener(marker[<?php echo $i; ?>], 'mouseover', function() {
	<?php
	for ($j = 0; $j < count($text); $j++)
	{
	?>
	    infowindow[<?php echo $j; ?>].close(map,marker[<?php echo $j; ?>]);
	<?php
	}
	?>
	infowindow[<?php echo $i; ?>].open(map,marker[<?php echo $i; ?>]);
	});
     <?php
     }
     ?>
});

</script>

  <div class="map" id="map_canvas<?php echo $pr; ?>" style=
      "width: <?php echo $params->get('map_width');?>px; height: <?php echo $params->get('map_height'); ?>px;
      border: 1px solid black; float: rigth;" >
  </div>

