create database Fleet_Management;
use Fleet_management;
CREATE TABLE Vehicles (
    Vehicle_ID INT AUTO_INCREMENT PRIMARY KEY,
    Make VARCHAR(50) NOT NULL,
    Model VARCHAR(50) NOT NULL,
    Year INT NOT NULL,
    VIN VARCHAR(17) UNIQUE NOT NULL,
    License_Plate_Number VARCHAR(15) NOT NULL,
    Purchase_Date DATE,
    Vehicle_Type VARCHAR(50),
    Current_Mileage INT,
    Status VARCHAR(20)
);
CREATE TABLE Drivers (
    Driver_ID INT AUTO_INCREMENT PRIMARY KEY,
    First_Name VARCHAR(50) NOT NULL,
    Last_Name VARCHAR(50) NOT NULL,
    License_Number VARCHAR(20) NOT NULL,
    Phone_Number VARCHAR(15),
    Email VARCHAR(100),
    Address TEXT,
    Assigned_Vehicle_ID INT,
    FOREIGN KEY (Assigned_Vehicle_ID) REFERENCES Vehicles(Vehicle_ID)
);
CREATE TABLE Maintenance_Logs (
    Maintenance_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vehicle_ID INT,
    Maintenance_Type VARCHAR(50),
    Service_Date DATE,
    Service_Provider VARCHAR(100),
    Cost DECIMAL(10, 2),
    Next_Service_Due DATE,
    Notes TEXT,
    FOREIGN KEY (Vehicle_ID) REFERENCES Vehicles(Vehicle_ID)
);
CREATE TABLE Fuel_Logs (
    Fuel_Log_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vehicle_ID INT,
    Fuel_Date DATE,
    Fuel_Amount DECIMAL(10, 2),
    Fuel_Cost DECIMAL(10, 2),
    Fuel_Station VARCHAR(100),
    FOREIGN KEY (Vehicle_ID) REFERENCES Vehicles(Vehicle_ID)
);
CREATE TABLE Incident_Reports (
    Incident_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vehicle_ID INT,
    Incident_Date DATE,
    Description TEXT,
    Damage_Estimate DECIMAL(10, 2),
    Status VARCHAR(20),
    Reported_By VARCHAR(100),
    Repair_Status VARCHAR(20),
    FOREIGN KEY (Vehicle_ID) REFERENCES Vehicles(Vehicle_ID)
);
CREATE TABLE Fleet_Usage (
    Fleet_Usage_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vehicle_ID INT,
    Driver_ID INT,
    Trip_Date DATE,
    Start_Mileage INT,
    End_Mileage INT,
    Trip_Purpose VARCHAR(100),
    Destination VARCHAR(100),
    Fuel_Consumed DECIMAL(10, 2),
    FOREIGN KEY (Vehicle_ID) REFERENCES Vehicles(Vehicle_ID),
    FOREIGN KEY (Driver_ID) REFERENCES Drivers(Driver_ID)
);
CREATE TABLE Insurance_Details (
    Insurance_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vehicle_ID INT,
    Insurance_Provider VARCHAR(100),
    Policy_Number VARCHAR(50),
    Coverage_Type VARCHAR(50),
    Start_Date DATE,
    End_Date DATE,
    Premium_Amount DECIMAL(10, 2),
    FOREIGN KEY (Vehicle_ID) REFERENCES Vehicles(Vehicle_ID)
);


