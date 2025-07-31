
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
            url: `/products/like/status`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.liked) {
                    icon[0].style.setProperty("color", "red", "important");
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
            url: `/products/like/toggle`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'liked') {
                    icon[0].style.setProperty("color", "red", "important");
                } else if (response.status === 'unliked') {
                    icon[0].style.setProperty("color", "#a7a7a7", "important");
                }
                // پس از هر تغییر، شمارنده را بلافاصله به‌روزرسانی کن
                $.ajax({
                    url: `/products/${productId}/like-count`,
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


/////////////////////////bookmark_product////////////////////
$(document).ready(function () {
    // برای هر محصول، وضعیت بوکمارک را چک می‌کند
    $('.product').each(function () {
        var productId = $(this).find('.bookmark-button').data('product-id');
        var icon = $('#bookmark-icon-' + productId);
        $.ajax({
            url: `/products/bookmark/status`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.bookmarked) {
                   
                    icon.text('bookmark_check');
                    // icon.css('color','#4db90f');
                    icon[0].style.setProperty("color", "#4db90f", "important");
                   

                } else {
                    // icon.css('color', 'white');
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
            url: `/products/bookmark/toggle`,
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'bookmarked') {
                
                    icon.text('bookmark_check');
                    // icon.css('color', '#4db90f');
                    icon[0].style.setProperty("color", "#4db90f", "important");


                    

                  
                } else if (response.status === 'unBookmarked') {
                    icon[0].style.setProperty("color", "#a7a7a7", "important");
                    // icon.css('color', 'white');
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
            url: '/user/unbookmark',
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
        let savedVote = null;

        function fillStars(stars, value) {
            stars.forEach(s => {
                const v = parseInt(s.dataset.star);
                s.textContent = v <= value ? 'star' : 'star_border';

                if (v <= value) {
                    s.style.setProperty('color', 'orange', 'important');
                } else {
                    s.style.removeProperty('color'); // به‌جای مقدار خالی، حذف کامل بهتره
                }
            });
        }

        axios.get(`/user/vote/${productId}`)
            .then(response => {
                savedVote = response.data.value;
                if (savedVote) fillStars(stars, savedVote);
            });

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const selected = parseInt(this.dataset.star);

                axios.post('/user/vote', {
                    product_id: productId,
                    value: selected
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    savedVote = response.data.value;
                    fillStars(stars, savedVote);
                    alert('رأی شما با موفقیت ثبت شد.');
                }).catch(error => {
                    alert('لطفاً ابتدا وارد حساب کاربری شوید.');
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
        fetch('/products/reaction-comment', {
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




