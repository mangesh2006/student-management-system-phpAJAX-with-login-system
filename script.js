function signup() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const email = document.getElementById('email').value;

    if (username === '' || password === '' || email === '') {
        var error_message = document.getElementById('message');
        error_message.innerHTML = 'Please fill all fields';
        error_message.classList.add('active');
        error_message.style.marginBottom = '20px';

        setTimeout(() => {
            error_message.classList.remove('active');
            error_message.style.marginBottom = '0px';
        }, 3000);
    } else {
        const formdata = {
            'username': username,
            'password': password,
            'email': email
        };

        const jsondata = JSON.stringify(formdata);

        fetch('php/signup.php', {
            method: 'POST',
            body: jsondata,
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.signup === 'success') {
                    var success_message = document.getElementById('success_message');
                    success_message.innerHTML = 'Signup successful';
                    success_message.classList.add('active');
                    success_message.style.marginBottom = '20px';

                    setTimeout(() => {
                        success_message.classList.remove('active');
                        success_message.style.marginBottom = '0px';
                    }, 3000);
                } else {
                    var error_message = document.getElementById('message');
                    error_message.innerHTML = data.message;
                    error_message.classList.add('active');
                    error_message.style.marginBottom = '20px';

                    setTimeout(() => {
                        error_message.classList.remove('active');
                        error_message.style.marginBottom = '0px';
                    }, 3000);
                }
            })
            .catch((error) => {
                var error_message = document.getElementById('message');
                error_message.innerHTML = 'Email already exists';
                error_message.classList.add('active');
                error_message.style.marginBottom = '15px';

                setTimeout(() => {
                    error_message.classList.remove('active');
                    error_message.style.marginBottom = '0px';
                }, 3000);
            });
    }
}

function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('checkbox').checked;

    if (username === '' || password === '') {
        var error_message = document.getElementById('message');
        error_message.innerHTML = 'Please fill all fields';
        error_message.classList.add('active');
        error_message.style.marginBottom = '20px';

        setTimeout(() => {
            error_message.classList.remove('active');
            error_message.style.marginBottom = '0px';
        }, 3000);
    } else {
        const formdata = {
            'username': username,
            'password': password,
            'remember': rememberMe
        };

        const jsondata = JSON.stringify(formdata);

        fetch('php/login.php', {
            method: 'POST',
            body: jsondata,
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.login === 'success') {
                    window.location.href = 'welcome.php';
                } else {
                    var error_message = document.getElementById('message');
                    error_message.innerHTML = 'Invalid Credentials';
                    error_message.style.marginBottom = '20px';
                    error_message.classList.add('active');

                    setTimeout(() => {
                        error_message.classList.remove('active');
                        error_message.style.marginBottom = '0px';
                    }, 3000);
                }
            })
            .catch((error) => {
                var error_message = document.getElementById('message');
                error_message.innerHTML = `Error: ${error.message}`;
                error_message.classList.add('active');
                error_message.style.marginBottom = '15px';

                setTimeout(() => {
                    error_message.classList.remove('active');
                    error_message.style.marginBottom = '0px';
                }, 3000);
            });
    }
}
