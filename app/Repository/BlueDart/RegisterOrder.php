<?php

namespace App\Repository\BlueDart;

use SoapHeader;
use App\Product;
use App\Repository\BlueDart\DebugSoapClient;

class RegisterOrder extends DebugSoapClient
{
    protected $soap;
    protected $order;

    public function __construct()
    {
        $this->soap = new DebugSoapClient('http://netconnect.bluedart.com/Ver1.8/ShippingAPI/Pickup/PickupRegistrationService.svc?wsdl',
        array(
            'trace' 	   => 1,
            'style'	       => SOAP_DOCUMENT,
            'use'          => SOAP_LITERAL,
            'soap_version' => SOAP_1_2
        ));

        $this->soap->__setLocation('http://netconnect.bluedart.com/Ver1.8/ShippingAPI/Pickup/PickupRegistrationService.svc?wsdl');

        $this->soap->sendRequest = true;
        $this->soap->printRequest = false;
        $this->soap->formatXML = true;

        $actionHeader = new SoapHeader('http://www.w3.org/2005/08/addressing','Action','http://tempuri.org/IPickupRegistration/RegisterPickup',true);
        $this->soap->__setSoapHeaders($actionHeader);
    }

    public function register($order, $data)
    {

        // dd($order);

        $this->order = $order;
        
        $weight = "0.5";

        if($order->order_total_weight == "0")
        {
            $weight = "0.5";
        }
        else
        {
            $weight = $order->order_total_weight;
        }

        $name = "";

        if(isset($order->user->name))
        {
            $name = str_limit($order->user->name??"", 29);
        }
        else
        {
            $name = str_limit($order->contact_person, 29);
        }


        $params = array(

        'request' =>

        array (

            'AreaCode' => config('bluedart.areacode'),
            'ContactPersonName' => $name,                     
            'CustomerAddress1' => config('bluedart.clientaddress1'),                  
            'CustomerAddress2' => config('bluedart.clientaddress2'),
            'CustomerAddress3' => config('bluedart.clientaddress3'),
            'CustomerCode' => config('bluedart.clientcode'),
            'CustomerName' => $name,
            'CustomerPincode' => config('bluedart.pincode'),
            'CustomerTelephoneNumber' => config('bluedart.phone'),
            'DoxNDox' => '2',
            'EmailID' => config('bluedart.clientemail'),
            'MobileTelNo' => config('bluedart.phone'),
            'NumberofPieces' => array_sum(json_decode($order->product_qty))>0?array_sum(json_decode($order->product_qty)):1,
            'OfficeCloseTime' => '16:00',
            'ProductCode' => 'A',
            'SubProductCode' => $order->payment->method == 'cod' ? 'C' : 'P',
            'ReferenceNo' => $order->payment->tid ?? null,
            'Remarks' => $data['remark'] ?? '',
            'RouteCode' => '99',
            'ShipmentPickupDate' => date('Y-m-d', strtotime($data['pickup_date'])),
            'ShipmentPickupTime' => $data['pickup_time'],
            'VolumeWeight' => $weight,
            'WeightofShipment' => $weight,
            'isToPayShipper' => $order->payment->method == 'cod' ? 'Y' : 'N' 

        ),

        'profile' =>

        array(

            'Api_type' => 'S',
            'LicenceKey'=> config('bluedart.licensekey'),
            'LoginID'=> config('bluedart.loginid'),
            'Version'=> config('bluedart.apiversion'))

        );

        // dd($params);

        $result = $this->soap->__soapCall('RegisterPickup',array($params));
        $obj_array = get_object_vars($result);

        $status = get_object_vars($obj_array['RegisterPickupResult']->Status);

 /*print_r($status);
 print_r($status['ResponseStatus'][0]->StatusCode);
die(); new code */
        /*if ($status['ResponseStatus'][0]->StatusCode == 'InsertSuccess' || ($status['ResponseStatus'][0]->StatusCode == 'InsertFailure' && $status['ResponseStatus'][0]->StatusInformation == 'PickupIsAlreadyRegister' )) {
            
            return [
                'status' => true,
                'message' => $obj_array['RegisterPickupResult']->TokenNumber,
            ];
            
        }*/

if ($status['ResponseStatus']->StatusCode == 'InsertSuccess' || ($status['ResponseStatus']->StatusCode == 'InsertFailure' && $status['ResponseStatus']->StatusInformation == 'PickupIsAlreadyRegister' )) {
            
            return [
                'status' => true,
                'message' => $obj_array['RegisterPickupResult']->TokenNumber,
            ];
            
        }

        return [
            'status' => false,
            'message' =>$status['ResponseStatus']->StatusInformation,
        ];

    }

}
