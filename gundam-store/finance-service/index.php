<?php

header('Content-Type: application/xml');

$input = file_get_contents('php://input');
$cart = json_decode($input, true);

$totalRevenue = 0;
$itemNames = [];

if (is_array($cart)) {
    foreach ($cart as $item) {
        $totalRevenue += (float) $item['price'];
        $itemNames[] = $item['name'];
    }
}
$boughtItemsList = implode(", ", $itemNames);

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml .= "<FinanceRecord>\n";
$xml .= "  <Status>Success</Status>\n";
$xml .= "  <System>Legacy Accounting v1.0</System>\n";
$xml .= "  <Transaction>\n";
$xml .= "    <Items>" . htmlspecialchars($boughtItemsList) . "</Items>\n";
$xml .= "    <TotalRevenue>Rp " . number_format($totalRevenue, 0, ',', '.') . "</TotalRevenue>\n";
$xml .= "  </Transaction>\n";
$xml .= "  <Message>Logged Rp " . number_format($totalRevenue, 0, ',', '.') . " for items: " . htmlspecialchars($boughtItemsList) . "</Message>\n";
$xml .= "  <Timestamp>" . date('Y-m-d H:i:s') . "</Timestamp>\n";
$xml .= "</FinanceRecord>";

file_put_contents('ledger.txt', "--- NEW TRANSACTION ---\n" . $xml . "\n\n", FILE_APPEND);


echo $xml;
?>