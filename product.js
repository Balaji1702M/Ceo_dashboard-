document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_data.php')
        .then(response => response.json())
        .then(data => {
            // Sort the data by totalQuantity in descending order
            data.sort((a, b) => b.totalQuantity - a.totalQuantity);

            // Get the table body element
            var tableBody = document.getElementById("tableBody");

            // Populate the table dynamically
            data.forEach(function(product) {
                var row = document.createElement("tr");

                var productIdCell = document.createElement("td");
                productIdCell.textContent = product.id;
                row.appendChild(productIdCell);

                var productNameCell = document.createElement("td");
                productNameCell.textContent = product.productName;
                row.appendChild(productNameCell);

                var quantityCell = document.createElement("td");
                quantityCell.textContent = product.totalQuantity;
                row.appendChild(quantityCell);

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));
});