<?php
// AI Chat Interface untuk IKEA Management System - FIXED VERSION
// Koneksi ke database utama IKEA
$host = "localhost";
$user = "root";
$password = "";
$database_main = "ikea";
$database_ai = "ikea_ai_insight";

// Koneksi ke database utama IKEA
$conn_main = new mysqli($host, $user, $password, $database_main);
if ($conn_main->connect_error) {
    die("Koneksi database IKEA gagal: " . $conn_main->connect_error);
}

// Koneksi ke database AI Insight
$conn_ai = new mysqli($host, $user, $password, $database_ai);
if ($conn_ai->connect_error) {
    die("Koneksi database AI Insight gagal: " . $conn_ai->connect_error);
}

// Function untuk get quick stats untuk context AI
function getIkeaQuickStats() {
    global $conn_main, $conn_ai;
    
    try {
        $stats = [];
        
        // Total stores - dari database utama
        $result = $conn_main->query("SELECT COUNT(*) as total FROM toko WHERE status = 'active'");
        if ($result) {
            $stats['total_stores'] = $result->fetch_assoc()['total'];
        } else {
            $stats['total_stores'] = 7; // fallback
        }
        
        // Total brands - dari database AI atau utama
        $result = $conn_ai->query("SELECT COUNT(*) as total FROM brand WHERE status != 'inactive'");
        if ($result && $result->num_rows > 0) {
            $stats['total_brands'] = $result->fetch_assoc()['total'];
        } else {
            // Fallback ke database utama
            $result = $conn_main->query("SELECT COUNT(*) as total FROM brand WHERE status != 'inactive'");
            $stats['total_brands'] = $result ? $result->fetch_assoc()['total'] : 12;
        }
        
        // Total categories - dari database utama
        $result = $conn_main->query("SELECT COUNT(*) as total FROM categories_product WHERE status = 'Active'");
        if ($result) {
            $stats['total_categories'] = $result->fetch_assoc()['total'];
        } else {
            $stats['total_categories'] = 21; // fallback
        }
        
        // Monthly revenue - dari database utama
        $result = $conn_main->query("SELECT SUM(pendapatan) as total FROM revenue WHERE periode = (SELECT MAX(periode) FROM revenue)");
        if ($result) {
            $revenue = $result->fetch_assoc();
            $stats['monthly_revenue'] = $revenue['total'] ?? 105800000;
        } else {
            $stats['monthly_revenue'] = 105800000; // fallback
        }
        
        return $stats;
        
    } catch (Exception $e) {
        // Fallback data jika ada error
        return [
            'total_stores' => 7,
            'total_brands' => 12,
            'total_categories' => 21,
            'monthly_revenue' => 105800000
        ];
    }
}

$ikea_stats = getIkeaQuickStats();
?>

<!-- AI Button -->
<div class="ai-button" id="aiButton">
    <img src="../assets/img/logo1.png" alt="AI Logo" />
    <div class="ai-notification" id="aiNotification">1</div>
</div>

