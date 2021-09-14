jQuery(document).ready(function () {



        
    //jQuery("#menu-item-14899").after('<li id="menu-item-15851" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15851"><a href="?page_id=15814">DASHBOARD</a></li>');

    jQuery('#example').DataTable({ 
        dom: "Bfrtip",
    });
    jQuery('#videoPaymentDataTable').DataTable();
    var video = document.getElementsByClassName('linkVid')[0];
    var videoDataID = jQuery(video).attr('data_id');
    //alert(videoDataID);    
    console.log(video);
    var supposedCurrentTime = 0;
    video.addEventListener('timeupdate', function() {
        if (!video.seeking) {  
            supposedCurrentTime = video.currentTime;
        }
    });
    video.addEventListener('seeking', function() {
        //return false;
        var delta = video.currentTime - supposedCurrentTime;
        if (Math.abs(delta) > 0.01) {
            console.log("Seeking is disabled");
            video.currentTime = supposedCurrentTime;
        }
    });    
    video.addEventListener('ended', function() {
        supposedCurrentTime = 0;
        return Swal.fire({
            icon: 'success',
            title: 'Thank you for viewing this video, please take a moment to answer a few questions.',
            showConfirmButton: true,    
        }).then(function () {
            jQuery("#videoID_"+videoDataID).hide();
            jQuery("#quizID_"+videoDataID).show();
        });
    });
});

function addVideo() {
    jQuery("#hiddenID").val(''); 
    jQuery("#videoName").val('');
    jQuery("#amount").val('');
    jQuery('#videoID  option[value=""]').prop("selected", true);
    jQuery('#quizName  option[value=""]').prop("selected", true);
    jQuery('#status  option[value=""]').prop("selected", true);
    jQuery("#videoModal").modal('show');
}

