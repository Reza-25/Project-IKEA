import mysql.connector
from openai import OpenAI
from datetime import datetime
import random

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
        print(f"Database connection error: {e}")
        return None, None

def read_brand_data(ikea_conn):
    """Membaca data brand dari database ikea"""
    cursor = ikea_conn.cursor(dictionary=True)
    
    query = """
    SELECT 
        b.id,
        b.brand_name,
        b.rating,
        b.monthly_sales,
        b.stock_availability,
        b.average_price,
        b.status,
        cp.category_name
    FROM brand b
    LEFT JOIN categories_product cp ON b.category_id = cp.id
    WHERE b.status != 'inactive'
    ORDER BY b.monthly_sales DESC
    LIMIT 10
    """
    
    cursor.execute(query)
    brands = cursor.fetchall()
    cursor.close()
    
    return brands

def read_category_data(ikea_conn):
    """Membaca data category dari database ikea"""
    cursor = ikea_conn.cursor(dictionary=True)
    
    query = """
    SELECT 
        c.id,
        c.category_name,
        c.category_code,
        c.description,
        c.status,
        p.units_sold,
        p.profit_margin,
        p.growth_rate,
        p.market_share,
        p.total_sales
    FROM categories_product c
    LEFT JOIN category_performance_metrics p ON c.id = p.category_id
    WHERE c.status = 'Active'
    ORDER BY p.units_sold DESC
    LIMIT 8
    """
    
    cursor.execute(query)
    categories = cursor.fetchall()
    cursor.close()
    
    return categories

def generate_groq_insight(brand_data):
    """Generate insight menggunakan Groq AI berdasarkan data brand - SYNTAX BARU"""
    
    # Pilih tipe insight secara random
    insight_types = ['stock', 'promotion', 'hr', 'pricing']
    insight_type = random.choice(insight_types)
    
    # Template prompt berdasarkan data brand
    prompt = f"""
    Analisis brand IKEA berikut dan berikan rekomendasi bisnis yang singkat dan langsung ke poin:
    
    Brand: {brand_data['brand_name']}
    Kategori: {brand_data['category_name']}
    Rating: {brand_data['rating']}/5
    Penjualan Bulanan: {brand_data['monthly_sales']} unit
    Ketersediaan Stok: {brand_data['stock_availability']}%
    Harga Rata-rata: Rp {brand_data['average_price']}
    Status: {brand_data['status']}
    
    Berikan 1 rekomendasi {insight_type} yang actionable dalam 1 kalimat.
    """
    
    try:
        # SYNTAX BARU untuk OpenAI >= 1.0.0
        response = client.chat.completions.create(
            model="mistral-saba-24b",
            messages=[
                {
                    "role": "system", 
                    "content": "Kamu adalah konsultan bisnis IKEA yang berpengalaman. Berikan rekomendasi yang praktis dan dapat diimplementasikan berdasarkan data yang diberikan."
                },
                {
                    "role": "user", 
                    "content": prompt
                }
            ],
            temperature=0.5,
            max_tokens=50
        )
        
        recommendation = response.choices[0].message.content.strip()
        return recommendation, insight_type
        
    except Exception as e:
        print(f"Error generating Groq insight: {e}")
        # Fallback recommendation
        return f"Rekomendasi untuk {brand_data['brand_name']}: Perlu optimasi berdasarkan performa rating {brand_data['rating']} dan stok {brand_data['stock_availability']}%.", insight_type

