<?php
// AI Helper untuk Customer Return Insights
require_once __DIR__ . '/../include/config.php';

function getCustomerReturnAIInsight($return_id = null) {
    try {
        // Koneksi ke database AI yang sudah ada
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        if ($return_id) {
            // Get specific return insight
            $query = "
                SELECT 
                    acr.recommendation,
                    acr.insight_type,
                    acr.urgency,
                    acr.generated_at,
                    acr.customer_name,
                    acr.return_category,
                    acr.cost_impact,
                    acr.estimated_savings,
                    acr.implementation_timeline
                FROM ai_customer_return_recommendations acr
                WHERE acr.return_id = ? AND acr.is_active = 1
                ORDER BY acr.generated_at DESC 
                LIMIT 1
            ";
            
            $stmt = $ai_db->prepare($query);
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $ai_db->error);
            }
            $stmt->bind_param("i", $return_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $row = $result->fetch_assoc()) {
                return [
                    'success' => true,
                    'data' => $row
                ];
            }
        } else {
            // Get latest general customer return insight
            $query = "
                SELECT 
                    acr.recommendation,
                    acr.insight_type,
                    acr.urgency,
                    acr.generated_at,
                    acr.customer_name,
                    acr.return_category,
                    acr.cost_impact,
                    acr.estimated_savings,
                    acr.implementation_timeline
                FROM ai_customer_return_recommendations acr
                WHERE acr.is_active = 1
                ORDER BY acr.generated_at DESC 
                LIMIT 1
            ";
            
            $result = $ai_db->query($query);
            
            if ($result && $row = $result->fetch_assoc()) {
                return [
                    'success' => true,
                    'data' => $row
                ];
            }
        }
        
        // Return fallback data if no results found
        return [
            'success' => true,
            'data' => [
                'recommendation' => 'customer satisfaction improvement needed',
                'insight_type' => 'customer_satisfaction',
                'urgency' => 'medium',
                'generated_at' => date('Y-m-d H:i:s'),
                'customer_name' => 'Default Customer',
                'return_category' => 'Furniture',
                'cost_impact' => 'medium',
                'estimated_savings' => 0,
                'implementation_timeline' => '1-2 weeks'
            ]
        ];
        
    } catch (Exception $e) {
        error_log("AI Helper Error: " . $e->getMessage());
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'data' => [
                'recommendation' => 'customer satisfaction improvement needed',
                'insight_type' => 'customer_satisfaction',
                'urgency' => 'medium',
                'generated_at' => date('Y-m-d H:i:s'),
                'customer_name' => 'Default Customer',
                'return_category' => 'Furniture',
                'cost_impact' => 'medium',
                'estimated_savings' => 0,
                'implementation_timeline' => '1-2 weeks'
            ]
        ];
    } finally {
        if (isset($ai_db)) {
            $ai_db->close();
        }
    }
}

function getAllCustomerReturnInsights($limit = 5) {
    try {
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        $query = "
            SELECT 
                acr.id,
                acr.return_id,
                acr.recommendation,
                acr.insight_type,
                acr.urgency,
                acr.generated_at,
                acr.customer_name,
                acr.return_category,
                acr.cost_impact,
                acr.estimated_savings,
                acr.implementation_timeline,
                acr.is_implemented
            FROM ai_customer_return_recommendations acr
            WHERE acr.is_active = 1
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

function getCustomerReturnInsightStats() {
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
                COUNT(CASE WHEN insight_type = 'customer_satisfaction' THEN 1 END) as satisfaction_insights,
                COUNT(CASE WHEN insight_type = 'product_quality' THEN 1 END) as quality_insights,
                COUNT(CASE WHEN insight_type = 'customer_retention' THEN 1 END) as retention_insights,
                COUNT(CASE WHEN insight_type = 'process_improvement' THEN 1 END) as process_insights,
                COUNT(CASE WHEN is_implemented = 1 THEN 1 END) as implemented_insights,
                AVG(estimated_savings) as avg_savings,
                SUM(estimated_savings) as total_estimated_savings,
                MAX(generated_at) as last_generated
            FROM ai_customer_return_recommendations
            WHERE generated_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND is_active = 1
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
                'satisfaction_insights' => 0,
                'quality_insights' => 0,
                'retention_insights' => 0,
                'process_insights' => 0,
                'implemented_insights' => 0,
                'avg_savings' => 0,
                'total_estimated_savings' => 0,
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
if (!function_exists('formatCustomerReturnInsightType')) {
    function formatCustomerReturnInsightType($type) {
        $types = [
            'customer_satisfaction' => 'Customer Satisfaction',
            'product_quality' => 'Product Quality',
            'customer_retention' => 'Customer Retention',
            'process_improvement' => 'Process Improvement',
            'general' => 'General'
        ];
        
        return $types[$type] ?? ucfirst(str_replace('_', ' ', $type));
    }
}

// Function untuk format urgency
if (!function_exists('formatCustomerReturnUrgency')) {
    function formatCustomerReturnUrgency($urgency) {
        $urgencies = [
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi'
        ];
        
        return $urgencies[$urgency] ?? ucfirst($urgency);
    }
}

// Function untuk get urgency color
if (!function_exists('getCustomerReturnUrgencyColor')) {
    function getCustomerReturnUrgencyColor($urgency) {
        $colors = [
            'low' => '#28a745',
            'medium' => '#ffc107',
            'high' => '#dc3545'
        ];
        
        return $colors[$urgency] ?? '#6c757d';
    }
}

// Function untuk format currency
function formatCustomerReturnCurrency($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Function untuk get insight type icon
function getCustomerReturnInsightIcon($type) {
    $icons = [
        'customer_satisfaction' => 'fas fa-smile',
        'product_quality' => 'fas fa-shield-alt',
        'customer_retention' => 'fas fa-heart',
        'process_improvement' => 'fas fa-cogs',
        'general' => 'fas fa-lightbulb'
    ];
    
    return $icons[$type] ?? 'fas fa-info-circle';
}
?>
