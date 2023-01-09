<?php

namespace App\Repository\BlueDart;

use SoapHeader;
use App\Repository\BlueDart\DebugSoapClient;

class Awb extends DebugSoapClient
{

    protected $soap;
    protected $commodities = [];

    public function __construct()
    {
        $this->soap = new DebugSoapClient('https://netconnect.bluedart.com/Ver1.8/ShippingAPI/WayBill/WayBillGeneration.svc?wsdl',
        array(
            'trace'         => 1,
            'style'         => SOAP_DOCUMENT,
            'use'           => SOAP_LITERAL,
            'soap_version'  => SOAP_1_2
        ));

        $this->soap->__setLocation("https://netconnect.bluedart.com/Ver1.8/ShippingAPI/WayBill/WayBillGeneration.svc?wsdl");

        $this->soap->sendRequest = true;
        $this->soap->printRequest = false;
        $this->soap->formatXML = true;

        $actionHeader = new SoapHeader('http://www.w3.org/2005/08/addressing','Action','http://tempuri.org/IWayBillGeneration/GenerateWayBill',true);
        $this->soap->__setSoapHeaders($actionHeader);
    }

    public function download($order)
    {
        $order->load('payment');

         $weight = "1";

        if($order->order_total_weight == "0")
        {
            $weight = "1";
        }
        else
        {
            $weight = $order->order_total_weight;
        }


        $params = array(
        'Request' =>
        array 
        (
            'Consignee' =>
            array 
            (
                'ConsigneeAddress1' => $order->address_line_0,
                'ConsigneeAddress2' => $order->address_line_1,
                'ConsigneeAddress3'=> $order->address_line_2,
                'ConsigneeAttention'=> substr($order->contact_person, 0, 30),
                'ConsigneeMobile'=> $order->contact_number,
                'ConsigneeName'=> substr($order->contact_person, 0, 30),
                'ConsigneePincode'=> $order->pincode,
                'ConsigneeTelephone'=> '',
            ),
            'Services' =>
            array 
            (
                'ActualWeight' => $weight,
                'CollectableAmount' => $order->payment->method == 'cod' ? $order->total+ $order->delevery_charge?? 0 : 0 ,
                'Commodity' =>
                array (
                    'CommodityDetail1' => $this->getCommodityDetail($order, 0),
                    'CommodityDetail2'  => $this->getCommodityDetail($order, 1),
                    'CommodityDetail3' => $this->getCommodityDetail($order, 2)
                ),
                'CreditReferenceNo' => $order->payment->tid,
                'DeclaredValue' => floatval($order->order_price),
                'Dimensions' =>
                array (
                    'Dimension' => orderDimensions($order)
                ),
                'InvoiceNo' => $order->id,
                'PackType' => '',
                'PickupDate' => $order->BdOrder->pickup_date,
                'PickupTime' => str_replace(':', '', substr($order->BdOrder->pickup_time, 0, 5)),
                'PieceCount' => 1,
                'ProductCode' => 'A',
                'ProductType' => 'Dutiables',
                'SpecialInstruction' => substr($order->BdOrder->remark, 0, 50),
                'SubProductCode' => $order->payment->method == 'cod' ? 'C' : 'P',
            ),
            'Shipper' =>
            array
            (
                'CustomerAddress1' => config('bluedart.clientaddress1'),
                'CustomerAddress2' => config('bluedart.clientaddress2'),
                'CustomerAddress3' => config('bluedart.clientaddress3'),
                'CustomerCode' => config('bluedart.clientcode'),
                'CustomerEmailID' => config('bluedart.clientemail'),
                'CustomerMobile' => config('bluedart.phone'),
                'CustomerName' => config('bluedart.clientname'),
                'CustomerPincode' => config('bluedart.pincode'),
                'CustomerTelephone' => config('bluedart.telephone'),
                'IsToPayCustomer' => '',
                'OriginArea' => config('bluedart.areacode'),
                'Sender' => '1',
                'VendorCode' => ''
            )
        ),
        'Profile' =>
        array(
            'Api_type' => 'S',
            'LicenceKey'=> config('bluedart.licensekey'),
            'LoginID'=> config('bluedart.loginid'),
            'Version'=> config('bluedart.apiversion'))
        );


     

        $result = $this->soap->__soapCall('GenerateWayBill',array($params));
        $obj_array = get_object_vars($result);


        if ($obj_array['GenerateWayBillResult']->AWBPrintContent) 
        {
            $order->BdOrder->awb_pdf = utf8_encode($obj_array['GenerateWayBillResult']->AWBPrintContent);
        }

        // dd($obj_array);


        $order->BdOrder->awb_no = $obj_array['GenerateWayBillResult']->AWBNo;
        $order->BdOrder->CCRCRDREF = $obj_array['GenerateWayBillResult']->CCRCRDREF;
        $order->BdOrder->dest_area = $obj_array['GenerateWayBillResult']->DestinationArea;
        $order->BdOrder->dest_loc = $obj_array['GenerateWayBillResult']
                                    ->DestinationLocation;
        $order->BdOrder->save();

    }

    protected function getCommodityDetail($order, $index)
    {
        if (count($this->commodities) == 0) {
            $this->commodities = json_decode($order->product_name);
        }
        return substr(($this->commodities[$index] ?? ''), 0, 30);
    }

}
