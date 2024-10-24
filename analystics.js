document.addEventListener('DOMContentLoaded', function () {
  fetch('analystics.php')
    .then(response => response.json())
    .then(data => {
      console.log('Fetched Data:', data); 

     

      const salesLabels = data.salesData.map(entry => entry.month);
      const salesValues = data.salesData.map(entry => entry.sales);
      renderChart('salesChart', 'Sales Data', salesLabels, salesValues, 'line');

   


      const profitLabels = data.profitData.map(entry => entry.month);
      const profitValues = data.profitData.map(entry => entry.profit);
      renderChart('profitChart', 'Profit Data', profitLabels, profitValues, 'bar');

   


      const financialLabels = data.financialData.map(entry => entry.month);
      const financialValues = data.financialData.map(entry => entry.revenue);
      renderChart('financialChart', 'Financial Data', financialLabels, financialValues, 'line');

     


      const operationalLabels = data.operationalData.map(entry => entry.month);
      const operationalValues = data.operationalData.map(entry => entry.production_output);
      renderChart('operationalChart', 'Operational Data', operationalLabels, operationalValues, 'bar');

     


      const yearlyRevenueLabels = data.yearlyRevenueData.map(entry => entry.year);
      const yearlyRevenueValues = data.yearlyRevenueData.map(entry => entry.revenue);
      renderChart('yearlyRevenueChart', 'Yearly Revenue', yearlyRevenueLabels, yearlyRevenueValues, 'bar');

     


      const productSalesLabels = data.productSalesData.map(entry => entry.product_name);
      const productSalesValues = data.productSalesData.map(entry => entry.sales);
      renderChart('productSalesChart', 'Product Sales', productSalesLabels, productSalesValues, 'line');
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
});

function renderChart(canvasId, chartTitle, labels, values, chartType) {
  const ctx = document.getElementById(canvasId).getContext('2d');

  new Chart(ctx, {
    type: chartType,
    data: {
      labels: labels,
      datasets: [{
        label: chartTitle,
        data: values,
        borderColor: chartType === 'line' ? 'rgba(75, 192, 192, 1)' : 'rgba(255, 99, 132, 1)',
        backgroundColor: chartType === 'line' ? 'rgba(75, 192, 192, 0.2)' : 'rgba(255, 99, 132, 0.2)',
        borderWidth: 1,
      }],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}