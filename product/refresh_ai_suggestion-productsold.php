<?php
require_once 'ai_helper_productsold.php';

header('Content-Type: application/json');

try {
    // Simulasi generate AI suggestion baru
    $newSuggestions = [
        [
            'recommendation' => 'Berdasarkan analisis tren penjualan Q3 2025, produk furniture menunjukkan pertumbuhan 15% dibanding periode sebelumnya. Sofa EKTORP dan Meja LACK menjadi driver utama pertumbuhan. Rekomendasi untuk ekspansi kategori furniture premium dengan target market segment menengah ke atas.',
            'insight_type' => 'sales_optimization',
            'urgency' => 'high',
            'generated_at' => date('d M H:i'),
            'product_name' => 'Furniture Category'
        ],
        [
            'recommendation' => 'Smart TV 55 inch menunjukkan potensi cross-selling yang tinggi dengan furniture entertainment. Data menunjukkan 68% customer yang membeli TV juga tertarik dengan furniture ruang keluarga. Implementasikan strategi bundling untuk meningkatkan average order value.',
            'insight_type' => 'promotion_opportunity', 
            'urgency' => 'medium',
            'generated_at' => date('d M H:i'),
            'product_name' => 'Smart TV & Furniture Bundle'
        ],
        [
            'recommendation' => 'Lampu LERSTA dengan rating 3.8 memerlukan improvement strategy. Analisis customer feedback menunjukkan isu pada durability dan design. Pertimbangkan untuk product refresh atau positioning ulang sebagai budget-friendly option dengan value proposition yang jelas.',
            'insight_type' => 'performance_analysis',
            'urgency' => 'medium', 
            'generated_at' => date('d M H:i'),
            'product_name' => 'Lampu LERSTA'
        ],
        [
            'recommendation' => 'Inventory turnover untuk kategori Electronics menunjukkan pola seasonal yang kuat. AC Split 1PK dan kipas angin mengalami peak demand di Q2-Q3. Rekomendasi untuk optimasi stok dengan predictive analytics dan seasonal adjustment strategy.',
            'insight_type' => 'inventory_management',
            'urgency' => 'low',
            'generated_at' => date('d M H:i'),
            'product_name' => 'Electronics Seasonal Products'
        ]
    ];
    
    // Pilih suggestion random
    $randomSuggestion = $newSuggestions[array_rand($newSuggestions)];
    
    echo json_encode([
        'success' => true,
        'data' => $randomSuggestion
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error generating AI suggestion: ' . $e->getMessage(),
        'data' => [
            'recommendation' => 'Sistem AI sedang dalam pemeliharaan. Berdasarkan data historis, produk furniture menunjukkan performa terbaik dengan tren pertumbuhan positif.',
            'insight_type' => 'performance_analysis',
            'urgency' => 'low',
            'generated_at' => date('d M H:i'),
            'product_name' => 'General Analysis'
        ]
    ]);
}
?>
