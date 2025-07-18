from flask import Flask, request, jsonify
from flask_cors import CORS
import mysql.connector
from openai import OpenAI
from datetime import datetime
import random
import json
import logging

# Setup logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Flask app setup
app = Flask(__name__)
CORS(app)  # Enable CORS for frontend

# Konfigurasi Groq API dengan syntax baru
client = OpenAI(
    api_key="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",
    base_url="https://api.groq.com/openai/v1"
)

def get_database_connections():
    """Koneksi ke kedua database"""
    try:
        # Database utama IKEA
        ikea_conn = mysql.connector.connect(
            host="localhost",
            user="root", 
            password="",
            database="ikea"
        )
        
        # Database AI Insight
        ai_conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="", 
            database="ikea_ai_insight"
        )
        
        return ikea_conn, ai_conn
        
    except Exception as e:
        logger.error(f"Database connection error: {e}")
        return None, None

def get_enhanced_context():
    """Get enhanced context dengan data real dari database"""
    ikea_conn, ai_conn = get_database_connections()
    
    if not ikea_conn or not ai_conn:
        return get_fallback_context()
    
    try:
        context = {}
        
        # Get top performing brands dari database AI atau main
        cursor = ai_conn.cursor(dictionary=True)
        cursor.execute("""
            SELECT brand_name, monthly_sales, rating, stock_availability 
            FROM brand 
            WHERE status != 'inactive' 
            ORDER BY monthly_sales DESC 
            LIMIT 3
        """)
        
        brands = cursor.fetchall()
        if brands:
            top_brands = []
            for row in brands:
                top_brands.append(f"{row['brand_name']} (Sales: {row['monthly_sales']:,}, Rating: {row['rating']})")
            context['top_brands'] = ', '.join(top_brands)
        else:
            context['top_brands'] = 'LACK, HEMNES, BILLY'
        
        # Get store performance dari database utama
        cursor = ikea_conn.cursor(dictionary=True)
        cursor.execute("""
            SELECT t.nama_toko, r.pendapatan, r.profit 
            FROM toko t 
            JOIN revenue r ON t.id_toko = r.id_toko 
            WHERE r.periode = (SELECT MAX(periode) FROM revenue)
            ORDER BY r.pendapatan DESC 
            LIMIT 3
        """)
        
        stores = cursor.fetchall()
        if stores:
            top_stores = []
            for row in stores:
                top_stores.append(f"{row['nama_toko']} (Revenue: Rp{row['pendapatan']:,}, Profit: {row['profit']}%)")
            context['top_stores'] = ', '.join(top_stores)
        else:
            context['top_stores'] = 'IKEA Alam Sutera, IKEA Bali, IKEA Sentul'
        
        # Get category performance dari database utama
        cursor.execute("""
            SELECT c.category_name, p.units_sold, p.growth_rate 
            FROM categories_product c 
            LEFT JOIN category_performance_metrics p ON c.id = p.category_id 
            WHERE c.status = 'Active' AND p.units_sold IS NOT NULL
            ORDER BY p.units_sold DESC 
            LIMIT 3
        """)
        
        categories = cursor.fetchall()
        if categories:
            top_categories = []
            for row in categories:
                top_categories.append(f"{row['category_name']} (Units: {row['units_sold']:,}, Growth: {row['growth_rate']}%)")
            context['top_categories'] = ', '.join(top_categories)
        else:
            context['top_categories'] = 'Furniture, Storage, Lighting'
        
        # Get recent AI insights dari database AI
        cursor = ai_conn.cursor(dictionary=True)
        cursor.execute("""
            SELECT recommendation, insight_type, urgency 
            FROM ai_recommendations 
            ORDER BY generated_at DESC 
            LIMIT 2
        """)
        
        insights = cursor.fetchall()
        if insights:
            recent_insights = []
            for row in insights:
                recent_insights.append(f"{row['insight_type']}: {row['recommendation'][:100]}... (Urgency: {row['urgency']})")
            context['recent_insights'] = '; '.join(recent_insights)
        else:
            context['recent_insights'] = 'Stock optimization needed, Marketing campaign recommended'
        
        return context
        
    except Exception as e:
        logger.error(f"Error getting enhanced context: {e}")
        return get_fallback_context()
    
    finally:
        if ikea_conn:
            ikea_conn.close()
        if ai_conn:
            ai_conn.close()

