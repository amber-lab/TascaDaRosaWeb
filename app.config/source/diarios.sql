USE tasca;
CREATE TABLE IF NOT EXISTS products(name varchar(50), type varchar(10), cost int(4), price int(4), uni varchar(1));
INSERT INTO products(name, type, cost, price, uni) VALUES
('Caldo Verde', 'sopa', 2, 3, ''),
('Sopa de Grão', 'sopa', 2, 3, ''),
('Creme de Cenoura', 'sopa', 2, 3, ''),
('Sopa de Couve Lombarda', 'sopa', 2, 3, ''),
('Creme de Broculos', 'sopa', 2, 3, ''),
('Sopa de Cebola', 'sopa', 2, 3, ''),
('Canja de Galinha', 'sopa', 2, 3, ''),

('Feijoada à Transmontana', 'carne', 4, 5, ''),
('Favas à Portuguesa', 'carne', 4, 5, ''),
('Arroz de Cabidela', 'carne', 4, 5, ''),
('Alheira Frita com Batata Cozida e Grelos', 'carne', 4, 5, ''),
('Arroz de Pato', 'carne', 4, 5, ''),
('Moelas com Arroz e Batata Frita', 'carne', 4, 5, ''),
('Carne de Porco à Portuguesa', 'carne', 4, 5, ''),

('Arroz de Feijão com Pataniscas de Bacalhau', 'peixe', 4, 5, ''),
('Arroz de Marisco', 'peixe', 4, 5, ''),
('Bacalhau Assado com Batata Cozida', 'peixe', 4, 5, ''),
('Arroz de Lulas', 'peixe', 4, 5, ''),
('Bacalhau com Natas', 'peixe', 4, 5, ''),
('Caldeirada de Peixe e Marisco', 'peixe', 4, 5, ''),
('Filetes de Pescada com Legumes e Batata Cozida', 'peixe', 4, 5, ''),

('Pastel de Nata', 'sobremesa', 1, 2, 1),
('Pudim Flan', 'sobremesa', 1, 2, 1),
('Rabanadas', 'sobremesa', 1, 2, 1),
('Aletria', 'sobremesa', 1, 2, 1),
('Pêras Bêbedas', 'sobremesa', 1, 2, 1),
('Molotof', 'sobremesa', 1, 2, 1),
('Arroz Doce', 'sobremesa', 1, 2, 1);