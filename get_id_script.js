$(document).ready(function (){
    $('.view_data').click(function (e){
        e.preventDefault();

        // console.log('hello');

        var res_leave_id = $(this).closest('tr').find('.res_leave_id').text();
        // console.log(res_leave_id);

        $.ajax({
            type: "POST",
            url: "config/process_leave.php",
            data: {
                'click_view_btn': true,
                'res_leave_id': res_leave_id,
            },
            success: function (response) {
                //console.log(response)

                $('.view_user_data').html(response);
                $('#viewusermodal').modal('show');
            }
        });
    });
});




