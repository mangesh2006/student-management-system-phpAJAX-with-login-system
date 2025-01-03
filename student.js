document.getElementById("dropdown-menu").addEventListener("click", () => {
    const dropdown = document.getElementById("dropdown");
    if (dropdown.style.display === "flex") {
        dropdown.style.opacity = 0;
        setTimeout(() => {
            dropdown.style.display = "none";
        }, 300);
    } else {
        dropdown.style.display = "flex";
        setTimeout(() => {
            dropdown.style.opacity = 1;
        }, 50);
    }
});

document.getElementById("add_btn").addEventListener("click", () => {
    const rollno = document.getElementById("rollno").value;
    const name = document.getElementById("name").value;
    const mobileno = document.getElementById("mobileno").value;
    const course = document.getElementById("course").value;
    const semester = document.getElementById("semester").value;

    if (rollno === '' || name === '' || mobileno === '' || course === '' || semester === '') {
        var error_message = document.getElementById('error_message');
        error_message.innerHTML = 'Please fill all fields';
        error_message.style.display = "block"

        setTimeout(() => {
            error_message.style.display = "none"
            error_message.style.marginBottom = '0px';
            error_message.style.marginTop = '0px';
        }, 3000);
    } else {
        const formdata = {
            rollno: rollno,
            name: name,
            mobileno: mobileno,
            course: course,
            semester: semester
        }

        const jsondata = JSON.stringify(formdata);

        fetch("php/add.php", {
            method: "POST",
            body: jsondata,
            headers: {
                'Content-type': 'application/json'
            }
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.add === 'success') {
                    var success_message = document.getElementById('success_message');
                    success_message.innerHTML = 'Student added successfully';
                    success_message.style.display = "block"
                    document.getElementById("rollno").value = '';
                    document.getElementById("name").value = '';
                    document.getElementById("mobileno").value = '';
                    document.getElementById("course").value = '';
                    document.getElementById("semester").value = '';

                    setTimeout(() => {
                        success_message.style.display = "none"
                        success_message.style.marginBottom = '0px';
                        success_message.style.marginTop = '0px';
                    }, 3000);
                } else if (data.add === 'exist') {
                    var error_message = document.getElementById('error_message');
                    error_message.innerHTML = 'Roll no. already exist';
                    error_message.style.display = "block"
                    error_message.style.marginBottom = '20px';

                    setTimeout(() => {
                        error_message.style.display = "none"
                        error_message.style.marginBottom = '0px';
                        error_message.style.marginTop = '0px';
                    }, 3000);
                } else {
                    var error_message = document.getElementById('error_message');
                    error_message.innerHTML = "Can't add student";
                    error_message.style.display = "block"

                    setTimeout(() => {
                        error_message.style.display = "none"
                        error_message.style.marginBottom = '0px';
                        error_message.style.marginTop = '0px';
                    }, 3000);
                }
            })
    }
});
