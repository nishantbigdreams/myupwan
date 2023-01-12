<?php

namespace App\Repository\BlueDart;

use SoapHeader;
use App\Product;
use App\Repository\BlueDart\DebugSoapClient;

class ReturnOrder extends DebugSoapClient
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

    public function returnOrder($order , $data)
    {
                $order->load('payment');

        $params = array(
        'Request' =>
        array (
            'Consignee' =>
            array (
                'ConsigneeAddress1' =>  $order->address_line_0,
                'ConsigneeAddress2' => $order->address_line_1,
                'ConsigneeAddress3'=>  $order->address_line_2,
                'ConsigneeAttention'=> substr($order->contact_person,0,30),
                'ConsigneeMobile'=> substr($order->contact_number,0,30),
                'ConsigneeName'=> substr($order->contact_person,0,30),
                'ConsigneePincode'=> $order->pincode,
                'ConsigneeTelephone'=> '',
            )   ,
            'Services' =>
            array (
                'ActualWeight' => orderWeight($order),
                'CollectableAmount' => 0 ,
                'Commodity' =>
                array (
                    'CommodityDetail1' => $this->getCommodityDetail($order, 0),
                    'CommodityDetail2'  => $this->getCommodityDetail($order, 1),
                    'CommodityDetail3' => $this->getCommodityDetail($order, 2)
                ),
                'CreditReferenceNo' => $order->returnOrder->invoice_no,
                'DeclaredValue' => floatval($order->order_price),
                'Dimensions' =>
                array (
                    'Dimension' => orderDimensions($order)
                ),
                'InvoiceNo' => $order->id,//payment->invoice_no,
                'PackType' => '',
                'PickupDate' => date('Y-m-d',strtotime($data['pickup_date'])),
                'PickupTime' => str_replace(':','',$data['pickup_time']),
                'PieceCount' => array_sum(json_decode($order->product_qty)),
                'ProductCode' => 'A',
                'ProductType' => 'Dutiables',
                'SpecialInstruction' => $data['remark'] ?? '',
                'SubProductCode' => 'P',
                'IsReversePickup' => 'True',
                'isToPayCustomer' => 'True',
            ),
            'Shipper' =>
            array(
                'CustomerAddress1' =>  config('bluedart.clientaddress1'),
                'CustomerAddress2' =>  config('bluedart.clientaddress2'),
                'CustomerAddress3' =>  config('bluedart.clientaddress3'),
                'CustomerCode' =>       config('bluedart.clientcode'),
                'CustomerEmailID' =>   config('bluedart.clientemail'),
                'CustomerMobile' =>    config('bluedart.phone'),
                'CustomerName' =>      substr(config('bluedart.clientname'), 0, 30),
                'CustomerTelephone' => config('bluedart.telephone'),
                'isToPayCustomer' => 'True',
                'CustomerPincode' =>   config('bluedart.pincode'),
                'OriginArea' => 'BOM',
                'Sender' => 'Novasell',
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

        if ($obj_array['GenerateWayBillResult']->AWBPrintContent) {
            $order->returnOrder->awb_pdf = utf8_encode($obj_array['GenerateWayBillResult']->AWBPrintContent);
        }

        $order->returnOrder->awb_no = $obj_array['GenerateWayBillResult']->AWBNo;
        $order->returnOrder->CCRCRDREF = $obj_array['GenerateWayBillResult']->CCRCRDREF;
        $order->returnOrder->status = 'registered';
        $order->returnOrder->return_order_pickup_date = date('Y-m-d',strtotime($data['pickup_date']));
        $order->returnOrder->pickup_time = $data['pickup_time'] ?? '';
        $order->returnOrder->remark = $data['remark'] ?? '';

        $order->returnOrder->save();

        $order->status = 'return_registered';

        $order->save();

        return true;

    }

    protected function getCommodityDetail($order, $index)
    {
        if (count($this->commodities) == 0) {
            $this->commodities = json_decode($order->product_name);
        }
        return substr(($this->commodities[$index] ?? ''), 0, 30);
    }

}
