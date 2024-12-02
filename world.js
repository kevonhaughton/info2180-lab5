document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("lookup").addEventListener("click", () => {
        const country = document.getElementById("country").value;
        const resultDiv = document.getElementById("result");

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure it: GET-request for the URL /world.php?country=country_name
        xhr.open("GET", `world.php?country=${country}`, true);

        // Set up a function to handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Get the response text
                const response = xhr.responseText;

                // Display the response in the result div
                resultDiv.innerHTML = response;
            }
        };

        // Send the request
        xhr.send();
    });
});
