document.addEventListener("DOMContentLoaded", function () {
    // Function to fetch and display product reviews
    function fetchReviews() {
        // AJAX request to fetch reviews from the server
        fetch("fetch_reviews.php")
            .then(response => response.json())
            .then(data => {
                // Clear the existing table
                document.getElementById("reviewTableBody").innerHTML = "";

                // Populate the table with fetched data
                data.forEach(review => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${review.productId}</td>
                        <td>${review.quality}</td>
                        <td>${review.name}</td>
                        <td>${review.summary}</td>
                        <td>${review.review}</td>
                        <td>${review.reviewDate}</td>
                    `;
                    document.getElementById("reviewTableBody").appendChild(row);
                });
            })
            .catch(error => console.error("Error fetching reviews:", error));
    }

    // Fetch reviews when the page loads
    fetchReviews();
});