def get_fallback_context():
    """Fallback context jika database error"""
    return {
        'top_brands': 'LACK, HEMNES, BILLY',
        'top_stores': 'IKEA Alam Sutera, IKEA Bali, IKEA Sentul',
        'top_categories': 'Furniture, Storage, Lighting',
        'recent_insights': 'Stock optimization needed, Marketing campaign recommended'
    }

def generate_chat_response(user_message, context):
    """Generate chat response menggunakan Groq AI"""
    
    system_prompt = f"""
Anda adalah IKEA AI Assistant yang ahli dalam manajemen retail dan analisis bisnis IKEA Indonesia.

KONTEKS DATA TERKINI:
- Top Performing Brands: {context['top_brands']}
- Top Performing Stores: {context['top_stores']}  
- Top Categories: {context['top_categories']}
- Recent AI Insights: {context['recent_insights']}

INSTRUKSI:
1. Jawab dalam Bahasa Indonesia yang profesional
2. Berikan insights yang actionable dan spesifik untuk IKEA
3. Gunakan data yang tersedia untuk mendukung analisis
4. Fokus pada aspek manajemen: revenue, operasional, inventory, customer satisfaction
5. Berikan rekomendasi praktis yang dapat diimplementasikan
6. Gunakan format yang mudah dibaca dengan bullet points jika perlu
7. Jika tidak ada data spesifik, berikan analisis umum yang relevan untuk retail furniture

BATASAN:
- Hanya jawab pertanyaan terkait IKEA management dan bisnis retail
- Jangan berikan informasi yang tidak relevan dengan konteks IKEA
- Jika pertanyaan di luar scope, arahkan kembali ke topik IKEA management
"""
    
    try:
        response = client.chat.completions.create(
            model="mixtral-8x7b-32768",
            messages=[
                {
                    "role": "system",
                    "content": system_prompt
                },
                {
                    "role": "user", 
                    "content": user_message
                }
            ],
            temperature=0.7,
            max_tokens=500,
            top_p=0.9
        )
        
        return response.choices[0].message.content.strip()
        
    except Exception as e:
        logger.error(f"Error generating chat response: {e}")
        return get_fallback_response(user_message)

