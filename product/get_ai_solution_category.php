<?php
require_once 'ai_helper_category.php';

header('Content-Type: application/json');

try {
    // Ambil suggestion terbaru
    $currentSuggestion = getCategoryAIInsight();
    
    if (!$currentSuggestion['success']) {
        echo json_encode([
            'success' => false,
            'message' => 'No AI suggestion available'
        ]);
        exit;
    }
    
    // Generate 3 actionable solutions berdasarkan suggestion yang ada
    $solutions = generateCategoryActionableSolutions($currentSuggestion['data']);
    
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

function generateCategoryActionableSolutions($suggestion) {
    // Analisis jenis insight untuk memberikan solusi yang tepat
    $insightType = $suggestion['insight_type'] ?? 'general';
    $categoryName = $suggestion['category_name'] ?? 'Kategori';
    
    $solutions = [];
    
    switch (strtolower($insightType)) {
        case 'expansion':
        case 'ekspansi':
            $solutions = [
                "Riset pasar untuk ekspansi {$categoryName} dalam 2 minggu",
                "Buat roadmap pengembangan produk {$categoryName} untuk Q4 2025",
                "Analisis kompetitor di segmen {$categoryName} premium selama 1 bulan"
            ];
            break;
            
        case 'optimization':
        case 'optimasi':
            $solutions = [
                "Audit performa kategori {$categoryName} dalam 1 minggu",
                "Implementasi strategi cross-selling untuk {$categoryName}",
                "Review dan update deskripsi {$categoryName} untuk SEO"
            ];
            break;
            
        case 'marketing':
            $solutions = [
                "Buat campaign khusus untuk kategori {$categoryName}",
                "Tingkatkan visibility {$categoryName} di homepage",
                "Jalankan A/B test untuk layout {$categoryName} baru"
            ];
            break;
            
        case 'budget':
            $solutions = [
                "Review alokasi budget untuk kategori {$categoryName}",
                "Analisis ROI marketing spend {$categoryName} vs kategori lain",
                "Buat proposal budget tambahan untuk {$categoryName} Q4 2025"
            ];
            break;
            
        default:
            $solutions = [
                "Analisis mendalam performa {$categoryName} dalam 1 minggu",
                "Buat action plan spesifik untuk optimasi {$categoryName}",
                "Monitor KPI {$categoryName} secara real-time selama 30 hari"
            ];
    }
    
    return $solutions;
}
?>
