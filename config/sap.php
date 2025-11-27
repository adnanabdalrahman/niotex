<?php
return [
    'base_url' => env('SAP_API_BASE_URL'),
    'client_id' => env('SAP_CLIENT_ID'),
    'client_secret' => env('SAP_CLIENT_SECRET'),
    'api_token' => env('SAP_API_TOKEN'),
    'mm221_path' => '/Z1ERP_MM_CEOS_STOCK_SRV/ZCEOSStockSet',
    'mm341_path' => '/Z1ERP_MM_CEOS_STOCK_SRV/CEOSReservationHeaderSet',
    'mm331_path' => '/Z1ERP_MM_CEOS_STOCK_SRV/CEOSOrderDeliveryHeaderSet',
    'mm352_path' => '/Z1ERP_MM_CEOS_STOCK_SRV/CEOSGoodsmovementHeaderSet',
    'sd0102_path' => '/Z1ERP_SD_CEOS_ORDER_SRV/CEOSOrderHeaderSet/',
    'sd0301_path' => '/Z1ERP_SD_CEOS_ORDER_SRV/CEOSServOrderHeaderSet/',
    'se2601_path' => '/Z1ERP_SE_CEOS_ORDER_SRV/CEOSOrderHeaderSet/',
    'co0101_path' => '/Z1ERP_CO_CEOS_TIME_SRV/CEOSTimeUnitsHeaderCollection/',
    'ea21_path' => '/ZRE_RECORD_DOC_SRV/GetRecordList',
    'ea11_path' => '/ZRE_RECORD_DOC_SRV/FileExchange',


];
