ALTER TABLE schedules
    ADD COLUMN reschedule_requested_date_time DATETIME NULL,
    ADD COLUMN reschedule_status ENUM('nenhum', 'pendente', 'rejeitado') DEFAULT 'nenhum',
    ADD COLUMN cancellation_fee DECIMAL(10,2) DEFAULT 0.00;
