<?php 
namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\parentCategory;
use App\CategoriesSeo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

Class DelhiveryController extends Controller
{
	/*public function __Construct()
	{
		$this->middleware('auth:admin');
	}*/


	/*
	***  Create Warehouse Address on the Delhivery End
	**
	*/

	public function index(){
		/*$warehouse						=	DB::table('warehouse')->where('active',1)->where('add_delhivery',0)->get();
		$data 							=	array();
		if(!empty($warehouse)){
			//$warehouseArr 				=	json_decode($warehouse,true);

			foreach ($warehouse  as $key) {

				$data 					= array(
					'phone'				=> $key->phone,
                    'city'				=> $key->city,
                    'name'				=> $key->username,
                    'pin'				=> $key->pincode,
                    'address'			=> $key->address,
                    'country'			=>$key->country,
                    'contact_person'	=> $key->contact_person,
                    'email'				=>$key->email,
                    'registered_name'	=> $key->registered_name,
                    'return_address'	=> $key->return_address,
                    'return_pin'		=> $key->return_pin,
                    'return_city'		=> $key->return_city,
                    'return_state'		=> $key->return_state,
                    'return_country'	=> $key->return_country
                );
            
              
				
			}
			if(!empty($data)){
				$data_json = json_encode($data);

				$this->curl_send($data_json);
			

			}

		}*/
		$this->create_order();
	}

	public function create_address()
	{

		$warehouse	=	DB::table('warehouse')->where('active',1)->where('add_delhivery',0)->get();
		exit($warehouse);

	}
	public function curl_send($dataArray){
		$accesstoken		= "Token ".env("token");

		$create_url 		= env('base_url').'api/backend/clientwarehouse/create/';
		$header 			= array();
        $header[] 			= 'Content-type: application/json';
        $header[] 			= 'Accept: application/json';
       	$header[] 			= 'Authorization:'.$accesstoken;
       	
        $ch 				= curl_init();
      	curl_setopt($ch, CURLOPT_URL, $create_url);
      	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      	curl_setopt($ch, CURLOPT_POST, 1);
      	curl_setopt($ch, CURLOPT_POSTFIELDS,$dataArray);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	$response  			= curl_exec($ch);


      	$output 			= json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );

      	print_r($output);
      	
	}
	/*---AWB---------------------*/
	public function create_label(){
		


				$count 				= 1; 
				$base_url 			= "https://track.delhivery.com/";
				$auth_token         = "73384c6a70cee0fcb643b3b5d192033e39e35879";
              $accesstoken 			= 'Token '.$auth_token; 
              $url 					= $base_url.'api/wbn/bulk.json?count='.$count;
              $ch 					= curl_init($url);
              $header[] 			= 'Content-type: application/json';
              $header[] 			= 'Accept: application/json';
              $header[] 			= 'Authorization:'.$accesstoken;
              curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              $results = curl_exec($ch);

              if(curl_errno($ch))
              {
                print curl_error($ch);
              }
                
              else
              {
                  curl_close($ch);
              }
              $output = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $results), true );
              $awb_res_vlaue = json_encode($output);
              $awb_data_header = json_encode($header);
              print_r($output);
              exit();
	}

	/*---------------CREATE ORDER------------------*/
	public function create_order(){
			$base_url 			= "https://staging-express.delhivery.com/";
			$auth_token         = "061efc528cb7b589b96cd6737a76e5ab175c497c";
            $accesstoken 		= 'Token '.$auth_token;
            $data_pin = array('pin'=> '400092',
                      'add'=> "G-2, Arvind Apartment, L.Y. Road,Boriwali west",
                      'phone'=> "9769752063",
                      'state'=> "Maharastra",
                      'city'=> "Mumbai",
                      'country'=>"India",
                      'name'=> "warehouseUpavan"
                      );
            $order_date	=	"2022-08-04";
      		$prefix = $data_ship_json = '';
      		$waddress = "dsdlkld";
      		$seller_invoice = "";
      		$consignee_tin_no="";
      		$cdate = "2022-08-04";
      		$quantity="1";
      		$cst_no= "45545454785";
      		$wname = "Priyanka";
      		$payment_method = "COD";
      		$source_key="";


            $data_ship = array('return_name'=> "Rahul",
                'return_pin'=> '400065',
                'return_city'=> 'Mumbai',
                'return_phone'=> '9319635278',
                'return_add'=> 'Arraye nagar colony',
                'return_state'=>'Maharastra',
                'return_country'=> 'India',
                'order'=> '1234567',
                'phone'=> '9319635278',
                'products_desc'=> 'gdhs',
                'product_type'=>'',
                'cod_amount'=> '250',
                'name'=> 'RAhul' ,
                'waybill'=> '5875910000022',
                        'country'=>"India",
                        'order_date'=> $order_date,
                        'total_amount'=> "250",
                        'seller_add'=>$waddress,
                        'seller_cst'=> $cst_no,
                        'add'=>'Arraye nagar colony' ,
                        'seller_name'=> $wname,
                        'seller_inv'=>$seller_invoice,
                        'seller_tin'=> $consignee_tin_no,
                        /*'seller_gst_tin' => $gst_no,*/
                        'seller_inv_date'=> $cdate,
                        'pin'=>'400065',
              'quantity'=> $quantity,
              'payment_mode'=> $payment_method,
              'state'=> "Maharastra",
              'city'=> "Mumbai",
              'supplier' => '',
              'extra_parameters' => '',
              'shipment_width' => '',
              'shipment_height' => '',
              'consignee_tin' => '',
              'tax_value' => '',
              'sales_tax_form_ack_no' => '',
              'category_of_goods' => '',
              'commodity_value'=> '',
              'e_waybill'=>"5875910000022",
              'source' =>$source_key
                        );

            /*$data_ship 		=	array(
            	'add'		=>	'Arrey Nagr Colony',
            	'phone'		=>	'9137106578',
            	'payment_mode' => 'cod',
            	'name'		=>	'Rahul Kumar',
            	'order'		=>	'123456789',
            	'cosignee_gst_amount' => '100',
            	'integrated_gst_amount' => '150',
            	'ewbn'=>'',
            	'cosignee_gst_tin'=>'85748961478',
            	'hsn_code'=>'8421',
            	'gst_cess_amount'=>'5'
            );   */         


            $data_ship_js = json_encode($data_ship);
            $data_ship_json .= $prefix.$data_ship_js;
            $prefix = ','; 

            $data_pin_json = json_encode($data_pin);
        
        	$data_json = 'format=json&data={
          		"pickup_location": '.$data_pin_json.',
        		"shipments": [
          			'.$data_ship_json.'
        		]
      		}'; 




			$create_url 		= $base_url.'api/cmu/create.json';
            $accesstoken 		= 'Token '.$auth_token; 
            $header 			= array();
            $header[] = 'Content-type: application/json';
            $header[] = 'Accept: application/json';
            $header[] = 'Authorization:'.$accesstoken;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $create_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);

            $outputs = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );

            print_r($outputs);
            exit();
	}
}