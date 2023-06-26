$(document).ready(function () {
    $('.edit-button').click(function () {
        var row = $(this).closest('tr');
        row.find('.details').hide();
        row.find('.edit-input').show();
        $(this).hide();
        row.find('.save-button').show();
    });

    let ary = Array.from(document.getElementsByClassName('save-button'))
    console.log(ary)
    ary.forEach((element) => {
        element.addEventListener("click",() => {
            var row = $(this).closest('tr');
            var id = element.parentElement.parentElement.children[1].innerText
            var username = element.parentElement.parentElement.children[2].children[0].children[1].value
            var pass = element.parentElement.parentElement.children[3].children[0].children[1].value
            var dept = element.parentElement.parentElement.children[4].children[0].children[1].value

            console.log(id,username,pass,dept)
            

            // Update the faculty details by submitting the form
            $.post('update_faculty.php', {
                id:id,
                username: username,
                pass: pass,
                dept: dept
            }, function (response) {
                if (response === 'success') {
                    row.find('.details').eq(0).text(id)
                    row.find('.details').eq(1).text(username);
                    row.find('.details').eq(2).text(pass);
                    row.find('.details').eq(3).text(dept);
                    window.location.href = 'faculty.php';
                    alert('Faculty Details Updated Successfully !');
                } else {
                    alert('Failed to update faculty details');
                }
            });
        });

    })
})

$(document).ready(function () {
    $('.edit-button-student').click(function () {
        var row = $(this).closest('tr');
        row.find('.std-details').hide();
        row.find('.std-edit-input').show();
        $(this).hide();
        row.find('.std-save-button').show();
    });

    let ary2 = Array.from(document.getElementsByClassName('std-save-button'))
    console.log(ary2)
    ary2.forEach((element) => {
        element.addEventListener("click",() => {
            var row = $(this).closest('tr');
            var id = element.parentElement.parentElement.children[1].innerText
            var username = element.parentElement.parentElement.children[2].children[0].children[1].value
            var pass = element.parentElement.parentElement.children[3].children[0].children[1].value
            var year = element.parentElement.parentElement.children[4].children[0].children[1].value

            console.log(id,username,pass,year)
            

            // Update the faculty details by submitting the form
            $.post('update_student.php', {
                id:id,
                username: username,
                pass: pass,
                year: year
            }, function (response) {
                if (response === 'Student details updated successfully') {
                    row.find('.std-details').eq(0).text(id)
                    row.find('.std-details').eq(1).text(username);
                    row.find('.std-details').eq(2).text(pass);
                    row.find('.std-details').eq(3).text(year);
                    window.location.href = 'student.php';
                    alert('Faculty Details Updated Successfully !');
                } else {
                    // window.location.href = 'student.php';
                    alert('Failed to update faculty details');
                }
                console.log(response)
            });
        });

    })
})


$(document).ready(function () {
    let ary3 = Array.from(document.getElementsByClassName('std-delete'))
    ary3.forEach((element) => {
        element.addEventListener("click",() => {
            var id = element.getAttribute('btn_id')
            console.log(id)
            
            // Update the faculty details by submitting the form
            $.post('delete_student.php', {
                id:id
            }, function (response) {
                if (response === 'success') {
                    window.location.href = 'student.php';
                    alert('Student Deleted Successfully !');
                } else {
                    // window.location.href = 'student.php';
                    alert('Failed to delete student details');
                }
                console.log(response)
            });
        });

    })
})

$(document).ready(function () {
    let ary4 = Array.from(document.getElementsByClassName('faculty-delete'))
    ary4.forEach((element) => {
        element.addEventListener("click",() => {
            var id = element.getAttribute('btn_id')
            console.log(id)
            
            // Update the faculty details by submitting the form
            $.post('faculty_delete.php', {
                id:id
            }, function (response) {
                if (response === 'success') {
                    window.location.href = 'faculty.php';
                    alert('Faculty Deleted Successfully !');
                } else {
                    // window.location.href = 'student.php';
                    alert('Failed to delete faculty details');
                }
                console.log(response)
            });
        });

    })
})

$(document).ready(function () {
    let ary5 = Array.from(document.getElementsByClassName('head-delete'))
    ary5.forEach((element) => {
        element.addEventListener("click",() => {
            var id = element.getAttribute('btn_id')
            console.log(id)
            
            // Update the faculty details by submitting the form
            $.post('head_delete.php', {
                id:id
            }, function (response) {
                if (response === 'success') {
                    window.location.href = 'lab_head.php';
                    alert('Lab Head Deleted Successfully !');
                } else {
                    // window.location.href = 'student.php';
                    alert('Failed to delete lab head details');
                }
                console.log(response)
            });
        });

    })
})

$(document).ready(function () {
    $('.edit-head-button').click(function () {
        var row = $(this).closest('tr');
        row.find('.head-details').hide();
        row.find('.edit-head-input').show();
        $(this).hide();
        row.find('.head-save-button').show();
    });

    let ary7 = Array.from(document.getElementsByClassName('head-save-button'))
    console.log(ary7)
    ary7.forEach((element) => {
        element.addEventListener("click",() => {
            var row = $(this).closest('tr');
            var id = element.parentElement.parentElement.children[1].innerText
            var username = element.parentElement.parentElement.children[2].children[0].children[1].value
            var pass = element.parentElement.parentElement.children[3].children[0].children[1].value
            var lab = element.parentElement.parentElement.children[4].children[0].children[1].value

            console.log(id,username,pass,lab)
            

            // Update the faculty details by submitting the form
            $.post('update_lab_head.php', {
                id:id,
                username: username,
                pass: pass,
                lab: lab
            }, function (response) {
                if (response === 'success') {
                    row.find('.head-details').eq(0).text(id)
                    row.find('.head-details').eq(1).text(username);
                    row.find('.head-details').eq(2).text(pass);
                    row.find('.head-details').eq(3).text(lab);
                    window.location.href = 'lab_head.php';
                    alert('Lab Head Details Updated Successfully !');
                } else {
                    alert('Failed to update lab head details');
                }
            });
        });

    })
})