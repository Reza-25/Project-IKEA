<?php
require_once __DIR__ . '/../include/config.php';

// Koneksi database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$categoryId = (int)$_GET['category_id'];

// Query transaksi per kategori
$transactionsQuery = "SELECT 
                        e.reference, 
                        e.tanggal, 
                        e.deskripsi, 
                        e.jumlah, 
                        e.status,
                        c.name AS category_name
                      FROM expenses e
                      JOIN categories c ON e.category_id = c.id
                      WHERE e.category_id = ?";
$stmt = $conn->prepare($transactionsQuery);
$stmt->bind_param('i', $categoryId);
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);

// Query insight
$insightQuery = "SELECT insight FROM expense_insights WHERE category_id = ?";
$stmtInsight = $conn->prepare($insightQuery);
$stmtInsight->bind_param('i', $categoryId);
$stmtInsight->execute();
$resultInsight = $stmtInsight->get_result();
$insight = $resultInsight->fetch_assoc()['insight'] ?? '';

// Data untuk dikirim
$data = [
    'categoryName' => $transactions[0]['category_name'] ?? '',
    'transactions' => $transactions,
    'insight' => $insight
];

header('Content-Type: application/json');
echo json_encode($data);
?>