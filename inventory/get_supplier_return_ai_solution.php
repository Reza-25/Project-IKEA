<?php
require_once 'ai_helper_supplier_return.php';

header('Content-Type: application/json');

try {
    // Ambil suggestion terbaru
    $currentSuggestion = getSupplierReturnAIInsight();
    
    if (!$currentSuggestion['success']) {
        echo json_encode([
            'success' => false,
            'message' => 'No AI suggestion available'
        ]);
        exit;
    }
    
    // Generate 3 actionable solutions berdasarkan suggestion yang ada
    $solutions = generateSupplierReturnActionableSolutions($currentSuggestion['data']);
    
    echo json_encode([
        'success' => true,
        'solutions' => $solutions,
        'based_on' => $currentSuggestion['data']['recommendation']
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}

function generateSupplierReturnActionableSolutions($suggestion) {
    // Analisis jenis insight untuk memberikan solusi yang tepat
    $insightType = $suggestion['insight_type'] ?? 'general';
    $supplierName = $suggestion['supplier_name'] ?? 'Supplier';
    $category = $suggestion['return_category'] ?? 'Product';
    
    $solutions = [];
    
    switch (strtolower($insightType)) {
        case 'quality_control':
        case 'quality':
            $solutions = [
                "Implementasi quality audit untuk {$supplierName} dalam 1 minggu",
                "Review dan update quality standards untuk kategori {$category}",
                "Setup quality monitoring system untuk semua incoming products"
            ];
            break;
            
        case 'cost_reduction':
        case 'cost':
            $solutions = [
                "Negosiasi ulang kontrak dengan {$supplierName} untuk mengurangi return cost",
                "Implementasi return cost sharing agreement dengan supplier",
                "Analisis root cause untuk mengurangi return rate sebesar 30%"
            ];
            break;
            
        case 'supplier_performance':
        case 'performance':
            $solutions = [
                "Buat performance improvement plan untuk {$supplierName}",
                "Implementasi supplier scorecard system dengan KPI tracking",
                "Setup monthly review meeting dengan underperforming suppliers"
            ];
            break;
            
        case 'process_optimization':
        case 'optimization':
            $solutions = [
                "Optimasi return processing workflow untuk kategori {$category}",
                "Implementasi automated return tracking system",
                "Setup real-time dashboard untuk monitoring return metrics"
            ];
            break;
            
        default:
            $solutions = [
                "Analisis mendalam return pattern {$supplierName} dalam 1 minggu",
                "Buat action plan spesifik untuk mengurangi return rate",
                "Monitor supplier performance secara real-time selama 30 hari"
            ];
    }
    
    return $solutions;
}
?>