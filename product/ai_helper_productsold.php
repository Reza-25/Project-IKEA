<?php
// AI Helper untuk Product Sold Insights
require_once __DIR__ . '/../include/config.php';

function getProductSoldAIInsight($product_id = null) {
    try {
        // Koneksi ke database AI
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        if ($product_id) {
            // Get specific product insight
            $query = "
                SELECT 
                    apr.recommendation,
                    apr.insight_type,
                    apr.urgency,
                    apr.generated_at,
                    p.product_name
                FROM ai_product_recommendations apr
                LEFT JOIN ikea.products p ON apr.product_id = p.id
                WHERE apr.product_id = ? 
                ORDER BY apr.generated_at DESC 
                LIMIT 1
            ";
            
            $stmt = $ai_db->prepare($query);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                return [
                    'success' => true,
                    'data' => $row
                ];
            }
        } else {
            // Get random product insight
            $query = "
                SELECT 
                    apr.recommendation,
                    apr.insight_type,
                    apr.urgency,
                    apr.generated_at,
                    p.product_name
                FROM ai_product_recommendations apr
                LEFT JOIN ikea.products p ON apr.product_id = p.id
                ORDER BY apr.generated_at DESC 
                LIMIT 1
            ";
            
            $result = $ai_db->query($query);
            
            if ($row = $result->fetch_assoc()) {
                return [
                    'success' => true,
                    'data' => $row
                ];
            }
        }
        
        // Fallback jika tidak ada data AI
        return [
            'success' => true,
            'data' => [
                'recommendation' => 'Berdasarkan data penjualan produk, kategori Furniture menunjukkan performa terbaik dengan Sofa KVK sebagai produk unggulan. Pertimbangkan untuk meningkatkan stok dan promosi produk sejenis.',
                'insight_type' => 'sales_optimization',
                'urgency' => 'medium',
                'generated_at' => date('Y-m-d H:i:s'),
                'product_name' => 'Sofa KVK'
            ]
        ];
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'data' => [
                'recommendation' => 'Sistem AI sedang dalam pemeliharaan. Analisis menunjukkan tren positif pada penjualan produk furniture dengan peningkatan stabil sepanjang tahun.',
                'insight_type' => 'performance_analysis',
                'urgency' => 'low',
                'generated_at' => date('Y-m-d H:i:s'),
                'product_name' => 'General Products'
            ]
        ];
    } finally {
        if (isset($ai_db)) {
            $ai_db->close();
        }
    }
}

function getAllProductInsights($limit = 5) {
    try {
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        $query = "
            SELECT 
                apr.product_id,
                apr.recommendation,
                apr.insight_type,
                apr.urgency,
                apr.generated_at,
                p.product_name,
                p.product_code
            FROM ai_product_recommendations apr
            LEFT JOIN ikea.products p ON apr.product_id = p.id
            ORDER BY apr.generated_at DESC 
            LIMIT ?
        ";
        
        $stmt = $ai_db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $insights = [];
        while ($row = $result->fetch_assoc()) {
            $insights[] = $row;
        }
        
        return [
            'success' => true,
            'data' => $insights
        ];
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'data' => []
        ];
    } finally {
        if (isset($ai_db)) {
            $ai_db->close();
        }
    }
}

function getProductInsightStats() {
    try {
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        $query = "
            SELECT 
                COUNT(*) as total_insights,
                COUNT(CASE WHEN urgency = 'high' THEN 1 END) as high_urgency,
                COUNT(CASE WHEN urgency = 'medium' THEN 1 END) as medium_urgency,
                COUNT(CASE WHEN urgency = 'low' THEN 1 END) as low_urgency,
                COUNT(CASE WHEN insight_type = 'sales_optimization' THEN 1 END) as sales_insights,
                COUNT(CASE WHEN insight_type = 'inventory_management' THEN 1 END) as inventory_insights,
                COUNT(CASE WHEN insight_type = 'pricing_strategy' THEN 1 END) as pricing_insights,
                COUNT(CASE WHEN insight_type = 'promotion_opportunity' THEN 1 END) as promotion_insights,
                MAX(generated_at) as last_generated
            FROM ai_product_recommendations
            WHERE generated_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        ";
        
        $result = $ai_db->query($query);
        $stats = $result->fetch_assoc();
        
        return [
            'success' => true,
            'data' => $stats
        ];
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'data' => [
                'total_insights' => 0,
                'high_urgency' => 0,
                'medium_urgency' => 0,
                'low_urgency' => 0,
                'sales_insights' => 0,
                'inventory_insights' => 0,
                'pricing_insights' => 0,
                'promotion_insights' => 0,
                'last_generated' => date('Y-m-d H:i:s')
            ]
        ];
    } finally {
        if (isset($ai_db)) {
            $ai_db->close();
        }
    }
}

// Function untuk format insight type
function formatProductInsightType($type) {
    $types = [
        'sales_optimization' => 'Optimasi Penjualan',
        'inventory_management' => 'Manajemen Stok',
        'pricing_strategy' => 'Strategi Harga',
        'promotion_opportunity' => 'Peluang Promosi',
        'performance_analysis' => 'Analisis Performa'
    ];
    
    return $types[$type] ?? ucfirst(str_replace('_', ' ', $type));
}

// Function untuk format urgency
function formatProductUrgency($urgency) {
    $urgencies = [
        'low' => 'Rendah',
        'medium' => 'Sedang',
        'high' => 'Tinggi'
    ];
    
    return $urgencies[$urgency] ?? ucfirst($urgency);
}

