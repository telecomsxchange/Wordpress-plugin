/**
 * Created by khaledkhamis on 3/20/18.
 */

    jQuery(document).ready( function(){
        jQuery('.call_btn').on('click', function(e) {
            if(!jQuery(this).hasClass("connect"))
            {
                jQuery(this).parents(".callme-wrapper").find(".call-msg").css("color","#000").html("");
                jQuery(this).parents(".callme-wrapper").find('.callme-slider').slideDown();
                jQuery(this).parents(".callme-wrapper").find(".number-input").focus();
                jQuery(this).addClass("connect");
                return;
            }
            var number = jQuery(this).parents(".callme-wrapper").find(".number-input").val();
            if (number == null || number == "") {
                jQuery(this).parents(".callme-wrapper").find(".call-msg").css("color","#ff6666").html("please type a valid number");
               return false;
            } else {
                jQuery(this).removeClass("connect");
                jQuery(this).parents(".callme-wrapper").find(".call-msg").css("color","#000").html("");
                e.preventDefault();
                var btn=this;
                jQuery.ajax({
                    url : wptcxc_object.ajax_url,
                    type : 'post',
                    data : {
                        action : 'ajax_request_call',
                        nonce : wptcxc_object.nonce,
                        number : number
                    },
                    success : function( response ) {
                        if(response.success==false)
                            jQuery(btn).parents(".callme-wrapper").find(".call-msg").css("color","#FF6666").html(wptcxc_object.error_msg);
                        else
                            jQuery(btn).parents(".callme-wrapper").find(".call-msg").css("color","#66ff66").html(wptcxc_object.call_confirm + "\n"+ wptcxc_object.poweredby);
                        setTimeout(function(){
                            jQuery(btn).parents(".callme-wrapper").find(".input-number").val('');
                            jQuery(btn).parents(".callme-wrapper").find(".callme-slider").slideUp();
                        },3000);
                    },
                    error : function( response ) {
                        console.log(response);
                    }
                });
            }
        });
    });