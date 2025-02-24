document.addEventListener("DOMContentLoaded", function () {
    fetch("header.html") // Ensure the path is correct based on file locations
        .then(response => response.text())
        .then(data => {
            document.getElementById("header-placeholder").innerHTML = data;
        })
        .catch(error => console.error("Error loading header:", error));
});