<?php
require_once 'ai_helper_productsold.php';

header('Content-Type: application/json');

try {
    // Ambil suggestion terbaru
    $currentSuggestion = getProductSoldAIInsight();
    
    if (!$currentSuggestion || !$currentSuggestion['success']) {
        echo json_encode([
            'success' => false,
            'message' => 'No AI suggestion available'
        ]);
        exit;
    }
    
    // Generate 3 actionable solutions berdasarkan suggestion yang ada
    $solutions = generateProductActionableSolutions($currentSuggestion['data']);
    
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

function generateProductActionableSolutions($suggestion) {
    // Analisis jenis insight untuk memberikan solusi yang tepat
    $insightType = $suggestion['insight_type'] ?? 'general';
    $productName = $suggestion['product_name'] ?? 'Produk';
    
    $solutions = [];
    
    switch ($insightType) {
        case 'sales_optimization':
            $solutions = [
                "Implementasikan display premium untuk {$productName} di area high-traffic store",
                "Luncurkan targeted digital marketing campaign untuk {$productName}",
                "Training sales team untuk product knowledge dan selling technique {$productName}"
            ];
            break;
            
        case 'inventory_management':
            $solutions = [
                "Tingkatkan safety stock {$productName} sebesar 25% untuk 4 minggu ke depan",
                "Implementasikan automated reorder system untuk {$productName}",
                "Koordinasi dengan supplier untuk fast-track delivery {$productName}"
            ];
            break;
            
        case 'pricing_strategy':
            $solutions = [
                "Analisis kompetitif pricing {$productName} vs market leader dalam 3 hari",
                "Test A/B pricing strategy untuk {$productName} dengan variasi 5-15%",
                "Implementasikan dynamic pricing berdasarkan demand pattern {$productName}"
            ];
            break;
            
        case 'promotion_opportunity':
            $solutions = [
                "Luncurkan flash sale {$productName} dengan diskon 20% selama weekend",
                "Buat bundle package {$productName} dengan produk komplementer",
                "Aktifkan push notification campaign untuk member premium tentang {$productName}"
            ];
            break;
            
        case 'performance_analysis':
            $solutions = [
                "Lakukan deep-dive analysis performa {$productName} dalam 1 minggu",
                "Survey customer satisfaction dan feedback untuk {$productName}",
                "Benchmarking {$productName} dengan produk sejenis di market"
            ];
            break;
            
        default:
            $solutions = [
                "Monitor KPI dan metrics {$productName} secara real-time",
                "Buat action plan komprehensif untuk optimasi {$productName}",
                "Implementasikan continuous improvement process untuk {$productName}"
            ];
    }
    
    return $solutions;
}
?>
