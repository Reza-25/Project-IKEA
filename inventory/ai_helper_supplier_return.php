<?php
// AI Helper untuk Supplier Return Insights
require_once __DIR__ . '/../include/config.php';

function getSupplierReturnAIInsight($return_id = null) {
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
                    asr.recommendation,
                    asr.insight_type,
                    asr.urgency,
                    asr.generated_at,
                    asr.supplier_name,
                    asr.return_category,
                    asr.cost_impact,
                    asr.estimated_savings,
                    asr.implementation_timeline
                FROM ai_supplier_return_recommendations asr
                WHERE asr.return_id = ? AND asr.is_active = 1
                ORDER BY asr.generated_at DESC 
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
            // Get latest general supplier return insight
            $query = "
                SELECT 
                    asr.recommendation,
                    asr.insight_type,
                    asr.urgency,
                    asr.generated_at,
                    asr.supplier_name,
                    asr.return_category,
                    asr.cost_impact,
                    asr.estimated_savings,
                    asr.implementation_timeline
                FROM ai_supplier_return_recommendations asr
                WHERE asr.is_active = 1
                ORDER BY asr.generated_at DESC 
                LIMIT 1
            ";
            
            $result = $ai_db->query($query);
            
            // Add error checking here - THIS IS THE FIX FOR LINE 64
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
                'recommendation' => 'process improvement needed',
                'insight_type' => 'general',
                'urgency' => 'medium',
                'generated_at' => date('Y-m-d H:i:s'),
                'supplier_name' => 'Default Supplier',
                'return_category' => 'General',
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
                'recommendation' => 'process improvement needed',
                'insight_type' => 'general',
                'urgency' => 'medium',
                'generated_at' => date('Y-m-d H:i:s'),
                'supplier_name' => 'Default Supplier',
                'return_category' => 'General',
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

function getAllSupplierReturnInsights($limit = 5) {
    try {
        $ai_db = new mysqli('localhost', 'root', '', 'ikea_ai_insight');
        if ($ai_db->connect_error) {
            throw new Exception("AI Database connection failed: " . $ai_db->connect_error);
        }
        
        $query = "
            SELECT 
                asr.id,
                asr.return_id,
                asr.recommendation,
                asr.insight_type,
                asr.urgency,
                asr.generated_at,
                asr.supplier_name,
                asr.return_category,
                asr.cost_impact,
                asr.estimated_savings,
                asr.implementation_timeline,
                asr.is_implemented
            FROM ai_supplier_return_recommendations asr
            WHERE asr.is_active = 1
            ORDER BY asr.generated_at DESC 
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

function getSupplierReturnInsightStats() {
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
                COUNT(CASE WHEN insight_type = 'quality_control' THEN 1 END) as quality_insights,
                COUNT(CASE WHEN insight_type = 'cost_reduction' THEN 1 END) as cost_insights,
                COUNT(CASE WHEN insight_type = 'supplier_performance' THEN 1 END) as performance_insights,
                COUNT(CASE WHEN insight_type = 'process_optimization' THEN 1 END) as process_insights,
                COUNT(CASE WHEN is_implemented = 1 THEN 1 END) as implemented_insights,
                AVG(estimated_savings) as avg_savings,
                SUM(estimated_savings) as total_estimated_savings,
                MAX(generated_at) as last_generated
            FROM ai_supplier_return_recommendations
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
                'quality_insights' => 0,
                'cost_insights' => 0,
                'performance_insights' => 0,
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
if (!function_exists('formatSupplierReturnInsightType')) {
    function formatSupplierReturnInsightType($type) {
        $types = [
            'quality_control' => 'Quality Control',
            'cost_reduction' => 'Cost Reduction',
            'supplier_performance' => 'Supplier Performance',
            'process_optimization' => 'Process Optimization',
            'general' => 'General'
        ];
        
        return $types[$type] ?? ucfirst(str_replace('_', ' ', $type));
    }
}

// Function untuk format urgency
if (!function_exists('formatSupplierReturnUrgency')) {
    function formatSupplierReturnUrgency($urgency) {
        $urgencies = [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High'
        ];
        
        return $urgencies[$urgency] ?? ucfirst($urgency);
    }
}

// Function untuk get urgency color
if (!function_exists('getSupplierReturnUrgencyColor')) {
    function getSupplierReturnUrgencyColor($urgency) {
        $colors = [
            'low' => '#28a745',
            'medium' => '#ffc107',
            'high' => '#dc3545'
        ];
        
        return $colors[$urgency] ?? '#6c757d';
    }
}
// Function untuk format currency
function formatSupplierReturnCurrency($amount) {
    return '$' . number_format($amount, 2);
}

// Function untuk get insight type icon
function getSupplierReturnInsightIcon($type) {
    $icons = [
        'quality_control' => 'fas fa-shield-alt',
        'cost_reduction' => 'fas fa-dollar-sign',
        'supplier_performance' => 'fas fa-user-tie',
        'process_optimization' => 'fas fa-cogs',
        'general' => 'fas fa-lightbulb'
    ];
    
    return $icons[$type] ?? 'fas fa-info-circle';
}
?>