<?php

$url = "https://esp.fbr.gov.pk:8244/FBR/v1/api/Live/PostData";
$token = "Bearer 1298b5eb-b252-3d97-8622-a4a69d5bf818"; // Replace with your sandbox token

$data = [
    'InvoiceNumber' => '123456',
    'POSID' => '814989',
    'USIN' => 'USIN0',
    'PaymentMode' => 1,
    'BuyerName' => 'Customer Name',
    'InvoiceType' => 1,
    'DateTime' => '2025-05-04 09:00:00',
    'BuyerNTN' => '1234567',
    'TotalSaleValue' => 1275,
    'TotalAmount' => 1500,
    'TotalQuantity' => 1,
    'TotalBillAmount' => 1500,
    'TotalTaxCharged' => 225,
    'Items' => [
        [
            'ItemCode' => 'P001',
            'PCTCode' => '11001010',
            'ItemName' => 'Product A',
            'Quantity' => 2,
            'Rate' => 500,
            'SaleValue' => 1275,
            'TotalAmount' => 1500,
            'InvoiceType' => 1,
            'TaxRate' => 15,
            'TaxCharged' => 225
        ]
    ]
];

$payload = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: ' . $token,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for testing

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo "HTTP Code: $httpcode\n";
    echo "Response:\n" . json_encode(json_decode($response), JSON_PRETTY_PRINT);
}

curl_close($ch);
