
document.getElementById("searchInput").addEventListener("keyup", function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll("#movieTable tbody tr");

    rows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(searchValue) ? "" : "none";
    });
});