// Function untuk get urgency color
function getProductUrgencyColor($urgency) {
    $colors = [
        'low' => '#28a745',
        'medium' => '#ffc107',
        'high' => '#dc3545'
    ];
    
    return $colors[$urgency] ?? '#6c757d';
}

// Function untuk extract solusi dari AI recommendation
function extractProductSolutions($recommendation) {
    $solutions = [];
    $text = strtolower($recommendation);
    
    if (strpos($text, 'stok') !== false || strpos($text, 'inventory') !== false) {
        $solutions = [
            "Tingkatkan stok produk terlaris sebesar 30% untuk 3 minggu ke depan",
            "Implementasikan sistem alert otomatis untuk produk dengan stok rendah", 
            "Koordinasi dengan supplier untuk pengiriman express produk prioritas"
        ];
    } elseif (strpos($text, 'promo') !== false || strpos($text, 'promosi') !== false) {
        $solutions = [
            "Luncurkan flash sale untuk produk dengan performa tinggi",
            "Buat bundle package dengan produk komplementer",
            "Aktifkan targeted marketing untuk customer segment premium"
        ];
    } elseif (strpos($text, 'penjualan') !== false || strpos($text, 'sales') !== false) {
        $solutions = [
            "Fokuskan display produk terlaris di area prime store",
            "Training sales team untuk upselling produk dengan margin tinggi",
            "Implementasikan cross-selling strategy untuk produk terkait"
        ];
    } elseif (strpos($text, 'harga') !== false || strpos($text, 'pricing') !== false) {
        $solutions = [
            "Analisis kompetitif pricing untuk produk sejenis dalam 5 hari",
            "Test dynamic pricing untuk produk dengan demand tinggi",
            "Evaluasi margin pricing untuk optimasi profitabilitas"
        ];
    } else {
        // Default solutions berdasarkan produk yang disebutkan
        preg_match('/\b([A-Z][a-zA-Z\s]+)\b/', $recommendation, $matches);
        $productName = isset($matches[0]) ? trim($matches[0]) : 'produk unggulan';
        
        $solutions = [
            "Analisis mendalam performa {$productName} dalam 1 minggu",
            "Buat strategi marketing khusus untuk {$productName}",
            "Monitor trend penjualan {$productName} secara real-time selama 30 hari"
        ];
    }
    
    return $solutions;
}

// Update fungsi getProductSoldAIInsight untuk include solutions
function getProductSoldAIInsightWithSolutions() {
    $suggestion = getProductSoldAIInsight();
    if ($suggestion && $suggestion['success']) {
        $suggestion['data']['solutions'] = extractProductSolutions($suggestion['data']['recommendation']);
    }
    return $suggestion;
}

// Function untuk create table jika belum ada
function createProductAITablesIfNotExists() {
    try {
        $pdo = new PDO("mysql:host=localhost", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pdo->exec("USE ikea_ai_insight");
        
        // Create table ai_product_recommendations jika belum ada
        $createTable = "
        CREATE TABLE IF NOT EXISTS ai_product_recommendations (
          id INT AUTO_INCREMENT PRIMARY KEY,
          product_id INT NOT NULL,
          insight_type ENUM('sales_optimization','inventory_management','pricing_strategy','promotion_opportunity','performance_analysis') NOT NULL,
          recommendation TEXT NOT NULL,
          urgency ENUM('low','medium','high') DEFAULT 'medium',
          generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          INDEX idx_product_id (product_id),
          INDEX idx_generated_at (generated_at)
        )";
        
        $pdo->exec($createTable);
        
        // Insert sample data jika table kosong
        $checkData = $pdo->query("SELECT COUNT(*) FROM ai_product_recommendations")->fetchColumn();
        if ($checkData == 0) {
            $sampleData = "
            INSERT INTO ai_product_recommendations (product_id, insight_type, recommendation, urgency, generated_at) VALUES
            (3, 'sales_optimization', 'Sofa EKTORP menunjukkan performa penjualan yang sangat baik dengan rating 4.6. Berdasarkan data historis, produk ini memiliki potensi untuk meningkatkan penjualan hingga 25% jika dilakukan promosi bundling dengan produk furniture lainnya seperti meja dan kursi.', 'high', NOW()),
            (1, 'inventory_management', 'Meja LACK dengan stok 120 unit menunjukkan perputaran yang cepat. Rekomendasi untuk meningkatkan stok menjadi 180 unit untuk mengantisipasi lonjakan permintaan di musim liburan dan menghindari stockout.', 'medium', NOW() - INTERVAL 1 HOUR),
            (5, 'pricing_strategy', 'Smart TV 55 inch dengan harga Rp 127.500.000 memiliki margin yang baik namun penjualan bisa ditingkatkan. Pertimbangkan strategi bundling dengan furniture entertainment untuk meningkatkan value proposition.', 'medium', NOW() - INTERVAL 2 HOUR),
            (8, 'promotion_opportunity', 'Lampu LERSTA dengan rating 3.8 memiliki potensi untuk ditingkatkan melalui program promosi khusus. Rekomendasi untuk menjalankan campaign \"Lighting Makeover\" dengan diskon 20% untuk pembelian 2 atau lebih unit lampu.', 'low', NOW() - INTERVAL 3 HOUR)
            ";
            $pdo->exec($sampleData);
        }
        
        return true;
        
    } catch(PDOException $e) {
        error_log("Error creating Product AI tables: " . $e->getMessage());
        return false;
    }
}

// Auto-create tables saat file di-include
createProductAITablesIfNotExists();

?>
