document.addEventListener("DOMContentLoaded", function () {
    fetch("footer.html") // Ensure the path is correct based on file locations
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer-placeholder").innerHTML = data;
        })
        .catch(error => console.error("Error loading footer:", error));
});