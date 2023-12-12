<?php
/**
 * Algorithm, cURL
 */
define('VERIFY_TYPE_LIST', ['algorithm', 'curl']);
define('VERIFY_TYPE', 'algorithm');
/**
 * VERIFY_TYPE cURL Settings
 */
define('VERIFY_TYPE_CURL', [
    'URL'     => 'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx',
    'REQUEST' => [
        /**
         * SOAP 1.1 => SOAP11
         * SOAP 1.2 => SOAP12
         * More: https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?op=TCKimlikNoDogrula
         */
        'TYPE'   => 'SOAP11',
        'HEADER' => [
            "SOAP11" => [
                'POST /Service/KPSPublic.asmx HTTP/1.1',
                'Host: tckimlik.nvi.gov.tr',
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"'
            ],
            "SOAP12" => [
                'POST /Service/KPSPublic.asmx HTTP/1.1',
                'Host: tckimlik.nvi.gov.tr',
                'Content-Type: application/soap+xml; charset=utf-8'
            ]
        ]
    ]
]);