<!-- AI Chat Popup -->
<div class="ai-popup" id="aiPopup">
    <div class="ai-header">
        <div class="ai-header-info">
            <h5>RuangKu Assistant</h5>
            <span class="ai-status">🟢 Online</span>
        </div>
        <button class="close-popup" id="closePopup">&times;</button>
    </div>
    
    <!-- Quick Templates Section -->
    <div class="ai-templates" id="aiTemplates">
        <div class="template-header">
            <span>Quick Questions</span>
            <button class="toggle-templates" id="toggleTemplates">−</button>
        </div>
        <div class="template-grid" id="templateGrid">
            <button class="template-btn" data-template="revenue">📊 Revenue Analysis</button>
            <button class="template-btn" data-template="brands">🏷️ Brand Performance</button>
            <button class="template-btn" data-template="stores">🏪 Store Operations</button>
            <button class="template-btn" data-template="categories">📦 Category Insights</button>
            <button class="template-btn" data-template="inventory">📋 Inventory Status</button>
            <button class="template-btn" data-template="customers">👥 Customer Analytics</button>
            <button class="template-btn" data-template="suppliers">🚚 Supplier Management</button>
            <button class="template-btn" data-template="performance">📈 Performance Metrics</button>
        </div>
    </div>
    
    <!-- Chat Messages Area -->
    <div class="ai-body" id="aiChatBody">
        <div class="welcome-message">
            <div class="ai-message">
                <div class="message-avatar">🤖</div>
                <div class="message-content">
                    <p><strong>Halo! Saya IKEA AI Assistant</strong></p>
                    <p>Saya siap membantu Anda dengan analisis dan insights tentang:</p>
                    <ul>
                        <li>📊 Analisis revenue dan profit (<?php echo $ikea_stats['total_stores']; ?> toko aktif)</li>
                        <li>🏷️ Performa brand dan produk (<?php echo $ikea_stats['total_brands']; ?> brand)</li>
                        <li>🏪 Operasional toko dan cabang</li>
                        <li>📦 Manajemen kategori dan inventory (<?php echo $ikea_stats['total_categories']; ?> kategori)</li>
                        <li>👥 Customer insights dan returns</li>
                        <li>🚚 Supplier performance</li>
                    </ul>
                    <p>Revenue bulan ini: <strong>Rp <?php echo number_format($ikea_stats['monthly_revenue'], 0, ',', '.'); ?></strong></p>
                    <p>Pilih quick question di atas atau ketik pertanyaan Anda!</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Typing Indicator -->
    <div class="typing-indicator" id="typingIndicator" style="display: none;">
        <div class="ai-message">
            <div class="message-avatar">🤖</div>
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    
    <!-- Chat Input -->
    <div class="ai-footer">
        <div class="input-container">
            <input type="text" id="chatInput" placeholder="Tanya tentang Ruangku management..." maxlength="500" />
            <div class="input-actions">
                <button class="send-btn" id="sendBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="chat-footer-info">
            <small>AI RuangKu Management System</small>
        </div>
    </div>
</div>

<!-- Enhanced CSS -->
<style>
/* AI Button */
.ai-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #001F3F, #0056b3);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0, 31, 63, 0.3);
    cursor: pointer;
    z-index: 1000;
    transition: all 0.3s ease;
    position: relative;
}

.ai-button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(0, 31, 63, 0.4);
}

.ai-button img {
    width: 35px;
    height: 35px;
    filter: brightness(0) invert(1);
}

.ai-notification {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* AI Popup */
.ai-popup {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 380px;
    max-height: 600px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    display: none;
    z-index: 1001;
    overflow: hidden;
    border: 1px solid #e0e0e0;
}

.ai-header {
    background: linear-gradient(135deg, #001F3F, #0056b3);
    color: #fff;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ai-header-info h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.ai-status {
    font-size: 12px;
    opacity: 0.9;
}

.close-popup {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s;
}

.close-popup:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

/* Quick Templates */
.ai-templates {
    background: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
}

.template-header {
    padding: 12px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 14px;
    color: #495057;
}

.toggle-templates {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #6c757d;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.template-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    padding: 0 15px 15px;
}

.template-btn {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 10px 8px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
    color: #495057;
}

.template-btn:hover {
    background: #001F3F;
    color: white;
    border-color: #001F3F;
    transform: translateY(-1px);
}

/* Chat Body */
.ai-body {
    height: 300px;
    overflow-y: auto;
    padding: 15px;
    background: #fff;
}

.ai-body::-webkit-scrollbar {
    width: 6px;
}

.ai-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.ai-body::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.ai-body::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Messages */
.ai-message, .user-message {
    display: flex;
    margin-bottom: 15px;
    animation: fadeInUp 0.3s ease;
}

.user-message {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    margin: 0 10px;
    flex-shrink: 0;
}

.ai-message .message-avatar {
    background: #e3f2fd;
}

.user-message .message-avatar {
    background: #001F3F;
    color: white;
    font-size: 14px;
}

.message-content {
    max-width: 80%;
    padding: 12px 15px;
    border-radius: 15px;
    font-size: 14px;
    line-height: 1.4;
}

.ai-message .message-content {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-bottom-left-radius: 5px;
}

.user-message .message-content {
    background: #001F3F;
    color: white;
    border-bottom-right-radius: 5px;
}

.message-content p {
    margin: 0 0 8px 0;
}

.message-content p:last-child {
    margin-bottom: 0;
}

.message-content ul {
    margin: 8px 0;
    padding-left: 20px;
}

.message-content li {
    margin-bottom: 4px;
}

.welcome-message .message-content {
    background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
    border: 1px solid #bbdefb;
}

/* Typing Indicator */
.typing-indicator {
    padding: 0 15px;
}

.typing-dots {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background: #f8f9fa;
    border-radius: 15px;
    border-bottom-left-radius: 5px;
    border: 1px solid #e9ecef;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #6c757d;
    margin: 0 2px;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) { animation-delay: -0.32s; }
.typing-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes typing {
    0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
    40% { transform: scale(1); opacity: 1; }
}

/* Chat Footer */
.ai-footer {
    background: #fff;
    border-top: 1px solid #e0e0e0;
    padding: 15px;
}

.input-container {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 25px;
    padding: 8px 15px;
    transition: border-color 0.2s;
}

.input-container:focus-within {
    border-color: #001F3F;
    box-shadow: 0 0 0 2px rgba(0, 31, 63, 0.1);
}

#chatInput {
    flex: 1;
    border: none;
    background: none;
    outline: none;
    font-size: 14px;
    padding: 5px 0;
    color: #495057;
}

#chatInput::placeholder {
    color: #6c757d;
}

