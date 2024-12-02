document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("lookup-country").addEventListener("click", () => {
        const country = document.getElementById("country").value;
        fetchData(country, "country");
    });

    document.getElementById("lookup-cities").addEventListener("click", () => {
        const country = document.getElementById("country").value;
        fetchData(country, "cities");
    });

    function fetchData(country, lookupType) {
        const resultDiv = document.getElementById("result");
        
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure it: GET-request for the URL /world.php with appropriate parameters
        xhr.open("GET", `world.php?country=${country}&lookup=${lookupType}`, true);

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
    }
});
