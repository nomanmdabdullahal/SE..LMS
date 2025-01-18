document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        const firstname = document.getElementById("firstname").value.trim();
        const lastname = document.getElementById("lastname").value.trim();
        const phonenumber = document.getElementById("phonenumber").value.trim();
        const address = document.getElementById("address").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const cpassword = document.getElementById("cpassword").value;

        let errors = [];

        // Validate First Name
        if (!/^[A-Z][a-zA-Z\s.\-]*$/.test(firstname)) {
            errors.push("First name must start with a capital letter and can only include letters, spaces, dots (.), or hyphens (-).");
        }

        
        if (!/^[A-Z][a-zA-Z\s.\-]*$/.test(lastname)) {
            errors.push("Last name must start with a capital letter and can only include letters, spaces, dots (.), or hyphens (-).");
        }

        
        if (!/^\d{11}$/.test(phonenumber)) {
            errors.push("Phone number must be 11 digits.");
        }

        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errors.push("Invalid email format. Email must include '@' and '.'");
        }

        
        if (password.length < 8) {
            errors.push("Password must be at least 8 characters long.");
        }

        
        if (password !== cpassword) {
            errors.push("Passwords do not match.");
        }

    
        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
