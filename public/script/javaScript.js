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
/////////////////////////////////owl-carousel///////////////////////
$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        rtl: true,
        items: 4,
        loop: true,
        margin: 0,
        nav: true,
        slideBy: 4,
        center: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                center: false
            },
            1200: {
                items: 4,
                nav: true,

            }
        }
    });
});

////////////////////////////////like_product///////////////////////////
$(document).ready(function () {
    // برای هر محصول، وضعیت لایک را چک می‌کند
    $('.product').each(function () {
        var productId = $(this).find('.like-button').data('product-id');
        var icon = $('#favorite-icon-' + productId);
        $.ajax({
            url: `/like/status`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.liked) {
                    icon.css('color', 'red');
                  
                } else {
                    icon.css('color', 'white');
                
                }
            },
            error: function () {
                console.error('Failed to fetch like status for product ' + productId);
            }
        });
    });

    // رویداد کلیک بر روی دکمه‌های لایک
    $('.like-button').click(function () {
        var button = $(this);
        var productId = button.data('product-id');
        var icon = $('#favorite-icon-' + productId);

        $.ajax({
            url: `/like/toggle`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'liked') {
                    icon.css('color', 'red');
                  
                } else if (response.status === 'unliked') {
                    icon.css('color', 'white');
                    
                }
            },
            error: function () {
                console.error('Failed to toggle like for product ' + productId);
            }
        });
    });
});

//////////////////////////////filter//////////////////////////////////
$(document).ready(function () {
    $('#sortButton').on('click', function () {
        var selectedUrl = $('#sortSelect').val(); // استفاده از jQuery برای دسترسی به مقدار
        if (selectedUrl) {
            window.location.href = selectedUrl;
        } else {
            alert('لطفاً یک معیار مرتب‌سازی انتخاب کنید.');
        }
    });
});
/////////////////////////addProductInCart/////////////////////////
function increaseQuantity(id) {
    const quantityField = document.getElementById(`quantity-${id}`);
    let quantity = parseInt(quantityField.value);
    quantityField.value = quantity + 1;
}

////////////////////////subProductInCart////////////////////
function decreaseQuantity(id) {
    const quantityField = document.getElementById(`quantity-${id}`);
    let quantity = parseInt(quantityField.value);
    if (quantity > 1) {
        quantityField.value = quantity - 1;
    }
}

/////////////////////////bookmark_product////////////////////
$(document).ready(function () {
    // برای هر محصول، وضعیت بوکمارک را چک می‌کند
    $('.product').each(function () {
        var productId = $(this).find('.bookmark-button').data('product-id');
        var icon = $('#bookmark-icon-' + productId);
        $.ajax({
            url: `/bookmark/status`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.bookmarked) {
                   
                    icon.text('bookmark_check');
                    icon.css('color','#4db90f');
                   

                } else {
                    icon.css('color', 'white');
                    icon.text('bookmark');
                }
            },
            error: function () {
                console.error('Failed to fetch bookmark status for product ' + productId);
            }
        });
    });

    // رویداد کلیک بر روی دکمه‌های بوکمارک
    $('.bookmark-button').click(function () {
        var button = $(this);
        var productId = button.data('product-id');
        var icon = $('#bookmark-icon-' + productId);

        $.ajax({
            url: `/bookmark/toggle`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'bookmarked') {
                
                    icon.text('bookmark_check');
                    icon.css('color', '#4db90f');


                    

                  
                } else if (response.status === 'unBookmarked') {
                    icon.css('color', 'white');
                    icon.text('bookmark');
                    
                }
            },
            error: function () {
                console.error('Failed to toggle bookmark for product ' + productId);
            }
        });
    });
});
