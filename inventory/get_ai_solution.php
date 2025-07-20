<?php
require_once 'ai_helper_transfer.php';

header('Content-Type: application/json');

try {
    // Ambil suggestion terbaru
    $currentSuggestion = getTransferAIInsight();
    
    if (!$currentSuggestion['success']) {
        echo json_encode([
            'success' => false,
            'message' => 'No AI suggestion available'
        ]);
        exit;
    }
    
    // Generate 3 actionable solutions berdasarkan suggestion yang ada
    $solutions = generateTransferActionableSolutions($currentSuggestion['data']);
    
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

function generateTransferActionableSolutions($suggestion) {
    // Analisis jenis insight untuk memberikan solusi yang tepat
    $insightType = $suggestion['insight_type'] ?? 'general';
    $branchFrom = $suggestion['branch_from'] ?? 'Branch';
    $branchTo = $suggestion['branch_to'] ?? 'Branch';
    
    $solutions = [];
    
    switch (strtolower($insightType)) {
        case 'route_optimization':
        case 'optimasi_rute':
            $solutions = [
                "Implementasi rute langsung {$branchFrom} ke {$branchTo} dalam 1 minggu",
                "Analisis traffic pattern untuk optimasi jadwal transfer",
                "Setup automated routing system untuk efisiensi maksimal"
            ];
            break;
            
        case 'efficiency':
        case 'efisiensi':
            $solutions = [
                "Audit proses transfer {$branchFrom} dalam 3 hari",
                "Implementasi real-time tracking untuk semua transfer",
                "Training tim untuk prosedur transfer yang lebih efisien"
            ];
            break;
            
        case 'cost_reduction':
        case 'pengurangan_biaya':
            $solutions = [
                "Review kontrak transportasi untuk rute {$branchFrom}-{$branchTo}",
                "Implementasi bulk transfer untuk mengurangi biaya per unit",
                "Analisis alternatif transportasi yang lebih cost-effective"
            ];
            break;
            
        case 'time_optimization':
        case 'optimasi_waktu':
            $solutions = [
                "Setup express transfer lane untuk item prioritas tinggi",
                "Implementasi pre-scheduling system untuk transfer rutin",
                "Optimasi loading/unloading process di kedua branch"
            ];
            break;
            
        default:
            $solutions = [
                "Analisis mendalam performa transfer {$branchFrom}-{$branchTo} dalam 1 minggu",
                "Buat action plan spesifik untuk optimasi transfer corridor",
                "Monitor KPI transfer secara real-time selama 30 hari"
            ];
    }
    
    return $solutions;
}
?>
