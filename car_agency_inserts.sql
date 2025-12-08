INSERT INTO etairia VALUES
('E001', 'Toyota', 'Japan', '123456789'),
('E002', 'BMW', 'Germany', '987654321'),
('E003', 'Hyundai', 'South Korea', '456789123'),
('E004', 'Ford', 'USA', '741258963'),
('E005', 'Fiat', 'Italy', '369258147');

INSERT INTO thlefono_etairias VALUES
('2100000001', 'E001'),
('2100000002', 'E002'),
('2100000003', 'E003'),
('2100000004', 'E004'),
('2100000005', 'E005');

INSERT INTO montelo VALUES
('M001', 'Corolla', 'E001'),
('M002', 'Supra', 'E001'),
('M003', 'i30', 'E003'),
('M004', 'Mustang', 'E004'),
('M005', 'X5', 'E002');

INSERT INTO autokinhto VALUES
('VIN00000000000001', 'M001', 'ENG00000000000001', 2021, 'benzini', 1600, 'automato', 15000, 'aspro', 18000.00, 'dia8eshmo'),
('VIN00000000000002', 'M002', 'ENG00000000000002', 2020, 'benzini', 3000, 'me taxhtites', NULL, 'kokkino', 52000.00, 'dia8eshmo'),
('VIN00000000000003', 'M003', 'ENG00000000000003', 2022, 'petreleo', 1800, 'automato', 5000, 'mple', 22000.00, 'dia8eshmo'),
('VIN00000000000004', 'M004', 'ENG00000000000004', 2019, 'benzini', 5000, 'me taxhtites', 20000, 'kokkino', 35000.00, 'dia8eshmo'),
('VIN00000000000005', 'M005', 'ENG00000000000005', 2021, 'hybrid', 2000, 'automato', NULL, 'mauro', 65000.00, 'dia8eshmo');

INSERT INTO pelates VALUES
('111111111', 'Giannis', 'Papadopoulos', 'giannis@example.com', '6900000001', NULL),
('222222222', 'Maria', 'Nikolaou', 'maria@example.com', '6900000002', NULL),
('333333333', 'Kostas', 'Stathis', 'kostas@example.com', '6900000003', NULL),
('444444444', 'Eleni', 'Karagianni', 'eleni@example.com', '6900000004', NULL),
('555555555', 'Dimitris', 'Ioannou', 'dimitris@example.com', '6900000005', NULL);

INSERT INTO upallhloi VALUES
('U001', 'Petros', 'Lazarou', '2101111111', NULL, '2020-04-01', 'poliths'),
('U002', 'Nikos', 'Kara', '2102222222', NULL, '2019-05-10', 'poliths'),
('U003', 'Manos', 'Georgiou', '2103333333', NULL, '2021-01-14', 'mhxanikos'),
('U004', 'Sofia', 'Varela', '2104444444', NULL, '2018-09-23', 'manager'),
('U005', 'Tasos', 'Milios', '2105555555', NULL, '2022-11-30', 'mhxanikos');

INSERT INTO poliseis VALUES
('P000000000000001', '2024-01-10', 18500.00, 'VIN00000000000001', '111111111', 'U001'),
('P000000000000002', '2024-02-15', 53000.00, 'VIN00000000000002', '222222222', 'U002'),
('P000000000000003', '2024-03-22', 22500.00, 'VIN00000000000003', '333333333', 'U001'),
('P000000000000004', '2024-04-01', 36000.00, 'VIN00000000000004', '444444444', 'U002'),
('P000000000000005', '2024-05-05', 66000.00, 'VIN00000000000005', '555555555', 'U001');

INSERT INTO syntirish VALUES
('S000000000000001', '2024-01-20', 'Aλλαγή λαδιών', 'U003', 'ABC-1234', 'oloklhrw8hke'),
('S000000000000002', '2024-02-10', 'Έλεγχος φρένων', 'U005', 'XYZ-5678', 'oloklhrw8hke'),
('S000000000000003', '2024-03-01', 'Αλλαγή μπαταρίας', 'U003', 'KLM-2468', 'oloklhrw8hke'),
('S000000000000004', '2024-03-15', 'Διάγνωση κινητήρα', 'U005', 'RTY-9753', 'oloklhrw8hke'),
('S000000000000005', '2024-04-05', 'Ακύρωση ραντεβού', 'U003', 'OPA-0001', 'akurw8hke');

INSERT INTO login VALUES
('admin', '0000', 'True');