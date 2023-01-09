<?php

namespace App\Repository\BlueDart;

use SoapClient;

class DebugSoapClient extends SoapClient {
    public $sendRequest = true;
    public $printRequest = false;
    public $formatXML = false;

    //blue dart credentials
    public $bluedart = array(
       'areacode'       => 'BOM',
        'clientcode'    => '398226',
        'loginid'       => 'BOM07487',
        'licensekey'    => '1cc917abc001d530c182f0c4cdfd4e17',
        'apiversion'    => '1.3',
        'clientname'    => 'ARU ENTERPRISES',
        'clientaddress1'=> 'A/1, Abu Asad Premise,',
        'clientaddress2'=> 'Above Choice Bakery, Marol,',
        'clientaddress3'=> 'Mumbai, Maharashtra',
        'pincode'       => '400059',
        'phone'         => '8928205865',
        'telephone'     => '',
        'clientemail'   => 'info.novasell@gmail.com',
    );

    public function __doRequest($request, $location, $action, $version, $one_way=0) {
        if ( $this->printRequest ) {
            if ( !$this->formatXML ) {
                $out = $request;
            }
            else {
                $doc = new DOMDocument;
                $doc->preserveWhiteSpace = false;
                $doc->loadxml($request);
                $doc->formatOutput = true;
                $out = $doc->savexml();
            }
            echo $out;
        }

        if ( $this->sendRequest ) {
            return parent::__doRequest($request, $location, $action, $version, $one_way);
        }
        else {
            return '';
        }
    }
}
