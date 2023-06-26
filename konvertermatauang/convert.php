<?php
$response = array('success' => false, 'message' => '');

$amount = $_POST['amount'];
$fromCurrency = $_POST['from'];
$toCurrency = $_POST['to'];

$exchangeRates = array(
  'USD' => array(
    'USD' => 1.0,
    'EUR' => 0.85,
    'JPY' => 110.42,
    'IDR' => 14415.10
  ),
  'EUR' => array(
    'USD' => 1.18,
    'EUR' => 1.0,
    'JPY' => 129.88,
    'IDR' => 16983.61
  ),
  'JPY' => array(
    'USD' => 0.0091,
    'EUR' => 0.0077,
    'JPY' => 1.0,
    'IDR' => 130.88
  ),
  'IDR' => array(
    'USD' => 0.000069,
    'EUR' => 0.000059,
    'JPY' => 0.0076,
    'IDR' => 1.0
  )
);

if (!isset($exchangeRates[$fromCurrency]) || !isset($exchangeRates[$toCurrency])) {
  $response['message'] = 'Mata uang tidak valid.';
} elseif (!is_numeric($amount) || $amount <= 0) {
  $response['message'] = 'Jumlah tidak valid.';
} else {
  $convertedAmount = $amount * $exchangeRates[$fromCurrency][$toCurrency];
  $response['success'] = true;
  $response['convertedAmount'] = $convertedAmount;
}

echo json_encode($response);
?>
