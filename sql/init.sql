-- Database initialization for Tour Operations
CREATE DATABASE IF NOT EXISTS tour_ops CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tour_ops;

-- users
CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('ADMIN','HDV') DEFAULT 'HDV',
  full_name VARCHAR(150),
  email VARCHAR(150),
  phone VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- guides (can be same as users but separate table for demo)
CREATE TABLE IF NOT EXISTS guides (
  guide_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  full_name VARCHAR(150),
  phone VARCHAR(50),
  status ENUM('Active','Inactive') DEFAULT 'Active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- tours
CREATE TABLE IF NOT EXISTS tours (
  tour_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  type ENUM('Trong nước','Quốc tế','Theo yêu cầu'),
  price DECIMAL(12,2) DEFAULT 0,
  duration_days INT DEFAULT 1,
  description TEXT,
  status ENUM('Active','Inactive') DEFAULT 'Active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- tour_destinations
CREATE TABLE IF NOT EXISTS tour_destinations (
  destination_id INT AUTO_INCREMENT PRIMARY KEY,
  tour_id INT,
  name VARCHAR(255),
  order_no INT DEFAULT 0,
  estimated_checkin DATETIME,
  estimated_checkout DATETIME,
  location VARCHAR(255),
  FOREIGN KEY (tour_id) REFERENCES tours(tour_id) ON DELETE CASCADE
);

-- bookings
CREATE TABLE IF NOT EXISTS bookings (
  booking_id INT AUTO_INCREMENT PRIMARY KEY,
  tour_id INT,
  booking_code VARCHAR(50) UNIQUE,
  total_amount DECIMAL(12,2) DEFAULT 0,
  status ENUM('Booked','Paid','Cancelled') DEFAULT 'Booked',
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tour_id) REFERENCES tours(tour_id) ON DELETE SET NULL,
  FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE SET NULL
);

-- booking_customers
CREATE TABLE IF NOT EXISTS booking_customers (
  customer_id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT,
  full_name VARCHAR(150),
  phone VARCHAR(50),
  email VARCHAR(150),
  note TEXT,
  FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE
);

-- tour_schedule
CREATE TABLE IF NOT EXISTS tour_schedule (
  schedule_id INT AUTO_INCREMENT PRIMARY KEY,
  tour_id INT,
  guide_id INT,
  start_date DATE,
  end_date DATE,
  vehicle VARCHAR(150),
  hotel VARCHAR(255),
  status ENUM('Chưa khởi hành','Đang chạy','Hoàn thành') DEFAULT 'Chưa khởi hành',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tour_id) REFERENCES tours(tour_id) ON DELETE SET NULL,
  FOREIGN KEY (guide_id) REFERENCES guides(guide_id) ON DELETE SET NULL
);

-- tour_checkpoints
CREATE TABLE IF NOT EXISTS tour_checkpoints (
  checkpoint_id INT AUTO_INCREMENT PRIMARY KEY,
  schedule_id INT,
  destination_id INT,
  actual_checkin DATETIME,
  actual_checkout DATETIME,
  checkin_location VARCHAR(255),
  checkout_location VARCHAR(255),
  note TEXT,
  status ENUM('Chưa đến','Đã check-in','Đã check-out') DEFAULT 'Chưa đến',
  FOREIGN KEY (schedule_id) REFERENCES tour_schedule(schedule_id) ON DELETE CASCADE,
  FOREIGN KEY (destination_id) REFERENCES tour_destinations(destination_id) ON DELETE SET NULL
);

-- departures - completed tours record
CREATE TABLE IF NOT EXISTS departures (
  departure_id INT AUTO_INCREMENT PRIMARY KEY,
  tour_id INT,
  guide_id INT,
  actual_start DATE,
  actual_end DATE,
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tour_id) REFERENCES tours(tour_id) ON DELETE SET NULL,
  FOREIGN KEY (guide_id) REFERENCES guides(guide_id) ON DELETE SET NULL
);

-- expenses
CREATE TABLE IF NOT EXISTS expenses (
  expense_id INT AUTO_INCREMENT PRIMARY KEY,
  tour_id INT,
  type ENUM('Xe','Khách sạn','Ăn uống','Dịch vụ','Khác') DEFAULT 'Khác',
  amount DECIMAL(12,2) DEFAULT 0,
  date DATE,
  note TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tour_id) REFERENCES tours(tour_id) ON DELETE SET NULL
);

-- seed users (plaintext demo passwords)
INSERT INTO users (username, password, role, full_name, email)
VALUES ('admin','password','ADMIN','Admin User','admin@example.com'),
       ('guide1','password','HDV','Guide One','guide1@example.com');

-- seed guide mapping
INSERT INTO guides (user_id, full_name, phone) VALUES (2, 'Guide One', '0123456789');

-- seed sample tour + destinations
INSERT INTO tours (name, type, price, duration_days, description, status)
VALUES ('Hà Nội - Hạ Long 3N2Đ', 'Trong nước', 3000000, 3, 'Tour ngắn trong nước', 'Active');

INSERT INTO tour_destinations (tour_id, name, order_no, estimated_checkin, estimated_checkout, location)
VALUES (1, 'Hà Nội', 1, '2025-12-01 08:00:00', '2025-12-01 10:00:00', 'Hà Nội'),
       (1, 'Hạ Long', 2, '2025-12-01 16:00:00', '2025-12-03 10:00:00', 'Hạ Long');

-- seed booking
INSERT INTO bookings (tour_id, booking_code, total_amount, status, created_by)
VALUES (1, 'BKG-0001', 6000000, 'Booked', 1);

INSERT INTO booking_customers (booking_id, full_name, phone, email)
VALUES (1, 'Nguyen Van A', '0987654321', 'a@example.com');

-- seed schedule
INSERT INTO tour_schedule (tour_id, guide_id, start_date, end_date, vehicle, hotel, status)
VALUES (1, 1, '2025-12-01', '2025-12-03', 'Xe 30 chỗ', 'Khách sạn A', 'Chưa khởi hành');
