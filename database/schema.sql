CREATE DATABASE IF NOT EXISTS instrutor44 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE instrutor44;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('aluno', 'instrutor', 'admin') NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    avatar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE instructors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    detran_doc VARCHAR(255),
    detran_number VARCHAR(100),
    status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'pendente',
    bio TEXT,
    price_per_hour DECIMAL(10,2) DEFAULT 0.00,
    rating DECIMAL(3,2) DEFAULT 0.00,
    total_reviews INT DEFAULT 0,
    location_address VARCHAR(255),
    location_lat DECIMAL(10,8),
    location_lng DECIMAL(11,8),
    vehicle_info TEXT,
    experience_years INT DEFAULT 0,
    plan_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_status (status),
    INDEX idx_rating (rating),
    INDEX idx_location (location_lat, location_lng)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    location_address VARCHAR(255),
    location_lat DECIMAL(10,8),
    location_lng DECIMAL(11,8),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_location (location_lat, location_lng)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    student_id INT NOT NULL,
    date_time DATETIME NOT NULL,
    duration INT DEFAULT 60,
    status ENUM('pendente', 'confirmado', 'cancelado', 'concluido') DEFAULT 'pendente',
    price DECIMAL(10,2) NOT NULL,
    location_address VARCHAR(255),
    notes TEXT,
    reschedule_requested_date_time DATETIME NULL,
    reschedule_status ENUM('nenhum', 'pendente', 'rejeitado') DEFAULT 'nenhum',
    cancellation_fee DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES instructors(id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    INDEX idx_instructor (instructor_id),
    INDEX idx_student (student_id),
    INDEX idx_status (status),
    INDEX idx_date (date_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    instructor_id INT NOT NULL,
    schedule_id INT,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    hygiene_vehicle INT NULL CHECK (hygiene_vehicle >= 1 AND hygiene_vehicle <= 5),
    service_quality INT NULL CHECK (service_quality >= 1 AND service_quality <= 5),
    punctuality INT NULL CHECK (punctuality >= 1 AND punctuality <= 5),
    vehicle_quality INT NULL CHECK (vehicle_quality >= 1 AND vehicle_quality <= 5),
    comment TEXT,
    status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'aprovado',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (instructor_id) REFERENCES instructors(id) ON DELETE CASCADE,
    FOREIGN KEY (schedule_id) REFERENCES schedules(id) ON DELETE SET NULL,
    INDEX idx_instructor (instructor_id),
    INDEX idx_rating (rating),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    duration_days INT NOT NULL,
    max_photos INT DEFAULT 5,
    featured BOOLEAN DEFAULT FALSE,
    priority_listing BOOLEAN DEFAULT FALSE,
    analytics BOOLEAN DEFAULT FALSE,
    support_priority ENUM('basico', 'prioritario', 'vip') DEFAULT 'basico',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE plan_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    plan_id INT NOT NULL,
    status ENUM('ativo', 'cancelado', 'expirado') DEFAULT 'ativo',
    starts_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES instructors(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE,
    INDEX idx_instructor (instructor_id),
    INDEX idx_status (status),
    INDEX idx_expires (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE availability (
    id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    day_of_week TINYINT NOT NULL CHECK (day_of_week >= 0 AND day_of_week <= 6),
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES instructors(id) ON DELETE CASCADE,
    INDEX idx_instructor (instructor_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('info', 'success', 'warning', 'error') DEFAULT 'info',
    is_read BOOLEAN DEFAULT FALSE,
    link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_read (is_read)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE emergency_alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    user_role ENUM('aluno', 'instrutor') NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    user_phone VARCHAR(20),
    lat DECIMAL(10,8),
    lng DECIMAL(11,8),
    status ENUM('aberto', 'encerrado') DEFAULT 'aberto',
    admin_notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE emergency_alert_locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alert_id INT NOT NULL,
    lat DECIMAL(10,8) NOT NULL,
    lng DECIMAL(11,8) NOT NULL,
    accuracy_meters INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (alert_id) REFERENCES emergency_alerts(id) ON DELETE CASCADE,
    INDEX idx_alert (alert_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
