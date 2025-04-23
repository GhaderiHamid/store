// //set the date were counting down to
// var countDownDate=new Date('May 15, 2024 15:37:25').getTime();

// //update the count down every 1 second
// var x=setInterval(function(){
//     //Get today's date and time
//     var now=new Date().getTime();

//     //Find the distance between now and the count down date
//     var distance=countDownDate-now;

//     //Time calculations for days,hours,minutes and seconds
//     var days=Math.floor(distance/(1000*60*60*24));
//     var hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));
//     var minutes=Math.floor((distance%(1000*60*60))/(1000*60));
//     var seconds=Math.floor((distance%(1000*60))/1000);

//     //output the result in a with id="demo"
//     document.getElementById("demo").innerHTML='<span id="day">'+days+'</span>'
//     + '<span id="hours">'+hours+'</span>'
//     + '<span id="minutes">'+minutes+'</span>'
//     + '<span id="seconds">'+seconds+'</span>';

//     //if the count down is over,write some text
//     if(distance<0){
//         clearInterval(x);
//         document.getElementById("demo").innerHTML=" ";
//         document.getElementById("offer-expire-text").innerHTML="به پایان رسیده";
//         document.getElementById("offer-blur").style.filter="blur(2px)";
//     }
    
// },1000);
// $(document).ready(function(){
//     // $(".owl-carousel").owlCarousel({
//     //     rtl:false,
//     //     items:10,
//     //     loop:true,
//     //     margin:10,
//     //     nav:true,
//     //     dots:true,
//     //     autoplay:true,
//     //     autoplayTimeout:5000,
//     //     autoplayHoverPause:true,
//     // });
//     $('.owl-carousel').owlCarousel({
//         startPosition: 0,
//         rtl:true,
//         loop:true,
//         margin:10,
//         items:10,
//         nav:true,
//         dots:true,
//         autoplay:true,
//         pagination: false,
//         autoplayTimeout:5000,
//         autoplayHoverPause:true,
//         responsive:{
//             0:{
//                 items:1
//             },
//             600:{
//                 items:3
//             },
//             1000:{
//                 items:5
//             }
//         }
//     });
//   });
$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    rtl:true,
    items:4,
    loop:true,
    margin:0,
    nav:true,
    slideBy:4,
    center:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            center:false
        },
        1200:{
          items:4,
          nav:true,
         
      }
    }
  });
});


$(document).ready(function () {
    var productId = $('#like-button').data('product-id');

    // بررسی وضعیت لایک در هنگام لود صفحه
    $.ajax({
        url: `/like/status`,
        method: 'POST',
        data: {
            product_id: productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            const favoriteIcon = $('#favorite-icon');
            if (response.liked) {
                favoriteIcon.css('color', 'red');
                favoriteIcon.text('favorite');
            } else {
                favoriteIcon.css('color', 'white');
                favoriteIcon.text('favorite_border');
            }
        },
        error: function() {
            console.error('Failed to fetch like status');
        }
    });

    // کلیک بر روی دکمه لایک
    $('#like-button').click(function () {
        var button = $(this);
        var productId = button.data('product-id');

        $.ajax({
            url: `/like/toggle`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                const favoriteIcon = $('#favorite-icon');
                if (response.status === 'liked') {
                    favoriteIcon.css('color', 'red');
                    favoriteIcon.text('favorite');
                } else if (response.status === 'unliked') {
                    favoriteIcon.css('color', 'white');
                    favoriteIcon.text('favorite_border');
                }
            },
            error: function() {
                console.error('Failed to toggle like');
            }
        });
    });
});
