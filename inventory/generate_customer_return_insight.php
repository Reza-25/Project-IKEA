<?php
// Script untuk generate AI insights untuk customer returns
require_once __DIR__ . '/../include/config.php';
require_once 'ai_helper_customer_return.php';

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

// Create table if not exists
$create_table_query = "
    CREATE TABLE IF NOT EXISTS ai_customer_return_recommendations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        return_id INT,
        customer_id INT,
        customer_name VARCHAR(255),
        return_category VARCHAR(100),
        insight_type VARCHAR(50),
        recommendation TEXT,
        urgency ENUM('low', 'medium', 'high') DEFAULT 'medium',
        cost_impact ENUM('low', 'medium', 'high') DEFAULT 'medium',
        estimated_savings DECIMAL(10,2) DEFAULT 0,
        implementation_timeline VARCHAR(50),
        is_implemented BOOLEAN DEFAULT FALSE,
        is_active BOOLEAN DEFAULT TRUE,
        generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )
";

$ai_db->query($create_table_query);

// Get customer return data from main database (simulated data)
$customers_data = [
    [
        'id' => 1,
        'customer_name' => 'John Doe',
        'category' => 'Furniture',
        'return_count' => 42,
        'total_value' => 3200.00,
        'avg_processing_days' => 2.8,
        'return_rate' => 18.5
    ],
    [
        'id' => 2,
        'customer_name' => 'Jane Smith',
        'category' => 'Lighting',
        'return_count' => 28,
        'total_value' => 1850.00,
        'avg_processing_days' => 3.2,
        'return_rate' => 12.3
    ],
    [
        'id' => 3,
        'customer_name' => 'Mike Johnson',
        'category' => 'Storage',
        'return_count' => 24,
        'total_value' => 2100.00,
        'avg_processing_days' => 2.5,
        'return_rate' => 15.8
    ],
    [
        'id' => 4,
        'customer_name' => 'Sarah Wilson',
        'category' => 'Bedroom',
        'return_count' => 18,
        'total_value' => 2999.00,
        'avg_processing_days' => 3.8,
        'return_rate' => 8.2
    ],
    [
        'id' => 5,
        'customer_name' => 'Tom Brown',
        'category' => 'Kitchen',
        'return_count' => 15,
        'total_value' => 1420.00,
        'avg_processing_days' => 2.2,
        'return_rate' => 6.8
    ]
];

// Generate AI recommendations based on customer return data
function generateCustomerReturnRecommendation($customer_data) {
    $recommendations = [];
    
    // Customer satisfaction recommendations
    if ($customer_data['return_rate'] > 15) {
        $recommendations[] = [
            'insight_type' => 'customer_satisfaction',
            'recommendation' => "Customer {$customer_data['customer_name']} memiliki return rate tinggi ({$customer_data['return_rate']}%) pada kategori {$customer_data['category']}. Perlu implementasi customer satisfaction program dan follow-up service.",
            'urgency' => 'high',
            'cost_impact' => 'high',
            'estimated_savings' => rand(8000, 20000),
            'implementation_timeline' => '1-2 weeks'
        ];
    }
    
    // Process improvement recommendations
    if ($customer_data['avg_processing_days'] > 3.0) {
        $recommendations[] = [
            'insight_type' => 'process_improvement',
            'recommendation' => "Return processing time untuk customer {$customer_data['customer_name']} ({$customer_data['avg_processing_days']} hari) dapat dioptimalkan dengan express return service dan automated refund system.",
            'urgency' => 'medium',
            'cost_impact' => 'medium',
            'estimated_savings' => rand(5000, 12000),
            'implementation_timeline' => '2-3 weeks'
        ];
    }
    
    // Product quality recommendations
    if ($customer_data['total_value'] > 2500) {
        $recommendations[] = [
            'insight_type' => 'product_quality',
            'recommendation' => "High-value returns dari customer {$customer_data['customer_name']} (${$customer_data['total_value']}) memerlukan product quality review dan preventive quality measures untuk kategori {$customer_data['category']}.",
            'urgency' => 'medium',
            'cost_impact' => 'high',
            'estimated_savings' => rand(10000, 25000),
            'implementation_timeline' => '3-4 weeks'
        ];
    }
    
    // Customer retention recommendations
    if ($customer_data['return_count'] > 25) {
        $recommendations[] = [
            'insight_type' => 'customer_retention',
            'recommendation' => "Customer {$customer_data['customer_name']} dengan {$customer_data['return_count']} returns perlu customer retention strategy dan loyalty program untuk meningkatkan satisfaction pada kategori {$customer_data['category']}.",
            'urgency' => 'high',
            'cost_impact' => 'medium',
            'estimated_savings' => rand(15000, 30000),
            'implementation_timeline' => '2-4 weeks'
        ];
    }
    
    return $recommendations;
}

// Insert recommendations into AI database
$inserted_count = 0;
foreach ($customers_data as $customer) {
    $recommendations = generateCustomerReturnRecommendation($customer);
    
    foreach ($recommendations as $rec) {
        $insert_query = "
            INSERT INTO ai_customer_return_recommendations 
            (customer_id, customer_name, return_category, insight_type, recommendation, urgency, 
             cost_impact, estimated_savings, implementation_timeline, generated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ";
        
        $stmt = $ai_db->prepare($insert_query);
        
        $stmt->bind_param(
            "isssssds",
            $customer['id'],
            $customer['customer_name'],
            $customer['category'],
            $rec['insight_type'],
            $rec['recommendation'],
            $rec['urgency'],
            $rec['cost_impact'],
            $rec['estimated_savings'],
            $rec['implementation_timeline']
        );
        
        if ($stmt->execute()) {
            $inserted_count++;
        }
    }
}

// Update analytics (create table if not exists)
$create_analytics_table = "
    CREATE TABLE IF NOT EXISTS ai_customer_return_analytics (
        id INT AUTO_INCREMENT PRIMARY KEY,
        period_start DATE,
        period_end DATE,
        total_recommendations INT DEFAULT 0,
        implemented_recommendations INT DEFAULT 0,
        total_estimated_savings DECIMAL(12,2) DEFAULT 0,
        avg_implementation_time DECIMAL(5,2) DEFAULT 0,
        top_insight_type VARCHAR(50),
        success_rate DECIMAL(5,2) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY unique_period (period_start, period_end)
    )
";

$ai_db->query($create_analytics_table);

$analytics_query = "
    INSERT INTO ai_customer_return_analytics 
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
            WHEN implementation_timeline LIKE '%3-4%' THEN 3.5
            WHEN implementation_timeline LIKE '%2-4%' THEN 3
            ELSE 2.5
        END) as avg_implementation_time,
        (SELECT insight_type FROM ai_customer_return_recommendations 
         WHERE generated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) 
         GROUP BY insight_type ORDER BY COUNT(*) DESC LIMIT 1) as top_insight_type,
        87.5 as success_rate
    FROM ai_customer_return_recommendations
    WHERE generated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    ON DUPLICATE KEY UPDATE
        total_recommendations = VALUES(total_recommendations),
        total_estimated_savings = VALUES(total_estimated_savings),
        updated_at = NOW()
";

$ai_db->query($analytics_query);

echo json_encode([
    'success' => true,
    'message' => "Generated {$inserted_count} customer return AI recommendations",
    'customers_analyzed' => count($customers_data),
    'recommendations_created' => $inserted_count
]);

$main_db->close();
$ai_db->close();
?>