.send-btn {
    background: #001F3F;
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    margin-left: 10px;
}

.send-btn:hover {
    background: #0056b3;
    transform: scale(1.05);
}

.send-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
}

.chat-footer-info {
    text-align: center;
    margin-top: 8px;
}

.chat-footer-info small {
    color: #6c757d;
    font-size: 11px;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 480px) {
    .ai-popup {
        width: calc(100vw - 40px);
        right: 20px;
        left: 20px;
    }
    
    .template-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// AI Chat System
class IkeaAIChat {
    constructor() {
        this.isOpen = false;
        this.isTyping = false;
        this.templates = {
            revenue: "Bagaimana performa revenue RuangKu bulan ini? Apakah ada tren pertumbuhan yang signifikan?",
            brands: "Brand mana yang paling performan baik dan mana yang perlu perhatian khusus?",
            stores: "Bagaimana performa operasional toko-toko RuangKu? Toko mana yang paling efisien?",
            categories: "Kategori produk mana yang paling laris dan mana yang perlu strategi baru?",
            inventory: "Bagaimana status inventory saat ini? Apakah ada produk yang perlu restock urgent?",
            customers: "Bagaimana tingkat kepuasan customer dan tren return produk?",
            suppliers: "Bagaimana performa supplier dan apakah ada yang perlu evaluasi?",
            performance: "Berikan summary performa keseluruhan RuangKu management saat ini"
        };
        
        this.contextData = {
            total_stores: <?php echo $ikea_stats['total_stores']; ?>,
            total_brands: <?php echo $ikea_stats['total_brands']; ?>,
            total_categories: <?php echo $ikea_stats['total_categories']; ?>,
            monthly_revenue: <?php echo $ikea_stats['monthly_revenue']; ?>
        };
        
        this.initializeElements();
        this.bindEvents();
    }
    
    initializeElements() {
        this.aiButton = document.getElementById('aiButton');
        this.aiPopup = document.getElementById('aiPopup');
        this.closePopup = document.getElementById('closePopup');
        this.chatInput = document.getElementById('chatInput');
        this.sendBtn = document.getElementById('sendBtn');
        this.chatBody = document.getElementById('aiChatBody');
        this.typingIndicator = document.getElementById('typingIndicator');
        this.toggleTemplates = document.getElementById('toggleTemplates');
        this.templateGrid = document.getElementById('templateGrid');
        this.notification = document.getElementById('aiNotification');
    }
    
    bindEvents() {
        // Toggle popup
        this.aiButton.addEventListener('click', () => this.togglePopup());
        this.closePopup.addEventListener('click', () => this.closeChat());
        
        // Send message
        this.sendBtn.addEventListener('click', () => this.sendMessage());
        this.chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
        
        // Template buttons
        document.querySelectorAll('.template-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const template = e.target.dataset.template;
                this.useTemplate(template);
            });
        });
        
        // Toggle templates
        this.toggleTemplates.addEventListener('click', () => {
            const isVisible = this.templateGrid.style.display !== 'none';
            this.templateGrid.style.display = isVisible ? 'none' : 'grid';
            this.toggleTemplates.textContent = isVisible ? '+' : '−';
        });
        
        // Input validation
        this.chatInput.addEventListener('input', () => {
            const hasText = this.chatInput.value.trim().length > 0;
            this.sendBtn.disabled = !hasText;
        });
    }
    
    togglePopup() {
        if (this.isOpen) {
            this.closeChat();
        } else {
            this.openChat();
        }
    }
    
    openChat() {
        this.aiPopup.style.display = 'block';
        this.isOpen = true;
        this.chatInput.focus();
        this.hideNotification();
        
        // Add opening animation
        this.aiPopup.style.opacity = '0';
        this.aiPopup.style.transform = 'translateY(20px)';
        setTimeout(() => {
            this.aiPopup.style.transition = 'all 0.3s ease';
            this.aiPopup.style.opacity = '1';
            this.aiPopup.style.transform = 'translateY(0)';
        }, 10);
    }
    
    closeChat() {
        this.aiPopup.style.opacity = '0';
        this.aiPopup.style.transform = 'translateY(20px)';
        setTimeout(() => {
            this.aiPopup.style.display = 'none';
            this.isOpen = false;
        }, 300);
    }
    
    hideNotification() {
        this.notification.style.display = 'none';
    }
    
    useTemplate(templateKey) {
        const message = this.templates[templateKey];
        this.chatInput.value = message;
        this.sendMessage();
    }
    
    async sendMessage() {
        const message = this.chatInput.value.trim();
        if (!message || this.isTyping) return;
        
        // Add user message
        this.addUserMessage(message);
        this.chatInput.value = '';
        this.sendBtn.disabled = true;
        
        // Show typing indicator
        this.showTyping();
        
        try {
            // Send to AI API
            const response = await this.callAI(message);
            this.hideTyping();
            this.addAIMessage(response);
        } catch (error) {
            this.hideTyping();
            this.addAIMessage("Maaf, terjadi kesalahan. Silakan coba lagi dalam beberapa saat.");
        }
    }
    
    addUserMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'user-message';
        messageDiv.innerHTML = `
            <div class="message-avatar">👤</div>
            <div class="message-content">
                <p>${this.escapeHtml(message)}</p>
            </div>
        `;
        
        this.chatBody.appendChild(messageDiv);
        this.scrollToBottom();
    }
    
    addAIMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'ai-message';
        messageDiv.innerHTML = `
            <div class="message-avatar">🤖</div>
            <div class="message-content">
                ${this.formatAIResponse(message)}
            </div>
        `;
        
        this.chatBody.appendChild(messageDiv);
        this.scrollToBottom();
    }
    
    showTyping() {
        this.isTyping = true;
        this.typingIndicator.style.display = 'block';
        this.scrollToBottom();
    }
    
    hideTyping() {
        this.isTyping = false;
        this.typingIndicator.style.display = 'none';
    }
    
    async callAI(message) {
        // Create context for AI
        const context = `
        Anda adalah AI Assistant khusus untuk RuangKu Management System. 
        Data RuangKu saat ini:
        - Total Toko: ${this.contextData.total_stores}
        - Total Brand: ${this.contextData.total_brands}  
        - Total Kategori: ${this.contextData.total_categories}
        - Revenue Bulanan: Rp ${this.formatNumber(this.contextData.monthly_revenue)}
        
        Jawab pertanyaan berikut dengan fokus pada manajemen IKEA, berikan insights yang actionable dan spesifik.
        Gunakan data yang tersedia dan berikan rekomendasi praktis.
        
        Pertanyaan: ${message}
        `;
        
        const response = await fetch('ai-chat-api-fixed.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message: context,
                user_query: message
            })
        });
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const data = await response.json();
        return data.response || "Maaf, saya tidak dapat memproses permintaan Anda saat ini.";
    }
    
    formatAIResponse(response) {
        // Format response with better HTML
        let formatted = response
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/\n\n/g, '</p><p>')
            .replace(/\n/g, '<br>');
        
        // Wrap in paragraphs
        if (!formatted.startsWith('<p>')) {
            formatted = '<p>' + formatted + '</p>';
        }
        
        return formatted;
    }
    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }
    
    scrollToBottom() {
        setTimeout(() => {
            this.chatBody.scrollTop = this.chatBody.scrollHeight;
        }, 100);
    }
}

// Initialize AI Chat when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.ikeaAI = new IkeaAIChat();
});
</script>
