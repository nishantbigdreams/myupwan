<?php

namespace App\Repository\BlueDart;

use SoapHeader;
use App\PincodeShipping;
use App\Repository\BlueDart\DebugSoapClient;

class ShipToPincode extends DebugSoapClient
{
    protected $soap;
    protected $is_shipment_available = 'no';

    public function __construct()
    {
        $this->soap = new DebugSoapClient('http://netconnect.bluedart.com/Ver1.8/ShippingAPI/Finder/ServiceFinderQuery.svc?wsdl',
        array(
            'trace'       => 1,
            'style'       => SOAP_DOCUMENT,
            'use'         => SOAP_LITERAL,
            'soap_version'=> SOAP_1_2
        ));

        $this->soap->__setLocation('http://netconnect.bluedart.com/Ver1.8/ShippingAPI/Finder/ServiceFinderQuery.svc?wsdl');

        $this->soap->sendRequest = true;
        $this->soap->printRequest = false;
        $this->soap->formatXML = true;


        $actionHeader = new SoapHeader('http://www.w3.org/2005/08/addressing','Action','http://tempuri.org/IServiceFinderQuery/GetServicesforPincode',true);
        $this->soap->__setSoapHeaders($actionHeader);
    }

    public function isShipmentAvailableToPincode($pincode)
    {
        $check = PincodeShipping::where('pincode', $pincode)->first();
        session(['user.pincode' => $pincode]);
        if ($check) {
            return 'Yes';
        }else{
            return 'No';
        }

        $param = array('pinCode' => $pincode,
        'profile' =>
        array(
            'Api_type' => 'S',
            'LicenceKey'=> config('bluedart.licensekey'),
            'LoginID'=> config('bluedart.loginid'),
            'Version'=> config('bluedart.apiversion'))
        );

        $result = $this->soap->__soapCall('GetServicesforPincode',array($param));

        try {
            $obj_array = get_object_vars($result);
            $this->is_shipment_available = $obj_array['GetServicesforPincodeResult']->ApexInbound;

        }catch(Exception $e){
            return $e->message();
        }
        
        if ($this->is_shipment_available =='Yes') {
            PincodeShipping::create([
                'pincode' => $pincode
            ]);
        }

        return $this->is_shipment_available;
    }

}
