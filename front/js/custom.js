$('a#catDrop').on('click',function(){
    $('.category_dropdown').slideToggle('fast');
});
$('.tab_menu_wrapper a.bar-icon').on('click',function(){
    $(this).siblings('.tab_menu_box').slideToggle();
});
const CATEGORYBTN = $('a.cat_menu');
CATEGORYBTN.on('click',function(){
    let menuBox = $('.side_category_menu');
    menuBox.addClass('visible');
    menuBox.children('a.close').on('click',function(){
        menuBox.removeClass('visible');
    });
});
const MOBILEMENUBTN = $('a.mobile_menu');
MOBILEMENUBTN.on('click',function(){
    let menuBtn = $('.side_mobile_menu');
    menuBtn.addClass('visible');
    menuBtn.children('a.close').on('click',function(){
        menuBtn.removeClass('visible');
    })
})

// Home banner
$('.banner_wrapper .full_width_banner .owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 10000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

$('.testimonial .owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: false,
    autoplay: false,
    autoplayTimeout: 5000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

$('.product_slide_wrapper .owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

// Product Add Popups
$('.prdPop').on('click',function(poped){
    $(this).toggleClass('added');    
});

// Quantity
$('.product_quick_view').on('click',function(){
    $(this).parents('.quick_action').siblings('.quick_view_product_popup').show();    
});
$('.quick_view_product_popup a.close').on('click',function(){
    $('.quick_view_product_popup').hide();    
});

// Wishlist button
$('.cart_button button.wishlist_btn').on('click',function(){
    $(this).children('i').toggleClass('far').toggleClass('fas');
})





// Plus Minus
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
            // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});


// Product Zoom and Slider
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});
function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}
window.addEventListener('resize', slideImage);
// Product Zoom and Slider End


$('li.mobile_ctgry_menu_links a.mobile_dropdown').on('click',function(){    
    $(this).parents('.drop_bar').siblings('.sub_menu').slideToggle();
});



$(window).scroll(function(){
    if($(window).scrollTop() >= 100){
        $('.scrolltop_btn').fadeIn();    
        
    }    
    else{
        $('.scrolltop_btn').fadeOut();        
    }
});
$('.scrolltop_btn').on('click',function(){
    $(window).scrollTop(0, 1500);
})

$(window).scroll(function(){
    if($(window).scrollTop() >= 141){
        $('header.header .header_bottom').addClass('sticky');
    }
    else{
        $('header.header .header_bottom').removeClass('sticky');
    }
});

