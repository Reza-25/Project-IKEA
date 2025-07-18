<?php
require_once 'ai_helper.php';

header('Content-Type: application/json');

try {
    // Trigger Python script untuk generate insight baru
    $generated = triggerAIGeneration();
    
    if ($generated) {
        // Wait sedikit untuk Python script selesai
        sleep(2);
        
        // Ambil suggestion terbaru
        $newSuggestion = getLatestAISuggestion();
        
        if ($newSuggestion) {
            echo json_encode([
                'success' => true,
                'suggestion' => $newSuggestion,
                'message' => 'AI suggestion refreshed successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No new suggestion generated'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to trigger AI generation'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>
