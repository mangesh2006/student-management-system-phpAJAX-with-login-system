function forgot() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const repassword = document.getElementById("repassword").value;

    if (!(password === repassword)) {
        alert("Passwords do not match");
    } else {
        const formdata = {
            user: username,
            password: password
        }

        const jsondata = JSON.stringify(formdata);

        fetch("php/forgot.php", {
            method: "POST",
            body: jsondata,
            headers: {
                'Content-type': 'application/json'
            }
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.reset === 'success') {
                    alert("Password reset successfully");
                    window.location.href = "login.html";
                } else if (data.reset === 'failed') {
                    alert("User not exist");
                }
            })
            .catch(() => {
                alert("Can't reset password");
            })
    }
}
