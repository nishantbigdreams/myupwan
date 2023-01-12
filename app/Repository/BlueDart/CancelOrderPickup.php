<?php

namespace App\Repository\BlueDart;

use SoapHeader;
use App\Repository\BlueDart\DebugSoapClient;

class CancelOrderPickup extends DebugSoapClient
{
    protected $soap;

    public function __construct()
    {
        $this->soap = new DebugSoapClient('https://netconnect.bluedart.com/Ver1.8/ShippingAPI/Pickup/PickupRegistrationService.svc?wsdl',
        array(
            'trace' 							=> 1,
            'style'								=> SOAP_DOCUMENT,
            'use'									=> SOAP_LITERAL,
            'soap_version' 				=> SOAP_1_2
        ));

        $this->soap->__setLocation('https://netconnect.bluedart.com/Ver1.8/ShippingAPI/Pickup/PickupRegistrationService.svc?wsdl');

        $this->soap->sendRequest = true;
        $this->soap->printRequest = false;
        $this->soap->formatXML = true;


        $actionHeader = new SoapHeader('http://www.w3.org/2005/08/addressing','Action','http://tempuri.org/IServiceFinderQuery/GetServicesforPincode',true);
        $this->soap->__setSoapHeaders($actionHeader);
    }

    public function cancelPickup()
    {
        $param = array('pinCode' => $pincode,
        'profile' =>
        array(
            'Api_type' => 'T',
            'LicenceKey'=>'1cc917abc001d530c182f0c4cdfd4e17',
            'LoginID'=>'398226',
            'Version'=>'1.3')
        );
        $result = $this->soap->__soapCall('GetServicesforPincode',array($param));

        $result = $this->soap->__soapCall('RegisterPickup',array($params));
        $obj_array = get_object_vars($result);
        print_r($obj_array);
        exit();
        return $obj_array['RegisterPickupResult']->TokenNumber;
    }

}
