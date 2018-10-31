<?php
include("./vendor/autoload.php");

class Stripegateway{
	public function __construct(){
		$stripe = array(
			"secret_key" => "sk_test_8dnb2TVoeEEC8l2WpHc1nyEP",
			"public_key" => "pk_test_fwRPYmzde72TTg2Q0P1cCf6G");

		\Stripe\Stripe::setApiKey($stripe["secret_key"]);
	}

	public function checkout($data){
		$message = "";
		try{
			$mycard = array('number' => $data['number'],
				'exp_month' => $data['exp_month'],
				'exp_year' => $data['exp_year']);
			$charge = \Stripe\Charge::create(array('card' => $mycard,
				'amount' => $data['amount'],
				'currency' => 'usd'));

			$message = $charge->status;
		}catch(Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}

	public function update_charger($data){
		$message = "";
		try{
			$ch = \Stripe\Charge::retrieve($data['ID']);
			$ch ->description = $data['description'];
			$message = $ch->save();
		}catch(Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}

	public function product($data){
		$message = "";
		try{
			$product = \Stripe\Product::create(array(
						  'name' => $data['name'],
						  'caption' => $data['caption'])
						  );
		}catch(Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}

	public function editproduct($data){
		$message = "";
		try{
			$cu = \Stripe\Product::retrieve($data['id']);
			$cu->description = $data['description'];
			$cu->save();
		}catch(Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}
	

	public function delproduct($data){
		$message = "";
		try{
			$del = \Stripe\Product::retrieve($data['ID']);
			$del->delete();
		}catch(Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}

	public function payment_detail($id){
		$message = "";
		try{
			$ch = \Stripe\Charge::retrieve($id);
			$message = $ch->capture();
		}catch(Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}
}