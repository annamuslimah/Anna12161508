<?php
include ('Stripegateway.php');
$myStripe = new Stripegateway();
$data = array('id' => '12345', 'description' => 'grey');
$result = $myStripe->editproduct($data);
	echo "<pre>"; print_r($result);