document.addEventListener('DOMContentLoaded', function() {
    const monthSelect = document.getElementById('monthSelect');
    const revenueBox = document.getElementById('revenueBox');
    const expensesBox = document.getElementById('expensesBox');
    const profitBox = document.getElementById('profitBox');

    const financialData = [
        { month: 'January', revenue: 200000, expenses: 150000, profit: 50000 },
        { month: 'February', revenue: 240000, expenses: 180000, profit: 60000 },
        { month: 'March',revenue: 280000, expenses: 205000,profit: 75000),
 { month: 'April',revenue: 320000, expenses:  220000, profit: 100000),
 { month: 'May', revenue: 440000,  expenses: 250000, profit: 190000),
 { month: 'June', revenue: 350000, expenses:  200000, profit: 150000),
 { month:  'July',revenue: 300000, expenses:  170000, profit: 130000),
 { month:  'August',revenue: 270000, expenses:  160000, profit: 110000),
 { month: 'September',revenue: 400000, expenses:  290000, profit: 110000),
        { month: 'October', revenue: 230000, expenses: 110000, profit: 120000 }
    ];

    monthSelect.addEventListener('change', function() {
        const selectedMonth = monthSelect.value;
        const data = financialData.find(d => d.month === selectedMonth);
        updateBoxes(data);
    });

    function updateBoxes(data) {
        revenueBox.textContent = `Revenue: $${data.revenue}`;
        expensesBox.textContent = `Expenses: $${data.expenses}`;
        profitBox.textContent = `Profit: $${data.profit}`;
    }

    // Default initialization for January data
    updateBoxes(financialData[0]);
});
