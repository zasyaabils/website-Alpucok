<?php
header('Content-Type: application/json');

// Get the raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate the data
if (!$data || !isset($data['customer']) || !isset($data['items'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

// Process the order (in a real app, you would save to database)
$orderId = uniqid();
$orderTotal = array_reduce($data['items'], function($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);

// Prepare response
$response = [
    'success' => true,
    'message' => 'Order received successfully',
    'order_id' => $orderId,
    'customer' => $data['customer'],
    'items' => $data['items'],
    'total' => $orderTotal,
    'date' => date('Y-m-d H:i:s')
];

// In a real application, you would:
// 1. Save the order to a database
// 2. Send confirmation email to customer
// 3. Notify the admin about the new order

echo json_encode($response);
?>