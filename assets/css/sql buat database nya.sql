CREATE TABLE visitor_count (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_count INT NOT NULL,
    today_count INT NOT NULL,
    today_date DATE NOT NULL,
    month_count INT NOT NULL,
    current_month INT NOT NULL
);