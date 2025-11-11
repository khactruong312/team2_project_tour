-- CSDL quản lý tour du lịch (phiên bản sinh viên)
CREATE DATABASE IF NOT EXISTS tour_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tour_management;

CREATE TABLE tour (
  tour_id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  duration_days INT NOT NULL DEFAULT 1,
  type VARCHAR(50) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE departure (
  departure_id INT AUTO_INCREMENT PRIMARY KEY,
  tour_id INT NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  seats_total INT NOT NULL DEFAULT 0,
  seats_booked INT NOT NULL DEFAULT 0,
  adult_price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  child_price DECIMAL(12,2) DEFAULT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'Open',
  notes TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE booking (
  booking_id INT AUTO_INCREMENT PRIMARY KEY,
  departure_id INT NOT NULL,
  booking_code VARCHAR(60) NOT NULL UNIQUE,
  contact_name VARCHAR(150) NOT NULL,
  contact_phone VARCHAR(50),
  booking_type VARCHAR(20) NOT NULL DEFAULT 'Le',
  total_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  deposit_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  payment_status VARCHAR(30) NOT NULL DEFAULT 'Pending',
  status VARCHAR(30) NOT NULL DEFAULT 'Created',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (departure_id) REFERENCES departure(departure_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE passenger (
  passenger_id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL,
  full_name VARCHAR(150) NOT NULL,
  gender VARCHAR(10),
  birth_date DATE,
  passenger_type VARCHAR(20) DEFAULT 'Adult',
  id_document VARCHAR(100),
  special_request TEXT,
  checked_in BOOLEAN NOT NULL DEFAULT FALSE,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES booking(booking_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE staff (
  staff_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  role VARCHAR(50) NOT NULL,
  phone VARCHAR(50),
  email VARCHAR(150),
  note TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE departure_staff (
  departure_staff_id INT AUTO_INCREMENT PRIMARY KEY,
  departure_id INT NOT NULL,
  staff_id INT NOT NULL,
  role_assigned VARCHAR(100),
  assigned_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (departure_id) REFERENCES departure(departure_id) ON DELETE CASCADE,
  FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE CASCADE,
  UNIQUE KEY ux_dep_staff (departure_id, staff_id)
) ENGINE=InnoDB;

CREATE TABLE transaction (
  transaction_id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NULL,
  departure_id INT NULL,
  trans_type VARCHAR(10) NOT NULL,
  amount DECIMAL(12,2) NOT NULL,
  currency VARCHAR(10) NOT NULL DEFAULT 'VND',
  trans_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  method VARCHAR(50),
  note TEXT,
  FOREIGN KEY (booking_id) REFERENCES booking(booking_id) ON DELETE SET NULL,
  FOREIGN KEY (departure_id) REFERENCES departure(departure_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE tour_log (
  log_id INT AUTO_INCREMENT PRIMARY KEY,
  departure_id INT NOT NULL,
  staff_id INT NOT NULL,
  log_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  log_type VARCHAR(50),
  content TEXT,
  image_url VARCHAR(500),
  FOREIGN KEY (departure_id) REFERENCES departure(departure_id) ON DELETE CASCADE,
  FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE INDEX idx_departure_start ON departure(start_date);
CREATE INDEX idx_booking_status ON booking(status, payment_status);
CREATE INDEX idx_transaction_date ON transaction(trans_date);

-- Dữ liệu mẫu
INSERT INTO tour (code, name, description, duration_days, type)
VALUES ('T-001','Hà Nội - Hạ Long 3N2Đ','Tour khám phá vịnh Hạ Long',3,'Trong nước');

INSERT INTO departure (tour_id, start_date, end_date, seats_total, adult_price)
VALUES (1, '2025-12-20', '2025-12-22', 30, 4500000.00);

INSERT INTO staff (full_name, role, phone, email) VALUES
('Nguyễn Văn A','HDV','0901234567','a@example.com'),
('Trần Văn B','Driver','0907654321','b@example.com');

INSERT INTO departure_staff (departure_id, staff_id, role_assigned) VALUES
(1, 1, 'HDV chính'),
(1, 2, 'Lái xe');

INSERT INTO booking (departure_id, booking_code, contact_name, contact_phone, booking_type, total_amount, deposit_amount, payment_status, status)
VALUES (1, 'B-0001','Công ty XYZ','0987654321','Doan', 45000000.00, 10000000.00, 'Deposited', 'Confirmed');

INSERT INTO passenger (booking_id, full_name, gender, birth_date, passenger_type, id_document)
VALUES (1,'Nguyễn Thị C','Female','1990-05-01','Adult','CMND123456'),
       (1,'Lê Văn D','Male','2010-07-10','Child','CMND345678');

INSERT INTO transaction (booking_id, trans_type, amount, method, note)
VALUES (1,'Thu',10000000.00,'BankTransfer','Đặt cọc đoàn B-0001');
