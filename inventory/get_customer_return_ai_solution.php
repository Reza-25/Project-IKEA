<?php
require_once 'ai_helper_customer_return.php';

header('Content-Type: application/json');

try {
    // Ambil suggestion terbaru
    $currentSuggestion = getCustomerReturnAIInsight();
    
    if (!$currentSuggestion['success']) {
        echo json_encode([
            'success' => false,
            'message' => 'No AI suggestion available'
        ]);
        exit;
    }
    
    // Generate 3 actionable solutions berdasarkan suggestion yang ada
    $solutions = generateCustomerReturnActionableSolutions($currentSuggestion['data']);
    
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

function generateCustomerReturnActionableSolutions($suggestion) {
    // Analisis jenis insight untuk memberikan solusi yang tepat
    $insightType = $suggestion['insight_type'] ?? 'general';
    $customerName = $suggestion['customer_name'] ?? 'Customer';
    $category = $suggestion['return_category'] ?? 'Product';
    
    $solutions = [];
    
    switch (strtolower($insightType)) {
        case 'customer_satisfaction':
        case 'satisfaction':
            $solutions = [
                "Implementasi customer satisfaction survey untuk {$customerName} dalam 3 hari",
                "Setup dedicated customer service untuk high-return customers",
                "Buat customer satisfaction improvement program untuk kategori {$category}"
            ];
            break;
            
        case 'product_quality':
        case 'quality':
            $solutions = [
                "Review product quality untuk kategori {$category} yang sering dikembalikan",
                "Implementasi quality assurance checklist sebelum pengiriman",
                "Setup product quality monitoring dashboard untuk early detection"
            ];
            break;
            
        case 'customer_retention':
        case 'retention':
            $solutions = [
                "Buat loyalty program khusus untuk {$customerName} dengan benefit eksklusif",
                "Implementasi personalized shopping experience untuk repeat customers",
                "Setup customer retention campaign dengan discount dan special offers"
            ];
            break;
            
        case 'process_improvement':
        case 'improvement':
            $solutions = [
                "Optimasi return processing time menjadi maksimal 24 jam",
                "Implementasi express return service untuk VIP customers",
                "Setup automated refund system untuk faster processing"
            ];
            break;
            
        default:
            $solutions = [
                "Analisis mendalam return pattern {$customerName} dalam 1 minggu",
                "Buat personalized customer experience plan",
                "Monitor customer satisfaction secara real-time selama 30 hari"
            ];
    }
    
    return $solutions;
}
?>
