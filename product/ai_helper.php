<?php
// File helper sederhana untuk integrasi AI Groq

function getAIInsightConnection() {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ikea_ai_insight", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        error_log("AI DB Connection failed: " . $e->getMessage());
        return null;
    }
}

function getLatestAISuggestion() {
    $aiPdo = getAIInsightConnection();
    if (!$aiPdo) {
        return null;
    }
    
    try {
        // Query untuk mengambil AI suggestion terbaru
        $sql = "SELECT ar.recommendation, ar.insight_type, ar.urgency, ar.generated_at,
                       COALESCE(b.brand_name, 'Unknown Brand') as brand_name
                FROM ai_recommendations ar 
                LEFT JOIN brand b ON ar.brand_id = b.id 
                ORDER BY ar.generated_at DESC 
                LIMIT 1";
        $stmt = $aiPdo->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        
    } catch(PDOException $e) {
        error_log("Error fetching AI suggestion: " . $e->getMessage());
        return null;
    } finally {
        $aiPdo = null;
    }
}

function triggerAIGeneration() {
    $pythonScript = __DIR__ . '/../AI integrated/generate_ai_insight.py';
    $pythonPath = 'C:/xampp/htdocs/Semester 4 Projek/Project-IKEA/.venv/Scripts/python.exe';
    
    if (file_exists($pythonScript)) {
        $command = '"' . $pythonPath . '" "' . $pythonScript . '" > nul 2>&1 &';
        exec($command);
        return true;
    }
    return false;
}

// Function untuk create table jika belum ada
function createAITablesIfNotExists() {
    try {
        // Koneksi ke MySQL tanpa specify database dulu
        $pdo = new PDO("mysql:host=localhost", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create database jika belum ada
        $pdo->exec("CREATE DATABASE IF NOT EXISTS ikea_ai_insight");
        $pdo->exec("USE ikea_ai_insight");
        
        // Create table ai_recommendations jika belum ada
        $createTable = "
        CREATE TABLE IF NOT EXISTS ai_recommendations (
          id INT AUTO_INCREMENT PRIMARY KEY,
          brand_id INT NOT NULL,
          insight_type ENUM('stock','promotion','hr','pricing') NOT NULL,
          recommendation TEXT NOT NULL,
          urgency ENUM('low','medium','high') DEFAULT 'medium',
          generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          INDEX idx_brand_id (brand_id),
          INDEX idx_generated_at (generated_at)
        )";
        
        $pdo->exec($createTable);
        
        // Create table brand reference jika belum ada
        $createBrandTable = "
        CREATE TABLE IF NOT EXISTS brand (
          id INT PRIMARY KEY,
          brand_name VARCHAR(255),
          rating DECIMAL(2,1),
          monthly_sales INT,
          stock_availability INT,
          average_price DECIMAL(10,2),
          status VARCHAR(50),
          category_id INT
        )";
        
        $pdo->exec($createBrandTable);
        
        // Insert sample data jika table kosong
        $checkData = $pdo->query("SELECT COUNT(*) FROM ai_recommendations")->fetchColumn();
        if ($checkData == 0) {
            $sampleData = "
            INSERT INTO ai_recommendations (brand_id, insight_type, recommendation, urgency, generated_at) VALUES
            (1, 'stock', 'Berdasarkan data penjualan terkini, brand ini menunjukkan potensi pertumbuhan yang signifikan. Disarankan untuk meningkatkan stok sebesar 20% untuk mengantisipasi lonjakan permintaan.', 'medium', NOW()),
            (2, 'promotion', 'Brand ini memiliki rating tinggi namun penjualan masih bisa ditingkatkan. Pertimbangkan strategi promosi bundling dengan produk komplementer untuk meningkatkan volume penjualan.', 'low', NOW() - INTERVAL 1 HOUR),
            (3, 'hr', 'Performa brand menunjukkan tren positif. Tim sales perlu dilatih untuk fokus pada upselling produk premium dalam kategori ini untuk meningkatkan margin keuntungan.', 'high', NOW() - INTERVAL 2 HOUR)
            ";
            $pdo->exec($sampleData);
        }
        
        return true;
        
    } catch(PDOException $e) {
        error_log("Error creating AI tables: " . $e->getMessage());
        return false;
    }
}

// Auto-create tables saat file di-include
createAITablesIfNotExists();

// Test function untuk memastikan file ter-load dengan benar
function testAIHelper() {
    return "AI Helper loaded successfully!";
}

?>
