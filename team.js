document.addEventListener('DOMContentLoaded', function() {
  // Fetch and display employee data
  fetch('team.php')
    .then(response => response.json())
    .then(data => {
      const employeeTableBody = document.getElementById('employeeTableBody');
      data.forEach(employee => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${employee.id}</td>
          <td>${employee.name}</td>
          <td>${employee.team}</td>
          <td>${employee.salary}</td>
          <td>${employee.dob}</td>
          <td>${employee.experience}</td>
          <td>${employee.email}</td>
          <td>${employee.phoneno}</td>
          <td>${employee.performance}</td>
        `;
        employeeTableBody.appendChild(row);
      });
    })
    .catch(error => {
      console.error('Error fetching employee data:', error);
    });
});
 