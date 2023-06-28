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
            var quan = element.parentElement.parentElement.children[1].innerText

            console.log(quan)
            

            // Update the faculty details by submitting the form
            $.post('grant.php', {
                quan:quan
            }, function (response) {
                if (response === 'success') {
                    row.find('.details').eq(0).text(quan)
                    window.location.href = 'grant_chemical.php';
                    alert('Faculty Details Updated Successfully !');
                } else {
                    alert('Failed to update faculty details');
                }
            });
        });

    })
})