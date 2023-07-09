$(document).on('click', '.status_change', function() {
    var title = $(this).val();
    if(title == 'approved'){
        Swal.fire({
            title: 'Are you Sure ?',
            text: "To Approved This Student ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#btn_status').val(title);
                $(this).closest("form").submit();
            }
        })
    }else{
        Swal.fire({
            title: 'Are you Sure ?',
            text: "To Reject This Student ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'blue',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#btn_status').val(title);
                $(this).closest("form").submit();
            }
        })
    }
});


