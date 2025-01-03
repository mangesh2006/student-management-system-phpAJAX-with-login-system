function record() {
    const tbody = document.getElementById('tbody');

    fetch("php/record.php")
        .then(response => response.json())
        .then((data) => {
            tbody.innerHTML = '';

            data.forEach(row => {
                tbody.innerHTML += `
                <tr>
                    <td>${row.rollno}</td>
                    <td>${row.name}</td>
                    <td>${row.mobileno}</td>
                    <td>${row.course}</td>
                    <td>${row.semester}</td>
                    <td><button class='btn' onclick="modify(${row.rollno}, '${row.name}', ${row.mobileno}, '${row.course}', '${row.semester}')"><i class="bi bi-pencil-square"></i> Edit</button></td>
                    <td><button class='btn' onclick="del(${row.rollno})"><i class="bi bi-trash"></i> Delete</button></td>
                </tr>`;
            })
        })
        .catch(() => {
            alert("Error while fetching data");
        })


}

record();

function search() {
    const tbody = document.getElementById('tbody');
    const search = document.getElementById('search').value;

    fetch("php/search.php?search=" + search)
        .then(response => response.json())
        .then((data) => {
            tbody.innerHTML = '';

            data.forEach(row => {
                tbody.innerHTML += `
                <tr>
                    <td>${row.rollno}</td>
                    <td>${row.name}</td>
                    <td>${row.mobileno}</td>
                    <td>${row.course}</td>
                    <td>${row.semester}</td>
                    <td><button class='btn' onclick="modify(${row.rollno}, '${row.name}', ${row.mobileno}, '${row.course}', '${row.semester}')"><i class="bi bi-pencil-square"></i> Edit</button></td>
                    <td><button class='btn' onclick="del(${row.rollno})"><i class="bi bi-trash"></i> Delete</button></td>
                </tr>`;
            })
        })
        .catch(() => {
            alert("Error while fetching data");
        })
}

function modify(rollno, name, mobileno, course, semester) {
    document.getElementById('rollno').value = rollno;
    document.getElementById('name').value = name;
    document.getElementById('mobileno').value = mobileno;
    document.getElementById('course').value = course;
    document.getElementById('semester').value = semester;

    document.getElementById('modal').style.display = 'flex';

    document.getElementById("close").addEventListener("click", () => {
        document.getElementById('modal').style.display = 'none';
    });

    window.onclick = function (event) {
        if (event.target == document.getElementById('modal')) {
            document.getElementById('modal').style.display = 'none';
        }
    }
}

function update() {
    const rollno = document.getElementById("rollno").value;
    const name = document.getElementById("name").value;
    const mobileno = document.getElementById("mobileno").value;
    const course = document.getElementById("course").value;
    const semester = document.getElementById("semester").value;

    const formdata = {
        rollno: rollno,
        name: name,
        mobileno: mobileno,
        course: course,
        semester: semester
    }

    const jsondata = JSON.stringify(formdata);

    fetch("php/update.php", {
        method: "PUT",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.update === 'success') {
                document.getElementById('modal').style.display = 'none';
                record();
            } else {
                alert("Error while updating data");
            }
        })
}

function del(rollno) {
    fetch("php/delete.php?rollno=" + rollno, {
        method: "DELETE"
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.delete === 'success') {
                alert("Student deleted successfully");
                record();
            } else {
                alert("Error while deleting student");
            }
        })
}
