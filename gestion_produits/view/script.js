// Function to validate the form
alert("Script is running!");

function validateForm() {
    var description = document.getElementById('Description').value;
    var quantite = document.getElementById('Quantite').value;
    var prix = document.getElementById('Prix').value;

    // Validate Description (should not be empty)
    if (description.trim() === '') {
        alert('Please enter a description.');
        return false;
    }

    // Validate Quantite (should be a positive integer)
    if (!/^[1-9]\d*$/.test(quantite)) {
        alert('Please enter a valid quantity (a positive integer).');
        return false;
    }

    // Validate Prix (should be a positive number)
    if (!/^[1-9]\d*(\.\d+)?$/.test(prix)) {
        alert('Please enter a valid price (a positive number).');
        return false;
    }

    // If all validations pass, return true to submit the form
    return true;
}
