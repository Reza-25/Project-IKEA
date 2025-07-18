<?php
header('Content-Type: application/json');
require_once 'ai_helper_category.php';

try {
    // Get fresh AI insight
    $aiResult = getCategoryAIInsight();
    
    if ($aiResult['success']) {
        $insight = $aiResult['data'];
        
        // Format response
        $response = [
            'success' => true,
            'message' => 'AI suggestion refreshed successfully',
            'data' => [
                'recommendation' => $insight['recommendation'],
                'insight_type' => formatInsightType($insight['insight_type']),
                'urgency' => formatUrgency($insight['urgency']),
                'urgency_color' => getUrgencyColor($insight['urgency']),
                'category_name' => $insight['category_name'] ?? 'General',
                'generated_at' => date('d M Y H:i', strtotime($insight['generated_at'])),
                'timestamp' => time()
            ]
        ];
    } else {
        throw new Exception($aiResult['error'] ?? 'Failed to get AI insight');
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Error refreshing AI suggestion: ' . $e->getMessage(),
        'data' => [
            'recommendation' => 'Sistem AI sedang dalam pemeliharaan. Silakan coba lagi nanti.',
            'insight_type' => 'System',
            'urgency' => 'Low',
            'urgency_color' => '#6c757d',
            'category_name' => 'System',
            'generated_at' => date('d M Y H:i'),
            'timestamp' => time()
        ]
    ];
}

echo json_encode($response);
?>
