document.addEventListener("DOMContentLoaded", function () {
    const barcodeInput = document.getElementById("barcode");
    const nameInput = document.getElementById("productName");
    const priceInput = document.getElementById("productPrice");
    const weightInput = document.getElementById("productWeight");
    const quantityInput = document.getElementById("productQuantity");
    const addProductButton = document.getElementById("addProductButton");
    const productTableBody = document.getElementById("productTableBody");
    const subtotalElement = document.getElementById("subtotal");
    const totalWeightElement = document.getElementById("totalWeight");
    const grandTotalElement = document.getElementById("grandTotal");
    const weightUnitLabel = document.getElementById("weightUnitLabel"); // Label for weight unit
    const totalWeightUnit = document.getElementById("totalWeightUnit"); // Label for total weight unit



    // Debounce function to delay fetch requests
    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Fetch product details based on barcode
    function fetchProductDetails() {
        const barcode = barcodeInput.value.trim();

        if (!barcode) {
            // Reset fields if barcode is empty
            nameInput.value = "";
            priceInput.value = "";
            weightInput.value = "";
            quantityInput.value = 1;
            weightUnitLabel.textContent = "gm"; // Reset to default
            return;
        }

        // Fetch product details from the server
        fetch(`get_product.php?barcode=${barcode}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const product = data.product;
                    nameInput.value = product.name;
                    priceInput.value = product.price;
                    weightInput.value = product.weight;
                    weightUnitLabel.textContent = product.weightUnit || "gm"; // Update weight unit
                    currentWeightUnit = product.weightUnit || "gm"; // Update current weight unit
                    quantityInput.value = 1;
                } else {
                    // Allow manual entry if product is not found
                    alert("Product not found. You can manually enter the details.");
                    nameInput.value = "";
                    priceInput.value = "";
                    weightInput.value = "";
                    quantityInput.value = 1;
                    weightUnitLabel.textContent = "gm"; // Reset to default
                    currentWeightUnit = "gm"; // Reset to default
                }
            })
            .catch(error => {
                alert("Error fetching product data. You can manually enter the details.");
                console.error(error);
                // Allow manual entry in case of an error
                nameInput.value = "";
                priceInput.value = "";
                weightInput.value = "";
                quantityInput.value = 1;
                weightUnitLabel.textContent = "gm"; // Reset to default
                currentWeightUnit = "gm"; // Reset to default
            });
    }

    // Attach the debounced fetch function to the barcode input
    barcodeInput?.addEventListener("input", debounce(fetchProductDetails, 500)); // 500ms delay

    // Add Product Button Click Event
    if (addProductButton) {
        addProductButton.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent form submission
            addProduct();
        });
    }

    function addProduct() {
        const barcode = barcodeInput?.value.trim();
        const name = nameInput?.value.trim();
        const price = parseFloat(priceInput?.value);
        const weight = parseFloat(weightInput?.value);
        const quantity = parseInt(quantityInput?.value);

        // Validate inputs
        if (!barcode || !name || isNaN(price) || isNaN(weight) || isNaN(quantity) || quantity < 1) {
            alert("Please fill all fields correctly!");
            return;
        }

        // Adjust weight display based on the unit
        let totalWeight;
        if (currentWeightUnit === "gm") {
            totalWeight = (weight * quantity).toFixed(2) + " gm";
        } else if (currentWeightUnit === "kg") {
            totalWeight = (weight * quantity).toFixed(2) + " kg";
        } else if (currentWeightUnit === "ml") {
            totalWeight = (weight * quantity).toFixed(2) + " ml"; // Handle milliliters
        } else {
            totalWeight = (weight * quantity).toFixed(2) + " " + currentWeightUnit; // Fallback for other units
        }

        const total = (price * quantity).toFixed(2);

        // Create a new row for the product
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${barcode}</td>
            <td>${name}</td>
            <td>₹${price.toFixed(2)}</td>
            <td>${quantity}</td>
            <td>${totalWeight}</td>
            <td>₹${total}</td>
            <td><button class="delete-btn">❌</button></td>
        `;

        // Append the row to the table body
        productTableBody?.appendChild(row);

        // Update totals
        updateTotal();

        // Reset input fields
        barcodeInput.value = "";
        nameInput.value = "";
        priceInput.value = "";
        weightInput.value = "";
        quantityInput.value = 1;
        weightUnitLabel.textContent = "gm"; // Reset to default
        currentWeightUnit = "gm"; // Reset to default

        // Add delete functionality to the row
        row.querySelector(".delete-btn").addEventListener("click", function () {
            row.remove();
            updateTotal();
        });
    }

    function updateTotal() {
        let subtotal = 0;
        let totalWeight = 0;
        let weightUnit = "kg"; // Default to kilograms

        // Calculate totals from the table rows
        document.querySelectorAll("#productTableBody tr").forEach(row => {
            const totalCell = row.children[5]; // Total price cell
            const weightCell = row.children[4]; // Weight cell

            if (totalCell && weightCell) {
                subtotal += parseFloat(totalCell.textContent.replace("₹", ""));
                const weightText = weightCell.textContent;
                if (weightText.includes("gm")) {
                    totalWeight += parseFloat(weightText.replace("gm", "")) / 1000; // Convert grams to kilograms
                    weightUnit = "kg"; // Set unit to kilograms
                } else if (weightText.includes("kg")) {
                    totalWeight += parseFloat(weightText.replace("kg", ""));
                    weightUnit = "kg"; // Set unit to kilograms
                } else if (weightText.includes("ml")) {
                    totalWeight += parseFloat(weightText.replace("ml", "")); // Keep milliliters as-is
                    weightUnit = "ml"; // Set unit to milliliters
                }
            }
        });

        // Update the totals in the UI
        subtotalElement.textContent = subtotal.toFixed(2);
        totalWeightElement.textContent = totalWeight.toFixed(2);
        totalWeightUnit.textContent = weightUnit; // Update weight unit in billing summary
        grandTotalElement.textContent = subtotal.toFixed(2);
    }
});