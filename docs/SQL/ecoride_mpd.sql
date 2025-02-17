-- EcoRide MPD

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NULL,
    role ENUM('user', 'employed', 'admin') NOT NULL,
    phone VARCHAR(15) NULL,
    address TEXT NULL,
    city VARCHAR(100) NULL,
    postal_code VARCHAR(10) NULL,
    birth_date DATE NULL,
    photo VARCHAR(255) NULL,
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    consent BOOLEAN DEFAULT FALSE,
    consent_date DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE authentication (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    last_login DATETIME NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    email_verified BOOLEAN DEFAULT FALSE,
    verification_token VARCHAR(255) NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE vehicles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    type VARCHAR(50) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year YEAR NOT NULL,
    color VARCHAR(30) NOT NULL,
    energy_type ENUM('essence', 'diesel', 'électrique', 'hybride', 'autre') NOT NULL,
    plate_number VARCHAR(20) UNIQUE NOT NULL,
    registration_date DATE NOT NULL,
    seats TINYINT UNSIGNED NOT NULL CHECK (seats BETWEEN 2 AND 9),
    mobility_restricted BOOLEAN DEFAULT FALSE,
    smoker_friendly BOOLEAN DEFAULT FALSE,
    pets_allowed BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE trips (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    driver_id INT UNSIGNED NOT NULL,
    vehicle_id INT UNSIGNED NOT NULL,
    departure_city VARCHAR(100) NOT NULL,
    departure_address TEXT NOT NULL,
    departure_date DATETIME NOT NULL,
    arrival_city VARCHAR(100) NOT NULL,
    arrival_address TEXT NOT NULL,
    arrival_date DATETIME NOT NULL,
    available_seats TINYINT UNSIGNED NOT NULL CHECK (available_seats BETWEEN 1 AND 8),
    price DECIMAL(6,2) NOT NULL CHECK (price >= 0),
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    eco_friendly BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (driver_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE reservations (
    passenger_id INT UNSIGNED NOT NULL,
    trip_id INT UNSIGNED NOT NULL,
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    reserved_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (passenger_id, trip_id),
    FOREIGN KEY (passenger_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES trips(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE reports (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reporter_id INT UNSIGNED NOT NULL,
    trip_id INT UNSIGNED NULL,
    reported_user_id INT UNSIGNED NULL,
    reason ENUM('spam', 'harassment', 'dangerous_driving', 'other') NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved', 'rejected') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reporter_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES trips(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE moderation (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    moderator_id INT UNSIGNED NOT NULL,
    report_id INT UNSIGNED NULL,
    trip_id INT UNSIGNED NULL,
    moderation_type ENUM('trip', 'rating', 'report', 'other') NOT NULL CHECK (moderation_type IN ('trip', 'rating', 'report', 'other')),
    action ENUM('approved', 'rejected', 'pending') DEFAULT 'pending',
    reason TEXT NOT NULL,
    moderated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (moderator_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES trips(id) ON DELETE CASCADE,
    FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    first_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NULL,
    email VARCHAR(255) NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    resolved_at DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE SET NULL
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE invitations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED UNIQUE NOT NULL,
    token VARCHAR(255) UNIQUE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




-- NoSQL Collections:
-- Credits (Managed in NoSQL)
-- Ratings (Managed in NoSQL)