const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// MySQL Database Connection
const db = mysql.createPool({
    host: 'localhost', // Update with your database host
    user: 'root',      // Update with your database username
    password: '',      // Update with your database password
    database: 'FleetManagementDB', // Update with your database name
});

// Test Database Connection
db.getConnection((err) => {
    if (err) {
        console.error('Error connecting to the database:', err);
    } else {
        console.log('Connected to the MySQL database.');
    }
});

// Routes
app.get('/', (req, res) => {
    res.send('Fleet Management Backend Running!');
});

// Start the Server
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});

app.get('/vehicles', (req, res) => {
    const query = 'SELECT * FROM vehicles';
    db.query(query, (err, results) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.status(200).json(results);
    });
});

app.post('/vehicles', (req, res) => {
    const { vehicle_id, model, driver, status } = req.body;
    const query = 'INSERT INTO vehicles (vehicle_id, model, driver, status) VALUES (?, ?, ?, ?)';
    db.query(query, [vehicle_id, model, driver, status], (err, results) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.status(201).send('Vehicle added successfully');
    });
});

app.put('/vehicles/:id', (req, res) => {
    const { id } = req.params;
    const { status } = req.body;
    const query = 'UPDATE vehicles SET status = ? WHERE vehicle_id = ?';
    db.query(query, [status, id], (err, results) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.send('Vehicle status updated successfully');
    });
});
const apiBaseUrl = 'http://localhost:3000';

// Fetch All Vehicles
async function fetchVehicles() {
    try {
        const response = await fetch(`${apiBaseUrl}/vehicles`);
        const vehicles = await response.json();

        const tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; // Clear existing rows

        vehicles.forEach(vehicle => {
            const row = `
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4">${vehicle.vehicle_id}</td>
                    <td class="py-2 px-4">${vehicle.model}</td>
                    <td class="py-2 px-4">${vehicle.driver}</td>
                    <td class="py-2 px-4 text-${vehicle.status === 'Active' ? 'green' : 'red'}-600">${vehicle.status}</td>
                    <td class="py-2 px-4">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">Details</button>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    } catch (error) {
        console.error('Error fetching vehicles:', error);
    }
}

// Call the function on page load
window.onload = fetchVehicles;
