 



$(document).ready(function(){

//home page menu
$("#cssmenu").menumaker({
		title: "",
		format: "multitoggle"
	});

//scroll menu
$(window).scroll(function() {
     if ($(this).scrollTop() > 100) 
		{
		  $('.inner').addClass('fx_hd_top');
		  $('.inner').addClass('fx_hd_top').hide().slideDown().show();
		}
		else
		{
		  $('.inner').removeClass('fx_hd_top');
		}
	});

//scroll top

   $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
 
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
});






 