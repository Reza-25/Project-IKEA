<?php
// AI Helper untuk Category Insights
require_once __DIR__ . '/../include/config.php';

function getCategoryAIInsight($category_id = null) {
    try {
        // Koneksi ke database AI
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        if ($category_id) {
            // Get specific category insight
            $query = "
                SELECT 
                    acr.recommendation,
                    acr.insight_type,
                    acr.urgency,
                    acr.generated_at,
                    cp.category_name
                FROM ai_category_recommendations acr
                LEFT JOIN ikea.categories_product cp ON acr.category_id = cp.id
                WHERE acr.category_id = ? 
                ORDER BY acr.generated_at DESC 
                LIMIT 1
            ";
            
            $stmt = $ai_db->prepare($query);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                return [
                    'success' => true,
                    'data' => $row
                ];
            }
        } else {
            // Get random category insight
            $query = "
                SELECT 
                    acr.recommendation,
                    acr.insight_type,
                    acr.urgency,
                    acr.generated_at,
                    cp.category_name
                FROM ai_category_recommendations acr
                LEFT JOIN ikea.categories_product cp ON acr.category_id = cp.id
                ORDER BY acr.generated_at DESC 
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
                'recommendation' => 'Kategori Furniture menunjukkan performa stabil dengan potensi ekspansi ke segmen premium untuk meningkatkan margin profit.',
                'insight_type' => 'expansion',
                'urgency' => 'medium',
                'generated_at' => date('Y-m-d H:i:s'),
                'category_name' => 'Furniture'
            ]
        ];
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'data' => [
                'recommendation' => 'Sistem AI sedang dalam pemeliharaan. Analisis kategori menunjukkan tren positif pada segmen furniture dan storage.',
                'insight_type' => 'optimization',
                'urgency' => 'low',
                'generated_at' => date('Y-m-d H:i:s'),
                'category_name' => 'General'
            ]
        ];
    } finally {
        if (isset($ai_db)) {
            $ai_db->close();
        }
    }
}

function getAllCategoryInsights($limit = 5) {
    try {
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        $query = "
            SELECT 
                acr.category_id,
                acr.recommendation,
                acr.insight_type,
                acr.urgency,
                acr.generated_at,
                cp.category_name,
                cp.category_code
            FROM ai_category_recommendations acr
            LEFT JOIN ikea.categories_product cp ON acr.category_id = cp.id
            ORDER BY acr.generated_at DESC 
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

function getCategoryInsightStats() {
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
                COUNT(CASE WHEN insight_type = 'expansion' THEN 1 END) as expansion_insights,
                COUNT(CASE WHEN insight_type = 'optimization' THEN 1 END) as optimization_insights,
                COUNT(CASE WHEN insight_type = 'marketing' THEN 1 END) as marketing_insights,
                COUNT(CASE WHEN insight_type = 'budget' THEN 1 END) as budget_insights,
                MAX(generated_at) as last_generated
            FROM ai_category_recommendations
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
                'expansion_insights' => 0,
                'optimization_insights' => 0,
                'marketing_insights' => 0,
                'budget_insights' => 0,
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
function formatInsightType($type) {
    $types = [
        'expansion' => 'Ekspansi',
        'optimization' => 'Optimasi',
        'marketing' => 'Marketing',
        'budget' => 'Budget'
    ];
    
    return $types[$type] ?? ucfirst($type);
}

// Function untuk format urgency
function formatUrgency($urgency) {
    $urgencies = [
        'low' => 'Rendah',
        'medium' => 'Sedang',
        'high' => 'Tinggi'
    ];
    
    return $urgencies[$urgency] ?? ucfirst($urgency);
}

// Function untuk get urgency color
function getUrgencyColor($urgency) {
    $colors = [
        'low' => '#28a745',
        'medium' => '#ffc107',
        'high' => '#dc3545'
    ];
    
    return $colors[$urgency] ?? '#6c757d';
}
?>