def get_fallback_response(user_query):
    """Enhanced fallback response berdasarkan keyword"""
    fallback_responses = {
        'revenue': 'Berdasarkan data terkini, revenue IKEA menunjukkan tren positif dengan total Rp 105.8M bulan ini. Toko IKEA Alam Sutera dan Bali menunjukkan performa terbaik. Saya merekomendasikan fokus pada optimasi kategori furniture dan storage yang menunjukkan performa terbaik.',
        'brands': 'Brand LACK, HEMNES, dan BILLY menunjukkan performa terbaik dengan rating tinggi dan penjualan stabil. LACK memiliki rating 4.5 dengan penjualan 1,850 unit/bulan. Pertimbangkan untuk meningkatkan stock availability dan marketing untuk brand dengan rating tinggi.',
        'stores': 'Dari 7 toko aktif, IKEA Alam Sutera dan Bali menunjukkan performa revenue terbaik. Alam Sutera mencapai target 92% dengan profit margin 1.5%. Analisis operasional mereka dapat dijadikan best practice untuk toko lain.',
        'categories': 'Dari 21 kategori aktif, kategori Furniture dan Storage menunjukkan growth rate tertinggi. Furniture memiliki market share 35.2% dengan growth 12.3%. Fokuskan inventory dan marketing pada kategori ini.',
        'inventory': 'Status inventory menunjukkan beberapa brand memerlukan perhatian. POÄNG memiliki stock availability 82.1% (perlu restock), sementara BILLY mencapai 95.8% (optimal). Monitor brand dengan stock di bawah 85%.',
        'customers': 'Customer satisfaction rata-rata 4.5/5 dengan return rate 5%. Kategori furniture menunjukkan tingkat kepuasan tertinggi. Focus pada peningkatan kualitas produk dengan rating di bawah 4.0.',
        'suppliers': 'Dari supplier aktif, PT Furnitur Maju menunjukkan performa terbaik dengan rating 8.2/10 dan on-time delivery 85%. Pertimbangkan evaluasi supplier dengan performance di bawah 7.0.',
        'performance': 'Summary performa IKEA: 7 toko aktif, 12 brand, revenue Rp 105.8M/bulan. Top performers: Alam Sutera (92% target), LACK brand (4.5 rating), Furniture category (35.2% market share). Area improvement: stock optimization untuk POÄNG, supplier delivery time.',
        'default': 'Terima kasih atas pertanyaan Anda tentang IKEA management. Berdasarkan data yang tersedia: 7 toko aktif dengan revenue Rp 105.8M, 12 brand dengan LACK sebagai top performer, dan 21 kategori produk. Saya merekomendasikan fokus pada optimasi inventory, peningkatan customer satisfaction, dan analisis performa toko secara berkala.'
    }
    
    # Simple keyword matching for fallback
    response_key = 'default'
    for key in ['revenue', 'brands', 'stores', 'categories', 'inventory', 'customers', 'suppliers', 'performance']:
        if key in user_query.lower():
            response_key = key
            break
    
    return fallback_responses[response_key]

def log_conversation(user_query, ai_response):
    """Log conversation ke database"""
    ikea_conn, ai_conn = get_database_connections()
    
    if not ai_conn:
        return False
    
    try:
        cursor = ai_conn.cursor()
        cursor.execute("""
            INSERT INTO ai_chat_logs (user_query, ai_response, created_at) 
            VALUES (%s, %s, NOW())
        """, (user_query, ai_response))
        ai_conn.commit()
        return True
        
    except Exception as e:
        logger.error(f"Failed to log conversation: {e}")
        return False
    
    finally:
        if ai_conn:
            ai_conn.close()

# === CHAT API ENDPOINT ===
@app.route('/api/chat', methods=['POST'])
def chat_api():
    """Main chat API endpoint - menggantikan ai-chat-api.php"""
    try:
        # Get JSON input
        data = request.get_json()
        
        if not data or 'message' not in data or 'user_query' not in data:
            return jsonify({
                'success': False,
                'error': 'Missing required parameters'
            }), 400
        
        user_message = data['message']
        user_query = data['user_query']
        
        logger.info(f"Received chat request: {user_query}")
        
        # Get enhanced context
        context = get_enhanced_context()
        
        # Generate AI response
        ai_response = generate_chat_response(user_message, context)
        
        # Log conversation
        log_conversation(user_query, ai_response)
        
        return jsonify({
            'success': True,
            'response': ai_response,
            'timestamp': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        })
        
    except Exception as e:
        logger.error(f"Error in chat API: {e}")
        return jsonify({
            'success': True,
            'response': get_fallback_response(data.get('user_query', '')),
            'fallback': True
        })

@app.route('/api/health', methods=['GET'])
def health_check():
    """Health check endpoint"""
    return jsonify({
        'status': 'healthy',
        'service': 'IKEA AI Chat Server',
        'timestamp': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    })

if __name__ == '__main__':
    logger.info("🚀 Starting IKEA AI Chat Server...")
    logger.info("📡 Chat API available at: http://localhost:5000/api/chat")
    logger.info("❤️ Health Check available at: http://localhost:5000/api/health")
    
    app.run(host='0.0.0.0', port=5000, debug=True)
