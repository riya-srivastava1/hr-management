function showDrop(self) {
    // console.log(self.value)
    const employeeDropdown = document.getElementById('employeeDropdown');

    if (self.value === 'employee-attendance') {
        employeeDropdown.style.display = 'block';
    } else {
        employeeDropdown.style.display = 'none';
    }
}
