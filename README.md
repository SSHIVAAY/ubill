# UBill – Smart Billing System for Supermarkets & Malls 🛒

UBill is a smart and efficient billing system designed for malls and supermarkets to make the shopping experience faster and more automated.  
It allows customers to **scan products directly from the shopping cart using a barcode scanner**, add them to a live cart, checkout digitally, and receive an invoice via email.

---

## 🚀 Features

### 🔹 1. Customer Registration  
Customers enter their basic details (Name, Email, Phone).  
This data is later used for sending the digital invoice.

### 🔹 2. Smart Cart with Barcode Scanning  
A barcode scanner is mounted on the shopping cart.  
As the customer scans products, they are:

- Added to the cart instantly  
- Quantity & price automatically calculated  
- Displayed on the screen connected to the cart  
- Stored in the database in real-time  

### 🔹 3. Start Shopping Interface  
After registration, customers enter a clean interface where they can begin scanning and adding products.

### 🔹 4. Real-Time Cart Management  
- Shows list of scanned products  
- Allows updating quantity  
- Calculates total bill dynamically  

### 🔹 5. Checkout System  
A dedicated checkout page shows:

- Total amount  
- Product summary  
- Payment mode selection  
- Final confirmation  

### 🔹 6. Automated Invoice Email  
Once checkout is done:

- PHPMailer sends invoice details to the customer's email  
- Uses SMTP for reliable email delivery  
- Invoice includes all scanned items + total amount  

### 🔹 7. Admin/Product Management (Back-end)  
Features include:

- Add or update products  
- Set price, weight, barcode, quantity  
- Manage database entries  

---

## 🛠️ Tech Stack Used

| Component | Technology |
|----------|------------|
| Frontend | HTML, CSS, JavaScript |
| Backend | PHP |
| Database | MySQL |
| Email Service | PHPMailer (SMTP) |
| Hardware | Barcode Scanner |
| Deployment | XAMPP or Localhost |

---

## 📂 Project Structure


---

## 📝 How to Run the Project Locally

### **1. Install XAMPP**
Download and install from:  
https://www.apachefriends.org/

### **2. Move the project**
Place the **UBill** folder inside:


### **3. Start Apache & MySQL**
Open XAMPP → Start both services.

### **4. Import the database**
1. Open http://localhost/phpmyadmin  
2. Create a database (example: `ubill`)  
3. Import the `.sql` file  

### **5. Open in browser**

## 📝 License  
This project is licensed under the **MIT License**.

---
