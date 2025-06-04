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
                // پس از هر تغییر، شمارنده را بلافاصله به‌روزرسانی کن
                $.ajax({
                    url: `/product/${productId}/like-count`,
                    method: 'GET',
                    success: function (data) {
                        var el = $('#like-count-' + productId);
                        if (el.length) {
                            el.text(data.likeCount);
                        }
                    }
                });
            },
            error: function () {
                console.error('Failed to toggle like for product ' + productId);
            }
        });
    });

    // حذف interval مربوط به شمارنده لایک
    // ...existing code...
});

///////////////////////////UnLike_product///////////////////////
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".remove-liked-product").forEach(button => {
        button.addEventListener("click", function () {
            let productId = this.getAttribute("data-product-id");
            let url = this.getAttribute("data-url"); // Get the URL from the data attribute

            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ product_id: productId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "unliked") {
                        this.closest(".col-sm-12").remove();
                    }
                })
                .catch(error => console.error("Error:", error));
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

//////////////////////////UnBookmark_product///////////////////////
$(document).ready(function () {
    $('.remove-bookmarked-product').click(function () {
        var button = $(this);
        var productId = button.data('product-id');

        $.ajax({
            url: '/unbookmark',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'unBookmarked') {
                    button.closest('.col-sm-12').remove();
                }
            },
            error: function () {
                console.error('Failed to remove bookmarked product with ID ' + productId);
            }
        });
    });
});

///////////////////////////vote_product///////////////////////
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.stars-container').forEach(container => {
        const productId = container.dataset.productId;
        const stars = container.querySelectorAll('.star');

        // دریافت رأی ثبت‌شده از سرور و تنظیم ستاره‌ها بعد از بارگیری صفحه
        axios.get(`/vote/${productId}`)
            .then(response => {
                const savedVote = response.data.value;
                if (savedVote) {
                    stars.forEach(s => {
                        if (parseInt(s.dataset.star) <= savedVote) {
                            s.innerHTML = 'star'; // ستاره طلایی
                            s.style.color = 'orange';
                        } else {
                            s.innerHTML = 'star_border'; // ستاره خالی
                            s.style.color = '';
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching vote:', error);
            });

        // ثبت رأی جدید هنگام کلیک
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const selectedStar = parseInt(this.dataset.star);

                // تغییر رنگ ستاره‌ها
                stars.forEach(s => {
                    if (parseInt(s.dataset.star) <= selectedStar) {
                        s.innerHTML = 'star'; // ستاره طلایی
                        s.style.color = 'orange';
                    } else {
                        s.innerHTML = 'star_border'; // ستاره خالی
                        s.style.color = '';
                    }
                });

                // ارسال رأی جدید (همیشه POST، سرور باید آپدیت کند)
                axios.post('/vote', {
                    product_id: productId,
                    value: selectedStar
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    // پیام موفقیت‌آمیز بودن آپدیت رأی
                    if (response.data.updated) {
                        alert('رأی شما با موفقیت به‌روزرسانی شد.');
                    } else {
                        alert('رأی شما ثبت شد.');
                    }
                }).catch(error => {
                    console.error('Error saving vote:', error);
                });
            });
        });
    });
});

///////////////////////////////comment_Reaction///////////////////////
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.thumb-up').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            sendReaction(commentId, 'like');
        });
    });

    document.querySelectorAll('.thumb-down').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            sendReaction(commentId, 'dislike');
        });
    });

    function sendReaction(commentId, reaction) {
        fetch('/reaction-comment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ comment_id: commentId, reaction: reaction })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById(`thumb-up-count-${commentId}`).textContent = data.thumb_up_count;
                    document.getElementById(`thumb-down-count-${commentId}`).textContent = data.thumb_down_count;
                } else {
                    alert('خطایی رخ داده است.');
                }
            })
            .catch(error => console.error('Error:', error));
    }
});
/////////////////////////////////basket/////////////////////

// اسکریپت مرتب‌سازی محصولات و افزودن به سبد خرید با AJAX
document.addEventListener('DOMContentLoaded', function () {
    // مرتب‌سازی محصولات
    var sortButton = document.getElementById('sortButton');
    if (sortButton) {
        sortButton.addEventListener('click', function () {
            var sortValue = document.getElementById('sortSelect').value;
            if (sortValue) {
                window.location.href = sortValue;
            }
        });
    }

    // افزودن به سبد خرید با AJAX
    document.querySelectorAll('.add-to-cart-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var productId = this.getAttribute('data-product-id');
            var limited = parseInt(this.getAttribute('data-limited'), 10);
            var cartQuantity = parseInt(this.getAttribute('data-cart-quantity') || '0', 10);

            if (cartQuantity >= limited) {
                alert('بیشتر از این نمی‌توانی خرید کنی');
                return;
            }

            fetch(window.addToCartAjaxUrl || "{{ route('frontend.cart.add.ajax') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    alert('محصول با موفقیت به سبد خرید اضافه شد.');
                    // اگر شمارنده سبد خرید دارید، اینجا مقدارش را آپدیت کنید
                    if(data.cart_count !== undefined){
                        let cartCountElem = document.getElementById('cart-count');
                        if(cartCountElem) cartCountElem.textContent = data.cart_count;
                    }
                    // افزایش مقدار cartQuantity در دکمه
                    btn.setAttribute('data-cart-quantity', cartQuantity + 1);
                } else if (data.error === 'limited_exceeded') {
                    alert('بیشتر از این نمی‌توانی خرید کنی');
                } else {
                    alert('خطا در افزودن به سبد خرید');
                }
            })
            .catch(() => alert('خطا در ارتباط با سرور'));
        });
    });
});

/////////////////////////cart quantity update (from cart page)///////////////////////
function number_format(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function updateTotal() {
    // محاسبه جمع کل با در نظر گرفتن تخفیف هر محصول
    let total = 0;
    document.querySelectorAll('.input_cart').forEach(function(input) {
        let price = parseInt(input.getAttribute('data-price'));
        let discount = parseInt(input.getAttribute('data-discount')) || 0;
        let quantity = parseInt(input.value);
        let final_price = price;
        if (discount > 0) {
            final_price = Math.round(price - (price * discount / 100));
        }
        total += final_price * quantity;
    });
    let totalElem = document.getElementById('cart-total');
    if (totalElem) totalElem.innerText = number_format(total) + ' تومان';
    let subtotalInput = document.getElementById('subtotal-input');
    if (subtotalInput) subtotalInput.value = total;
}

function changeQuantity(id, price, discount, delta) {
    let input = document.getElementById('quantity-' + id);
    let val = parseInt(input.value) || 1;
    let limited = parseInt(input.getAttribute('data-limited')) || 1;
    let newVal = val + delta;

    // بررسی مقدار جدید
    if (newVal < 1) return;
    if (newVal > limited) {
        alert('بیشتر از این نمیتوانید خرید کنید');
        return;
    }

    input.value = newVal; // به‌روزرسانی مقدار ورودی

    // ارسال مقدار جدید با AJAX به سرور
    fetch(window.cartUpdateQuantityUrl || "/cart/update-quantity", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: id,
                quantity: newVal
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateTotal(); // به‌روزرسانی جمع کل
            }
        })
        .catch(() => {
            updateTotal(); // به‌روزرسانی جمع کل در صورت بروز خطا
        });
}

// جمع کل همیشه بعد از هر تغییر تعداد بدون رفرش صفحه نمایش داده می‌شود
document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
});
