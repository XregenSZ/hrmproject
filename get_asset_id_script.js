$(document).ready(function (){
    $('.view_data_asset').click(function (e){
        e.preventDefault();

        console.log('hello');

        var res_leave_id = $(this).closest('tr').find('.res_leave_id').text();
        // console.log(res_leave_id);

        $.ajax({
            type: "POST",
            url: "config/process_asset_admin.php",
            data: {
                'click_view_btn': true,
                'res_leave_id': res_leave_id,
            },
            success: function (response) {
                //console.log(response)

                $('.view_asset_data').html(response);
                $('#viewusermodal').modal('show');
            }
        });
    });
});

$(document).ready(function (){
    $('.delete_data_asset').click(function (e){
        e.preventDefault();

        console.log('hello');
        var res_leave_id = $(this).closest('tr').find('.res_leave_id').text();
        // console.log(res_leave_id);

        $.ajax({
            type: "POST",
            url: "config/process_asset_admin.php",
            data: {
                'click_delete_btn': true,
                'res_leave_id': res_leave_id,
            },
            success: function (response) {
                //console.log(response)

                $('.view_asset_data').html(response);
                $('#viewusermodal').modal('show');
            }
        });
    });
});
