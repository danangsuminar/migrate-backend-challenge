USE ShipManagement;

-- 1. Insert Ship data
INSERT INTO Ship (Code, Name, FiscalYear, Status) VALUES
('SHIP01', 'Flying Dutchman', '0112', 1),
('SHIP02', 'Thousand Sunny', '0403', 1),
('SHIP03', 'Black Pearl', '0112', 1),
('SHIP04', 'Nautilus', '0706', 1),
('SHIP05', 'Queen Anne', '0403', 0);

-- 2. Insert User data
INSERT INTO AppUser (Name, Role) VALUES
('John Smith', 'Administrator'),
('Jane Doe', 'Manager'),
('Robert Johnson', 'Operator'),
('Emily Wilson', 'Analyst'),
('Michael Brown', 'Support');

-- 3. Insert UserShipAssignment data
INSERT INTO UserShipAssignment (UserId, ShipCode) VALUES
(1, 'SHIP01'), (1, 'SHIP02'), (1, 'SHIP03'),
(2, 'SHIP01'), (2, 'SHIP04'),
(3, 'SHIP02'), (3, 'SHIP03'),
(4, 'SHIP04'), (4, 'SHIP05'),
(5, 'SHIP01'), (5, 'SHIP05');

-- 4. Insert CrewRank data
INSERT INTO CrewRank (RankName, Description) VALUES
('Master', 'Captain of the ship'),
('Chief Engineer', 'Head of the engineering department'),
('Chief Officer', 'Second in command after the Master'),
('Second Engineer', 'Second in command of the engineering department'),
('Second Officer', 'Third in command after the Chief Officer'),
('Third Engineer', 'Third in command of the engineering department'),
('Third Officer', 'Fourth in command after the Second Officer'),
('Bosun', 'In charge of deck crew and equipment'),
('Able Seaman', 'Experienced deck crew member'),
('Ordinary Seaman', 'Entry-level deck crew member'),
('Oiler', 'Entry-level engine room crew member'),
('Cook', 'In charge of food preparation'),
('Steward', 'In charge of accommodation and service'),
('Cadet', 'Trainee officer');

-- 5. Insert ChartOfAccounts data (Parents & Children)
-- Parent Accounts
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('7000000', 'OPERATING EXPENSES', NULL, 'Parent'),
('8000000', 'CREW EXPENSES', NULL, 'Parent'),
('9000000', 'MAINTENANCE EXPENSES', NULL, 'Parent'),
('6000000', 'VOYAGE EXPENSES', NULL, 'Parent'),
('5000000', 'ADMINISTRATIVE EXPENSES', NULL, 'Parent');

-- Child Accounts for OPERATING EXPENSES
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('7100000', 'AWARD AND GRANT TO INDIVIDUALS', '7000000', 'Parent'),
('7200000', 'SUPPLIES AND MATERIALS', '7000000', 'Parent'),
('7300000', 'EQUIPMENT', '7000000', 'Parent'),
('7400000', 'UTILITIES', '7000000', 'Parent'),
('7500000', 'MISCELLANEOUS OPERATING EXPENSES', '7000000', 'Parent');

-- Child Accounts for AWARD AND GRANT TO INDIVIDUALS
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('7110000', 'BONUSES', '7100000', 'Child'),
('7120000', 'AWARDS', '7100000', 'Child'),
('7130000', 'GRANTS', '7100000', 'Child'),
('7135000', 'SCHOLARSHIPS', '7100000', 'Child'),
('7140000', 'INCENTIVES', '7100000', 'Child');

-- Child Accounts for SUPPLIES AND MATERIALS
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('7210000', 'OFFICE SUPPLIES', '7200000', 'Child'),
('7220000', 'CLEANING SUPPLIES', '7200000', 'Child'),
('7230000', 'SAFETY EQUIPMENT', '7200000', 'Child'),
('7240000', 'FOOD SUPPLIES', '7200000', 'Child'),
('7250000', 'MEDICAL SUPPLIES', '7200000', 'Child');

-- Child Accounts for CREW EXPENSES
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('8100000', 'SALARIES AND WAGES', '8000000', 'Parent'),
('8200000', 'TRAVEL EXPENSES', '8000000', 'Parent'),
('8300000', 'TRAINING', '8000000', 'Parent'),
('8400000', 'MEDICAL EXPENSES', '8000000', 'Parent'),
('8500000', 'CREW WELFARE', '8000000', 'Parent');

-- Child Accounts for SALARIES AND WAGES
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('8110000', 'BASIC SALARY', '8100000', 'Child'),
('8120000', 'OVERTIME', '8100000', 'Child'),
('8130000', 'ALLOWANCES', '8100000', 'Child'),
('8140000', 'BONUSES', '8100000', 'Child'),
('8150000', 'SOCIAL SECURITY', '8100000', 'Child');

-- Child Accounts for MAINTENANCE EXPENSES
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('9100000', 'HULL MAINTENANCE', '9000000', 'Child'),
('9200000', 'ENGINE MAINTENANCE', '9000000', 'Child'),
('9300000', 'DECK EQUIPMENT', '9000000', 'Child'),
('9400000', 'NAVIGATION EQUIPMENT', '9000000', 'Child'),
('9500000', 'SAFETY EQUIPMENT', '9000000', 'Child');

-- Child Accounts for VOYAGE EXPENSES
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('6100000', 'FUEL COSTS', '6000000', 'Child'),
('6200000', 'PORT CHARGES', '6000000', 'Child'),
('6300000', 'CANAL FEES', '6000000', 'Child'),
('6400000', 'CARGO HANDLING', '6000000', 'Child'),
('6500000', 'AGENCY FEES', '6000000', 'Child');

-- Child Accounts for ADMINISTRATIVE EXPENSES
INSERT INTO ChartOfAccounts (AccountNumber, Description, ParentAccountNumber, AccountType) VALUES
('5100000', 'OFFICE RENT', '5000000', 'Child'),
('5200000', 'COMMUNICATION', '5000000', 'Child'),
('5300000', 'INSURANCE', '5000000', 'Child'),
('5400000', 'LEGAL FEES', '5000000', 'Child'),
('5500000', 'ACCOUNTING FEES', '5000000', 'Child');