function saveSettings() {
    var client_id = jQuery("#client_id").val();
    var secret_id = jQuery('#secret_id').val();
    var business_id = jQuery('#business_id').val();
    var business_password = jQuery('#business_password').val();
    var business_signature = jQuery("#business_signature").val();
    var amount = jQuery("#amount").val();
    var countError = 0;   

    if(client_id == '') {
        jQuery("#client_id").addClass('has-error');
        countError++;
    } else {
        jQuery("#client_id").removeClass('has-error');
    }

    if(secret_id == '') {
        jQuery("#secret_id").addClass('has-error');
        countError++;
    } else {
        jQuery("#secret_id").removeClass('has-error');
    }

    if(business_id == '') {
        jQuery("#business_id").addClass('has-error');
        countError++;
    } else {
        jQuery("#business_id").removeClass('has-error');
    }

    if(business_password == '') {
        jQuery("#business_password").addClass('has-error');
        countError++;
    } else {
        jQuery("#business_password").removeClass('has-error');
    }


    if(business_signature == '') {
        jQuery("#business_signature").addClass('has-error');
        countError++;
    } else {
        jQuery("#business_signature").removeClass('has-error');
    }

    if(amount == '') {
        jQuery("#amount").addClass('has-error');
        countError++;
    } else {
        jQuery("#amount").removeClass('has-error');
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
                if (responce.status == '1') {
                    Swal.fire(
                        'Add!',
                        'Settings updated successfully',
                        'success',
                        );
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

function saveVideo() {
    var videoName = jQuery("#videoName").val();
    var videoID = jQuery('#videoID').val();
    var quizName = jQuery('#quizName').val();
    var status = jQuery('#status').val();
    var amount = jQuery("#amount").val();
    var countError = 0;

    if(videoName == '') {
        jQuery("#videoName").addClass('has-error');
        countError++;
    } else {
        jQuery("#videoName").removeClass('has-error');
    }

    if(videoID == '') {
        jQuery("#videoID").addClass('has-error');
        countError++;
    } else {
        jQuery("#videoID").removeClass('has-error');
    }

    if(quizName == '') {
        jQuery("#quizName").addClass('has-error');
        countError++;
    } else {
        jQuery("#quizName").removeClass('has-error');
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
            action: "VideoLinkingController::get_data"
        },   
        success: function (responce) {
            jQuery("#videoModal").modal('show');
            jQuery("#loader").removeClass('loader');
            var data = JSON.parse(responce);
            if (data.status == 1) {
                var video_name = data.data.video_name;
                var video_url = data.data.video_url;
                var quizID = data.data.quiz_id;
                var amount = data.data.amount;
                var status = data.data.status;
                var id = data.data.id;
                jQuery("#hiddenID").val(id); 
                jQuery("#videoName").val(video_name);
                jQuery("#amount").val(amount);
                jQuery('#videoID  option[value="'+video_url+'"]').prop("selected", true);
                jQuery('#quizName  option[value="'+quizID+'"]').prop("selected", true);
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
                    action: "VideoLinkingController::delete_record"
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


function doMassPayment() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to do payment of $"+totalAmount+" ?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {  
        if (result.isConfirmed) {
            jQuery("#loader").addClass('loader');
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: "VideoLinkingController::mass_payment",
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
    });
}

function payout(id) {
    document.location.href = '?page=paypal-payout&id='+id;
}      


jQuery('#paypalEmail_btn').on('click', function() {
    var paypalEmail = jQuery('#paypalEmail').val();
    var form = jQuery("#paypalEmailForm");
    console.log(form);
    form.validate({
        rules: {
            paypalEmail: {
                required: true,
                email: true,
            },
        },
        messages: {
            paypalEmail: {
                required: 'Paypal Email is required',
                email: "Enter Valid Email addresss"
            }
        }
    });
    if (form.valid() === true) {
        jQuery.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                'paypalEmail': paypalEmail,
                action: "VideoLinkingController::insert_paypalEmail"
            },
            success: function(responce) {
                var data = JSON.parse(responce);
                if (data.status == 1) {
                    Swal.fire(
                        'Add!',
                        data.msg,
                        'success',
                        );
                }else{
                    Swal.fire(
                        'Error!',
                        data.msg,
                        'error'
                        )
                }
            }
        });
    }
});


function videoCompleted(id) {
    jQuery("#loader").addClass('loader');
    jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: "VideoLinkingController::video_completed",
            id : id,
            nonce: ajax_var.nonce     
        },                   
        dataType: 'json',
        success: function (response) {
            jQuery("#loader").removeClass('loader');
            if (response.status == '1') {
                Swal.fire({       
                    icon: 'success',
                    title: 'Thanks for taking the quiz, would you like to watch another video?',
                    showConfirmButton: true
                }).then(function () {
                    //location.reload();
                    document.location.href= siteurl;
                });             
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


function savePaypalID(subscriptonID) {
    jQuery("#loader").addClass('loader');
    jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: "VideoLinkingController::save_paypal_id",
            id : subscriptonID
        },                   
        dataType: 'json',
        success: function (response) {
            jQuery("#loader").removeClass('loader');
            if (response.status == '1') {
                Swal.fire({       
                    icon: 'success',
                    title: 'You have subscribed successfully',
                    showConfirmButton: true
                }).then(function () {
                    document.location.href=site_url;
                });             
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

function withdraw() {
    //jQuery("#widthdrawMoney").modal('show');
    submitAmount();
}
   
function submitAmount() {
    jQuery("#loader").addClass('loader');
    var amount = jQuery("#amountWidthDraw").val();
    countError = 0;
    if(amount == '' || isNaN(amount) || amount<2) {
        jQuery("#loader").removeClass('loader');
        Swal.fire(
        'Error!',
        'Amount must be greater than $2',
        'error'
        )    
        countError++;
        return false;
    }                      
    if(countError == 0) {
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: "VideoLinkingController::withdraw",
                nonce: ajax_var.nonce
            },                             
            dataType: 'json',
            success: function (response) {
                jQuery("#loader").removeClass('loader');
                if (response.status == '1') {
                    Swal.fire({       
                        icon: 'success',
                        title: 'You requested Withdrwal amount successfully, Within 3-5 days amount will be credited to your paypal account',
                        showConfirmButton: true
                    }).then(function () {
                        document.location.reload();
                    });             
                } else {  
                    Swal.fire(
                        'Error!',
                        response.msg,
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


jQuery(document).ready(function() {
    if(is_video == '1') {
        jQuery("#tab_video").trigger('click');
    } else {
        is_video == '0';
    }
});