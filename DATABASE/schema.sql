CREATE TABLE dashboard_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_revenue DECIMAL(15,2) NOT NULL,
    supplier_count INT NOT NULL,
    products_sold INT NOT NULL,
    budget_spent DECIMAL(15,2) NOT NULL,
    record_date DATE NOT NULL
);

CREATE TABLE financial_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year YEAR NOT NULL,
    month TINYINT NOT NULL,
    revenue DECIMAL(12,2) NOT NULL,
    expense DECIMAL(12,2) NOT NULL
);CREATE TABLE financial_records (

CREATE TABLE product_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    icon_class VARCHAR(50) NOT NULL,
    sold_count INT DEFAULT 0
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    sold_count INT DEFAULT 0,
    growth_rate DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES product_categories(id)
);

CREATE TABLE daily_summary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    summary_date DATE NOT NULL,
    orders INT NOT NULL,
    revenue DECIMAL(12,2) NOT NULL,
    top_product VARCHAR(100) NOT NULL,
    top_city VARCHAR(50) NOT NULL,
    online_percentage DECIMAL(5,2) NOT NULL
);

CREATE TABLE performance_metrics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    metric_name VARCHAR(50) NOT NULL,
    value DECIMAL(5,2) NOT NULL,
    color_code VARCHAR(20) NOT NULL
);

CREATE TABLE customer_satisfaction (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rating DECIMAL(3,1) NOT NULL,
    feedback_score DECIMAL(3,1) NOT NULL,
    product_reviews INT NOT NULL,
    complaints INT NOT NULL,
    purchases INT NOT NULL
);

CREATE TABLE traffic_sources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source_name VARCHAR(50) NOT NULL,
    conversion_rate DECIMAL(5,2) NOT NULL,
    percentage DECIMAL(5,2) NOT NULL,
    color_code VARCHAR(20) NOT NULL
);

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activity_time TIME NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    type_tag VARCHAR(50) NOT NULL,
    color_code VARCHAR(20) NOT NULL
);

CREATE TABLE store_locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    latitude DECIMAL(9,6) NOT NULL,
    longitude DECIMAL(9,6) NOT NULL,
    address TEXT NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    avatar_url VARCHAR(255) NOT NULL,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