def generate_category_insight(category_data):
    """Generate insight untuk category menggunakan Groq AI"""
    
    insight_types = ['expansion', 'optimization', 'marketing', 'budget']
    insight_type = random.choice(insight_types)
    
    # Handle None values
    units_sold = category_data.get('units_sold') or 0
    profit_margin = category_data.get('profit_margin') or 0
    growth_rate = category_data.get('growth_rate') or 0
    market_share = category_data.get('market_share') or 0
    total_sales = category_data.get('total_sales') or 0
    
    prompt = f"""
    Analisis kategori produk IKEA berikut dan berikan rekomendasi bisnis yang singkat:
    
    Kategori: {category_data['category_name']}
    Kode: {category_data['category_code']}
    Deskripsi: {category_data['description']}
    Status: {category_data['status']}
    Unit Terjual: {units_sold}
    Profit Margin: {profit_margin}%
    Growth Rate: {growth_rate}%
    Market Share: {market_share}%
    Total Sales: Rp {total_sales}
    
    Berikan 1 rekomendasi {insight_type} yang actionable dalam 1 kalimat.
    """
    
    try:
        response = client.chat.completions.create(
            model="mistral-saba-24b",
            messages=[
                {
                    "role": "system", 
                    "content": "Kamu adalah konsultan bisnis IKEA yang ahli dalam analisis kategori produk. Berikan rekomendasi strategis yang dapat diimplementasikan."
                },
                {
                    "role": "user", 
                    "content": prompt
                }
            ],
            temperature=0.5,
            max_tokens=50
        )
        
        recommendation = response.choices[0].message.content.strip()
        return recommendation, insight_type
        
    except Exception as e:
        print(f"Error generating category insight: {e}")
        return f"Rekomendasi untuk kategori {category_data['category_name']}: Perlu analisis lebih lanjut untuk optimasi performa dengan growth rate {growth_rate}%.", insight_type

def calculate_urgency(brand_data):
    """Hitung tingkat urgency berdasarkan data brand"""
    urgency_score = 0
    
    # Rating rendah = urgent
    if brand_data['rating'] < 4.0:
        urgency_score += 2
    elif brand_data['rating'] < 4.5:
        urgency_score += 1
    
    # Stok rendah = urgent  
    if brand_data['stock_availability'] < 50:
        urgency_score += 3
    elif brand_data['stock_availability'] < 80:
        urgency_score += 1
        
    # Penjualan rendah = urgent
    if brand_data['monthly_sales'] < 1000:
        urgency_score += 2
    elif brand_data['monthly_sales'] < 1500:
        urgency_score += 1
    
    # Tentukan level urgency
    if urgency_score >= 4:
        return 'high'
    elif urgency_score >= 2:
        return 'medium'
    else:
        return 'low'

def calculate_category_urgency(category_data):
    """Hitung tingkat urgency berdasarkan data category"""
    urgency_score = 0
    
    units_sold = category_data.get('units_sold') or 0
    growth_rate = category_data.get('growth_rate') or 0
    market_share = category_data.get('market_share') or 0
    
    # Units sold rendah = urgent
    if units_sold < 500:
        urgency_score += 3
    elif units_sold < 800:
        urgency_score += 1
    
    # Growth rate negatif atau rendah = urgent
    if growth_rate < 0:
        urgency_score += 3
    elif growth_rate < 5:
        urgency_score += 2
    elif growth_rate < 10:
        urgency_score += 1
        
    # Market share rendah = urgent
    if market_share < 10:
        urgency_score += 2
    elif market_share < 20:
        urgency_score += 1
    
    if urgency_score >= 4:
        return 'high'
    elif urgency_score >= 2:
        return 'medium'
    else:
        return 'low'

def save_to_ai_database(ai_conn, brand_id, insight_type, recommendation, urgency):
    """Simpan hasil AI ke database ikea_ai_insight"""
    cursor = ai_conn.cursor()
    
    try:
        # Hapus insight lama untuk brand yang sama (opsional)
        delete_query = """
        DELETE FROM ai_recommendations 
        WHERE brand_id = %s AND insight_type = %s 
        AND generated_at < DATE_SUB(NOW(), INTERVAL 1 DAY)
        """
        cursor.execute(delete_query, (brand_id, insight_type))
        
        # Insert insight baru
        insert_query = """
        INSERT INTO ai_recommendations (brand_id, insight_type, recommendation, urgency, generated_at)
        VALUES (%s, %s, %s, %s, NOW())
        """
        cursor.execute(insert_query, (brand_id, insight_type, recommendation, urgency))
        
        ai_conn.commit()
        return True
        
    except Exception as e:
        print(f"Error saving to database: {e}")
        ai_conn.rollback()
        return False
    finally:
        cursor.close()

