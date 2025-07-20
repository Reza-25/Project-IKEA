<?php
// Script untuk generate AI insights untuk transfer (mirip dengan yang ada untuk category/brand)
require_once __DIR__ . '/../include/config.php';
require_once 'ai_helper_transfer_updated.php';

// Koneksi ke database utama IKEA
$main_db = new mysqli('localhost', 'root', '', 'ikea');
if ($main_db->connect_error) {
    die("Connection failed: " . $main_db->connect_error);
}

// Koneksi ke database AI
$ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
if ($ai_db->connect_error) {
    die("AI Database connection failed: " . $ai_db->connect_error);
}

// Get transfer data from main database
$query = "
    SELECT 
        tr.id,
        tr.from_store_id,
        tr.to_store_id,
        t1.nama_toko as from_store_name,
        t2.nama_toko as to_store_name,
        tr.total_value,
        tr.status,
        tr.priority,
        COUNT(ti.id) as item_count,
        AVG(DATEDIFF(tr.actual_date, tr.request_date)) as avg_processing_days
    FROM transfer_requests tr
    LEFT JOIN transfer_items ti ON tr.id = ti.transfer_id
    LEFT JOIN toko t1 ON tr.from_store_id = t1.id_toko
    LEFT JOIN toko t2 ON tr.to_store_id = t2.id_toko
    WHERE tr.request_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    GROUP BY tr.id, tr.from_store_id, tr.to_store_id
    ORDER BY tr.request_date DESC
    LIMIT 20
";

$result = $main_db->query($query);
$transfers = [];
while ($row = $result->fetch_assoc()) {
    $transfers[] = $row;
}

// Generate AI recommendations based on transfer data
function generateTransferRecommendation($transfer_data) {
    $recommendations = [];
    
    // Route optimization recommendations
    if ($transfer_data['avg_processing_days'] > 3) {
        $recommendations[] = [
            'insight_type' => 'time_optimization',
            'recommendation' => "Transfer dari {$transfer_data['from_store_name']} ke {$transfer_data['to_store_name']} memerlukan optimasi waktu. Rata-rata processing time {$transfer_data['avg_processing_days']} hari dapat dikurangi dengan pre-scheduling system.",
            'urgency' => 'high',
            'estimated_savings' => rand(1000000, 3000000),
            'implementation_timeline' => '1-2 weeks'
        ];
    }
    
    // Cost reduction recommendations
    if ($transfer_data['total_value'] > 2000000) {
        $recommendations[] = [
            'insight_type' => 'cost_reduction',
            'recommendation' => "Rute {$transfer_data['from_store_name']} - {$transfer_data['to_store_name']} dengan nilai transfer tinggi (Rp " . number_format($transfer_data['total_value']) . ") dapat dioptimalkan dengan bulk transfer scheduling untuk mengurangi biaya per unit.",
            'urgency' => 'medium',
            'estimated_savings' => rand(500000, 2000000),
            'implementation_timeline' => '2-4 weeks'
        ];
    }
    
    // Efficiency recommendations
    if ($transfer_data['item_count'] > 5) {
        $recommendations[] = [
            'insight_type' => 'efficiency',
            'recommendation' => "Transfer dengan {$transfer_data['item_count']} item dari {$transfer_data['from_store_name']} ke {$transfer_data['to_store_name']} dapat ditingkatkan efisiensinya dengan automated tracking system dan consolidated packaging.",
            'urgency' => 'medium',
            'estimated_savings' => rand(800000, 2500000),
            'implementation_timeline' => '1-3 weeks'
        ];
    }
    
    return $recommendations;
}

// Insert recommendations into AI database
$inserted_count = 0;
foreach ($transfers as $transfer) {
    $recommendations = generateTransferRecommendation($transfer);
    
    foreach ($recommendations as $rec) {
        $insert_query = "
            INSERT INTO ai_transfer_recommendations 
            (transfer_id, from_store_id, to_store_id, insight_type, recommendation, urgency, 
             branch_from, branch_to, route_efficiency, estimated_savings, implementation_timeline, generated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ";
        
        $stmt = $ai_db->prepare($insert_query);
        $route_efficiency = rand(8000, 9500) / 100; // Random efficiency between 80-95%
        
        $stmt->bind_param(
            "iiisssssdds",
            $transfer['id'],
            $transfer['from_store_id'],
            $transfer['to_store_id'],
            $rec['insight_type'],
            $rec['recommendation'],
            $rec['urgency'],
            $transfer['from_store_name'],
            $transfer['to_store_name'],
            $route_efficiency,
            $rec['estimated_savings'],
            $rec['implementation_timeline']
        );
        
        if ($stmt->execute()) {
            $inserted_count++;
        }
    }
}

// Update analytics
$analytics_query = "
    INSERT INTO ai_transfer_analytics 
    (period_start, period_end, total_recommendations, implemented_recommendations, 
     total_estimated_savings, avg_implementation_time, top_insight_type, success_rate)
    SELECT 
        DATE_SUB(NOW(), INTERVAL 30 DAY) as period_start,
        NOW() as period_end,
        COUNT(*) as total_recommendations,
        COUNT(CASE WHEN is_implemented = 1 THEN 1 END) as implemented_recommendations,
        SUM(estimated_savings) as total_estimated_savings,
        AVG(CASE 
            WHEN implementation_timeline LIKE '%1-2%' THEN 1.5
            WHEN implementation_timeline LIKE '%2-3%' THEN 2.5
            WHEN implementation_timeline LIKE '%2-4%' THEN 3
            WHEN implementation_timeline LIKE '%1-3%' THEN 2
            ELSE 2
        END) as avg_implementation_time,
        (SELECT insight_type FROM ai_transfer_recommendations 
         WHERE generated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) 
         GROUP BY insight_type ORDER BY COUNT(*) DESC LIMIT 1) as top_insight_type,
        85.5 as success_rate
    FROM ai_transfer_recommendations
    WHERE generated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    ON DUPLICATE KEY UPDATE
        total_recommendations = VALUES(total_recommendations),
        total_estimated_savings = VALUES(total_estimated_savings),
        updated_at = NOW()
";

$ai_db->query($analytics_query);

echo json_encode([
    'success' => true,
    'message' => "Generated {$inserted_count} transfer AI recommendations",
    'transfers_analyzed' => count($transfers),
    'recommendations_created' => $inserted_count
]);

$main_db->close();
$ai_db->close();
?>
