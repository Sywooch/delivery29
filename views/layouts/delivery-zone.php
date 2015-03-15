<?php 
	$dZone = \app\models\DeliveryZone::getActive();
	$jdZone = json_encode($dZone);
?>
<script>
var deliveryZones = JSON.parse('<?php echo $jdZone?>');
</script>