-- Create database
CREATE DATABASE IF NOT EXISTS ShipManagement;
USE ShipManagement;

-- Create Ship table
CREATE TABLE IF NOT EXISTS Ship (
    Code VARCHAR(10) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    FiscalYear VARCHAR(4) NOT NULL, 
    Status BOOLEAN NOT NULL DEFAULT 1
    -- CHECK regex dihapus: Validasi format MMYY ini wajib kamu taruh di Backend .NET
);

-- Create User table
CREATE TABLE IF NOT EXISTS AppUser (
    UserId INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Role VARCHAR(50) NOT NULL
);

-- Create UserShipAssignment table
CREATE TABLE IF NOT EXISTS UserShipAssignment (
    UserId INT NOT NULL,
    ShipCode VARCHAR(10) NOT NULL,
    PRIMARY KEY (UserId, ShipCode),
    FOREIGN KEY (UserId) REFERENCES AppUser(UserId),
    FOREIGN KEY (ShipCode) REFERENCES Ship(Code)
);

-- Create CrewMember table
CREATE TABLE IF NOT EXISTS CrewMember (
    CrewMemberId VARCHAR(20) PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    BirthDate DATE NOT NULL,
    Nationality VARCHAR(50) NOT NULL
);

-- Create CrewRank table
CREATE TABLE IF NOT EXISTS CrewRank (
    RankId INT AUTO_INCREMENT PRIMARY KEY,
    RankName VARCHAR(50) NOT NULL UNIQUE,
    Description VARCHAR(200) NULL
);

-- Create CrewServiceHistory table
CREATE TABLE IF NOT EXISTS CrewServiceHistory (
    ServiceId INT AUTO_INCREMENT PRIMARY KEY,
    CrewMemberId VARCHAR(20) NOT NULL,
    ShipCode VARCHAR(10) NOT NULL,
    RankId INT NOT NULL,
    SignOnDate DATE NOT NULL,
    SignOffDate DATE NULL,
    EndOfContractDate DATE NOT NULL,
    FOREIGN KEY (CrewMemberId) REFERENCES CrewMember(CrewMemberId),
    FOREIGN KEY (ShipCode) REFERENCES Ship(Code),
    FOREIGN KEY (RankId) REFERENCES CrewRank(RankId)
    -- CHECK perbandingan tanggal dihapus: Lakukan validasi SignOffDate >= SignOnDate di C#
);

-- Create ChartOfAccounts table
CREATE TABLE IF NOT EXISTS ChartOfAccounts (
    AccountNumber VARCHAR(20) PRIMARY KEY,
    Description VARCHAR(200) NOT NULL,
    ParentAccountNumber VARCHAR(20) NULL,
    AccountType VARCHAR(10) NOT NULL,
    FOREIGN KEY (ParentAccountNumber) REFERENCES ChartOfAccounts(AccountNumber)
    -- CHECK AccountType ('Parent', 'Child') dihapus: Gunakan Enum di C# untuk menanganinya
);

-- Create BudgetData table
CREATE TABLE IF NOT EXISTS BudgetData (
    BudgetId INT AUTO_INCREMENT PRIMARY KEY,
    ShipCode VARCHAR(10) NOT NULL,
    AccountNumber VARCHAR(20) NOT NULL,
    AccountPeriod DATE NOT NULL, 
    BudgetValue DECIMAL(18, 2) NOT NULL,
    FOREIGN KEY (ShipCode) REFERENCES Ship(Code),
    FOREIGN KEY (AccountNumber) REFERENCES ChartOfAccounts(AccountNumber),
    UNIQUE KEY UQ_Budget_Ship_Account_Period (ShipCode, AccountNumber, AccountPeriod)
    -- CHECK dihapus: Pastikan validasi bahwa BudgetValue >= 0 dan Date adalah awal bulan ditangani di C#
);

-- Create AccountTransaction table
CREATE TABLE IF NOT EXISTS AccountTransaction (
    TransactionId INT AUTO_INCREMENT PRIMARY KEY,
    ShipCode VARCHAR(10) NOT NULL,
    AccountNumber VARCHAR(20) NOT NULL,
    AccountPeriod DATE NOT NULL, 
    ActualValue DECIMAL(18, 2) NOT NULL,
    FOREIGN KEY (ShipCode) REFERENCES Ship(Code),
    FOREIGN KEY (AccountNumber) REFERENCES ChartOfAccounts(AccountNumber)
    -- CHECK dihapus: Sama seperti BudgetData, validasi nilai dan periode bulanan ditaruh di backend
);

-- Create indexes for performance
CREATE INDEX IX_CrewServiceHistory_ShipCode ON CrewServiceHistory(ShipCode);
CREATE INDEX IX_CrewServiceHistory_CrewMemberId ON CrewServiceHistory(CrewMemberId);
CREATE INDEX IX_BudgetData_ShipCode_AccountPeriod ON BudgetData(ShipCode, AccountPeriod);
CREATE INDEX IX_AccountTransaction_ShipCode_AccountPeriod ON AccountTransaction(ShipCode, AccountPeriod);
CREATE INDEX IX_ChartOfAccounts_ParentAccountNumber ON ChartOfAccounts(ParentAccountNumber);