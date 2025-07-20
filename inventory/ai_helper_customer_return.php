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