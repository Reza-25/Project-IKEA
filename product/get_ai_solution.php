<?php
require_once 'ai_helper.php';

header('Content-Type: application/json');

try {
    // Ambil suggestion terbaru
    $currentSuggestion = getLatestAISuggestion();
    
    if (!$currentSuggestion) {
        echo json_encode([
            'success' => false,
            'message' => 'No AI suggestion available'
        ]);
        exit;
    }
    
    // Generate 3 actionable solutions berdasarkan suggestion yang ada
    $solutions = generateActionableSolutions($currentSuggestion);
    
    echo json_encode([
        'success' => true,
        'solutions' => $solutions,
        'based_on' => $currentSuggestion['recommendation']
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}

function generateActionableSolutions($suggestion) {
    // Analisis jenis insight untuk memberikan solusi yang tepat
    $insightType = $suggestion['insight_type'] ?? 'general';
    $brandName = $suggestion['brand_name'] ?? 'Brand';
    
    $solutions = [];
    
    switch ($insightType) {
        case 'stock':
            $solutions = [
                "Tingkatkan stok {$brandName} sebesar 25% untuk 2 minggu ke depan",
                "Buat alert otomatis ketika stok {$brandName} di bawah 30%", 
                "Koordinasi dengan supplier untuk fast-track delivery {$brandName}"
            ];
            break;
            
        case 'promotion':
            $solutions = [
                "Buat bundle promo {$brandName} dengan produk komplementer",
                "Jalankan flash sale {$brandName} di weekend dengan diskon 15%",
                "Aktifkan push notification untuk member premium tentang {$brandName}"
            ];
            break;
            
        case 'hr':
            $solutions = [
                "Training tim sales fokus upselling produk {$brandName}",
                "Buat incentive khusus untuk sales yang jual {$brandName} terbanyak",
                "Workshop product knowledge {$brandName} untuk semua staff"
            ];
            break;
            
        case 'pricing':
            $solutions = [
                "Review harga {$brandName} vs kompetitor dalam 3 hari",
                "Test A/B pricing {$brandName} dengan variasi 5-10%",
                "Buat strategi dynamic pricing untuk {$brandName} berdasarkan demand"
            ];
            break;
            
        default:
            $solutions = [
                "Analisis mendalam performa {$brandName} dalam 1 minggu",
                "Buat action plan spesifik untuk optimasi {$brandName}",
                "Monitor KPI {$brandName} secara real-time selama 30 hari"
            ];
    }
    
    return $solutions;
}
?>
