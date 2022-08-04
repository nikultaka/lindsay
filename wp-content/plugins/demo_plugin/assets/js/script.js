jQuery(document).ready(function () {
    
    jQuery('#example').DataTable({ 
        // dom: "Bfrtip",
    });
    jQuery('#videoPaymentDataTable').DataTable();
});

function addVideo() {
    jQuery("#hiddenID").val(''); 
    jQuery("#amount").val('');
    jQuery('#status  option[value=""]').prop("selected", true);
    jQuery("#videoModal").modal('show');
}


function saveVideo() {
    var videoName = jQuery("#videoName").val();
    var status = jQuery('#status').val();
    var amount = jQuery("#amount").val();
    var countError = 0;

    if(videoName == '') {
        jQuery("#videoName").addClass('has-error');
        countError++;
    } else {
        jQuery("#videoName").removeClass('has-error');
    }

    if(amount == '') {
        jQuery("#amount").addClass('has-error');
        countError++;
    } else {
        jQuery("#amount").removeClass('has-error');
    }


    if(status == '') {
        jQuery("#status").addClass('has-error');
        countError++;
    } else {
        jQuery("#status").removeClass('has-error');
    }

    if(countError == 0) {
        jQuery("#loader").addClass('loader');
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: jQuery("#formdata").serialize(),  
            dataType: 'json',    
            success: function (responce) {
                jQuery("#loader").removeClass('loader');
                //var data = JSON.parse(responce);
                if (responce.status == '1') {
                    location.reload();
                } else {
                    Swal.fire(
                        'Error!',
                        responce.msg,
                        'error'
                        )
                }
            },
            error: function (responce) {        
                jQuery("#loader").removeClass('loader');
            }
        });    
    }
    
}

function editVideo(id) {
    jQuery("#loader").addClass('loader');
    jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            id: id,
            action: "DemoController::get_data"
        },   
        success: function (responce) {
            jQuery("#videoModal").modal('show');
            jQuery("#loader").removeClass('loader');
            var data = JSON.parse(responce);
            if (data.status == 1) {
                var video_name = data.data.video_name;
                var amount = data.data.amount;
                var status = data.data.status;
                var id = data.data.id;
                jQuery("#hiddenID").val(id); 
                jQuery("#videoName").val(video_name);
                jQuery("#amount").val(amount);
                jQuery('#status  option[value="'+status+'"]').prop("selected", true);
            } else {       
                Swal.fire(
                    'Error!',
                    data.msg,
                    'error'
                    )
            }
        },
        error: function (responce) {
            jQuery("#loader").removeClass('loader');
        }
    });
    
}

function deleteVideo(id) {   
    Swal.fire({
        title: 'Are you sure?',
        text: "You are sure to delete this record !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {  
        if (result.isConfirmed) {
            jQuery("#loader").addClass('loader');
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    id: id,
                    action: "DemoController::delete_record"
                },      
                dataType: 'json',
                success: function (response) {
                    jQuery("#loader").removeClass('loader');
                    if (response.status == '1') {
                        location.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'error'
                            )
                    }
                }, 
                error: function (responce) {
                    jQuery("#loader").removeClass('loader');
                }
            });
        }
    })
}

