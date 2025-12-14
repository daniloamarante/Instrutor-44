USE instrutor44;

INSERT INTO plans (name, price, duration_days, max_photos, featured, priority_listing, analytics, support_priority, description) VALUES
('Grátis', 0.00, 365, 3, FALSE, FALSE, FALSE, 'basico', 'Plano básico para começar'),
('Pro', 49.90, 30, 10, TRUE, FALSE, TRUE, 'prioritario', 'Plano profissional com destaque'),
('Premium', 99.90, 30, 20, TRUE, TRUE, TRUE, 'vip', 'Plano completo com máxima visibilidade');

INSERT INTO users (email, password, role, name, phone) VALUES
('admin@instrutor44.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrador', '(11) 99999-9999'),
('joao.silva@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instrutor', 'João Silva', '(11) 98765-4321'),
('maria.santos@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instrutor', 'Maria Santos', '(11) 98765-4322'),
('carlos.oliveira@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instrutor', 'Carlos Oliveira', '(11) 98765-4323'),
('ana.costa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'instrutor', 'Ana Costa', '(11) 98765-4324'),
('pedro.aluno@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aluno', 'Pedro Almeida', '(11) 91234-5678'),
('julia.aluna@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aluno', 'Julia Ferreira', '(11) 91234-5679');

INSERT INTO instructors (user_id, detran_number, status, bio, price_per_hour, rating, total_reviews, location_address, location_lat, location_lng, vehicle_info, experience_years, plan_id) VALUES
(2, 'DETRAN-SP-12345', 'aprovado', 'Instrutor com 15 anos de experiência. Especialista em primeira habilitação e direção defensiva.', 80.00, 4.8, 45, 'Av. Paulista, 1000 - São Paulo, SP', -23.561684, -46.655981, 'Volkswagen Gol 2020 - Câmbio Manual', 15, 2),
(3, 'DETRAN-SP-12346', 'aprovado', 'Instrutora paciente e dedicada. Foco em alunos iniciantes e com dificuldades.', 75.00, 4.9, 67, 'Rua Augusta, 500 - São Paulo, SP', -23.556858, -46.662742, 'Chevrolet Onix 2021 - Câmbio Automático', 10, 3),
(4, 'DETRAN-SP-12347', 'aprovado', 'Especialista em aulas para habilitação categoria B. Metodologia moderna e eficiente.', 70.00, 4.7, 32, 'Av. Faria Lima, 2000 - São Paulo, SP', -23.574404, -46.688054, 'Fiat Argo 2022 - Câmbio Manual', 8, 2),
(5, 'DETRAN-SP-12348', 'pendente', 'Instrutora recém-credenciada pelo DETRAN. Horários flexíveis e atendimento personalizado.', 65.00, 0.00, 0, 'Rua da Consolação, 1500 - São Paulo, SP', -23.553959, -46.660878, 'Hyundai HB20 2023 - Câmbio Automático', 3, 1);

INSERT INTO students (user_id, location_address, location_lat, location_lng) VALUES
(6, 'Rua dos Pinheiros, 800 - São Paulo, SP', -23.561414, -46.690997),
(7, 'Av. Rebouças, 3000 - São Paulo, SP', -23.566389, -46.672153);

INSERT INTO schedules (instructor_id, student_id, date_time, duration, status, price, location_address, notes) VALUES
(1, 1, '2024-12-20 10:00:00', 60, 'confirmado', 80.00, 'Av. Paulista, 1000', 'Primeira aula - revisão básica'),
(1, 1, '2024-12-22 10:00:00', 60, 'pendente', 80.00, 'Av. Paulista, 1000', 'Segunda aula - baliza'),
(2, 2, '2024-12-21 14:00:00', 90, 'confirmado', 112.50, 'Rua Augusta, 500', 'Aula prática - trânsito urbano'),
(3, 1, '2024-12-18 09:00:00', 60, 'concluido', 70.00, 'Av. Faria Lima, 2000', 'Aula concluída com sucesso');

INSERT INTO reviews (student_id, instructor_id, schedule_id, rating, comment, status) VALUES
(1, 1, 4, 5, 'Excelente instrutor! Muito paciente e didático. Recomendo!', 'aprovado'),
(2, 2, 3, 5, 'Melhor instrutora que já tive. Super atenciosa e profissional.', 'aprovado'),
(1, 3, NULL, 4, 'Bom instrutor, mas poderia ser mais pontual.', 'aprovado');

INSERT INTO availability (instructor_id, day_of_week, start_time, end_time) VALUES
(1, 1, '08:00:00', '12:00:00'),
(1, 1, '14:00:00', '18:00:00'),
(1, 2, '08:00:00', '12:00:00'),
(1, 3, '08:00:00', '12:00:00'),
(1, 3, '14:00:00', '18:00:00'),
(1, 4, '08:00:00', '12:00:00'),
(1, 5, '08:00:00', '12:00:00'),
(1, 5, '14:00:00', '18:00:00'),
(2, 1, '09:00:00', '17:00:00'),
(2, 2, '09:00:00', '17:00:00'),
(2, 3, '09:00:00', '17:00:00'),
(2, 4, '09:00:00', '17:00:00'),
(2, 5, '09:00:00', '17:00:00'),
(3, 1, '08:00:00', '18:00:00'),
(3, 2, '08:00:00', '18:00:00'),
(3, 3, '08:00:00', '18:00:00'),
(3, 4, '08:00:00', '18:00:00'),
(3, 5, '08:00:00', '18:00:00'),
(3, 6, '08:00:00', '12:00:00');

INSERT INTO notifications (user_id, title, message, type, link) VALUES
(2, 'Novo agendamento', 'Pedro Almeida solicitou uma aula para 20/12/2024 às 10:00', 'info', '/instrutor/agenda'),
(6, 'Aula confirmada', 'João Silva confirmou sua aula para 20/12/2024 às 10:00', 'success', '/aluno/minhas-aulas');
