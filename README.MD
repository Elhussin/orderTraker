# Order Tracking System

## Overview
The **Order Tracking System** is a PHP-based web application designed to manage and monitor orders through various stages:

1. **Submitted to the lab**
2. **Received back from the lab**
3. **Delivered to the customer**

This system is tailored for businesses that require precise tracking of orders, ensuring smooth operations and transparency.

## Features
- **Order Management**: Track and update the status of orders in real-time.
- **Lab Integration**: Monitor orders sent to and received from the lab.
- **Customer Delivery**: Manage deliveries to ensure timely handovers to customers.
- **User-Friendly Interface**: Simplified design for easy navigation and management.

## Technologies Used
- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript (optional for enhancements)

## Installation
1. **Clone the repository:**
   ```bash
   git clone https://github.com/Elhussin/orderTraker.git
   ```
2. **Set up the database:**
   - Import the `order_tracking.sql` file into your MySQL database.
   - Update the database connection details in `config.php`:
     ```php
     <?php
     $host = 'localhost';
     $user = 'your_username';
     $password = 'your_password';
     $database = 'order_tracking';
     ?>
     ```

3. **Run the application:**
   - Place the project in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Open the application in a browser: `http://localhost/orderTraker/`

## Usage
1. **Login**: Access the system with your credentials.
2. **Add Orders**: Enter new orders, specifying details like customer info and order description.
3. **Update Status**: Change the order status to:
   - `Submitted to Lab`
   - `Received from Lab`
   - `Delivered to Customer`
4. **Track Orders**: View all orders and their current statuses in a centralized dashboard.

## Folder Structure
```
orderTraker/
├── index.php          # Main entry point
├── config.php         # Database configuration
├── nav.php            # Navigation menu
├── views/             # HTML templates
├── controllers/       # Business logic
├── models/            # Database interactions
├── assets/            # CSS, JS, and images
└── order_tracking.sql # Database schema
```

## Contributing
1. Fork the repository.
2. Create a new branch for your feature: `git checkout -b feature-name`
3. Commit your changes: `git commit -m 'Add feature description'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request.

## License
This project is licensed under the MIT License. See the `LICENSE` file for more details.

## Contact
For questions or support, please contact:
- **GitHub**: [Elhussin](https://github.com/Elhussin)
