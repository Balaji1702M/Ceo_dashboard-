document.addEventListener('DOMContentLoaded', function() {
  fetch('rating.php')
    .then(response => response.json())
    .then(data => {
      const reviewTableBody = document.getElementById('reviewTableBody');
      data.forEach(review => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${productreview.productId}</td>
          <td>${productreview.quality}</td>
          <td>${productreview.name}</td>
          <td>${productreview.summary}</td>
          <td>${productreview.review}</td>
          <td>${productreview.reviewDate}</td>
          `;
        reviewTableBody.appendChild(row);
      });
    })
    .catch(error => {
      console.error('Error fetching Review data:', error);
    });
});