def save_category_insight(ai_conn, category_id, insight_type, recommendation, urgency):
    """Simpan category insight ke database"""
    cursor = ai_conn.cursor()
    
    try:
        # Hapus insight lama untuk category yang sama
        delete_query = """
        DELETE FROM ai_category_recommendations 
        WHERE category_id = %s AND insight_type = %s 
        AND generated_at < DATE_SUB(NOW(), INTERVAL 1 DAY)
        """
        cursor.execute(delete_query, (category_id, insight_type))
        
        # Insert insight baru
        insert_query = """
        INSERT INTO ai_category_recommendations (category_id, insight_type, recommendation, urgency, generated_at)
        VALUES (%s, %s, %s, %s, NOW())
        """
        cursor.execute(insert_query, (category_id, insight_type, recommendation, urgency))
        
        ai_conn.commit()
        return True
        
    except Exception as e:
        print(f"Error saving category insight: {e}")
        ai_conn.rollback()
        return False
    finally:
        cursor.close()



def main():
    """Fungsi utama - generate insights untuk brand dan category"""
    print("🤖 Starting Enhanced Groq AI Insight Generation (Brand + Category)...")
    
    # Koneksi database
    ikea_conn, ai_conn = get_database_connections()
    if not ikea_conn or not ai_conn:
        print("❌ Failed to connect to databases")
        return
    
    try:
        total_generated = 0
        
        # === PROCESS BRANDS ===
        print("\n📊 Processing Brand Data...")
        brands = read_brand_data(ikea_conn)
        
        if brands:
            print(f"✅ Found {len(brands)} brands to analyze")
            
            for brand in brands:
                print(f"🔍 Analyzing Brand: {brand['brand_name']}")
                
                recommendation, insight_type = generate_groq_insight(brand)
                urgency = calculate_urgency(brand)
                
                if save_to_ai_database(ai_conn, brand['id'], insight_type, recommendation, urgency):
                    total_generated += 1
                    print(f"   ✅ Generated {insight_type} insight (urgency: {urgency})")
                    print(f"   💡 {recommendation[:80]}...")
                else:
                    print(f"   ❌ Failed to save insight for {brand['brand_name']}")
        else:
            print("❌ No brand data found")
        
        # === PROCESS CATEGORIES ===
        print("\n📊 Processing Category Data...")
        categories = read_category_data(ikea_conn)
        
        if categories:
            print(f"✅ Found {len(categories)} categories to analyze")
            
            for category in categories:
                print(f"🔍 Analyzing Category: {category['category_name']}")
                
                recommendation, insight_type = generate_category_insight(category)
                urgency = calculate_category_urgency(category)
                
                if save_category_insight(ai_conn, category['id'], insight_type, recommendation, urgency):
                    total_generated += 1
                    print(f"   ✅ Generated {insight_type} insight (urgency: {urgency})")
                    print(f"   💡 {recommendation[:80]}...")
                else:
                    print(f"   ❌ Failed to save insight for {category['category_name']}")
        else:
            print("❌ No category data found")
        
        print(f"\n🎉 Successfully generated {total_generated} AI insights!")
        print("💡 Insights are now available in brandlist.php and categorylist.php")
        
    except Exception as e:
        print(f"❌ Error in main process: {e}")
    
    finally:
        # Tutup koneksi
        if ikea_conn:
            ikea_conn.close()
        if ai_conn:
            ai_conn.close()
        print("🔒 Database connections closed")

if __name__ == "__main__":
    main()

