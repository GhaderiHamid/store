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
    document.querySelectorAll('.add-to-cart-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            var productId = this.getAttribute('data-product-id');
            var limited = parseInt(this.getAttribute('data-limited'), 10);
            var cartQuantity = parseInt(this.getAttribute('data-cart-quantity') || '0', 10);
            var productQuantity = parseInt(this.getAttribute('data-product-quantity') || '0', 10);

            if (cartQuantity >= limited) {
                alert('بیشتر از این تعداد نمی‌توان خرید کرد');
                return;
            }

            else if (productQuantity <= 0) {
                alert('محصول موجود نیست');
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
                    if (data.success) {
                        alert('محصول با موفقیت به سبد خرید اضافه شد.');

                        if (data.cart_count !== undefined) {
                            let cartCountElem = document.getElementById('cart-count');
                            if (cartCountElem) cartCountElem.textContent = data.cart_count;
                        }

                        btn.setAttribute('data-cart-quantity', cartQuantity + 1);

                        if (data.product_quantity !== undefined) {
                            btn.setAttribute('data-product-quantity', data.product_quantity);
                        }
                    } else {
                        // نمایش پیام خطای مناسب
                        switch (data.error) {
                            case 'limited_exceeded':
                                alert( 'شما به حداکثر تعداد مجاز خرید این محصول رسیده‌اید.');
                                break;
                            case 'out_of_stock':
                                alert( 'این محصول در حال حاضر موجود نیست.');
                                break;
                            case 'reserved_by_others':
                                alert( 'این محصول توسط سایر مشتریان رزرو شده است. لطفاً بعداً مجدداً تلاش کنید یا محصول مشابه دیگری انتخاب نمایید.');
                                break;
                            case 'quantity_exceeded':
                                alert( 'تعداد درخواستی بیشتر از موجودی انبار است.');
                                break;
                            case 'product_not_found':
                                alert( 'محصول یافت نشد.');
                                break;
                            default:
                                alert( 'خطا در افزودن به سبد خرید.');
                        }
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
    document.querySelectorAll('.input_cart').forEach(function (input) {
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
    const input = document.getElementById('quantity-' + id);
    const val = parseInt(input.value) || 1;
    const newVal = val + delta;

    // 🟡 خواندن محدودیت از data-limited روی input
    const limitedAttr = input.getAttribute('data-limited');
    const limited = limitedAttr ? parseInt(limitedAttr) : null;

    // 🚫 بررسی محدودیت خرید
    if (!isNaN(limited) && newVal > limited) {
        alert(`حداکثر تعداد قابل خرید برای این محصول ${limited} عدد است.`);
        return;
    }

    const updateUrl = window.location.origin + '/cart/update-cart-quantity';

    if (newVal < 1) {
        alert('تعداد نمی‌تواند کمتر از 1 باشد');
        return;
    }

    fetch(updateUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        },
        body: JSON.stringify({
            product_id: id,
            quantity: newVal
        })
    })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'خطا در سرور');
            }
            return data;
        })
        .then(data => {
            if (data.success) {
                input.value = data.new_quantity;
                input.setAttribute('data-product-quantity', data.product_quantity);

                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                }

                const cartTotal = document.getElementById('cart-total');
                if (cartTotal) {
                    cartTotal.textContent = data.total_price.toLocaleString() + ' تومان';
                }

                const subtotalBox = document.getElementById('subtotal-' + id);
                if (subtotalBox) {
                    subtotalBox.textContent = data.subtotal.toLocaleString();
                }

                const dataInput = document.getElementById('data-input');
                if (dataInput) {
                    try {
                        const json = JSON.parse(dataInput.value);
                        json.subtotal = data.total_price;

                        const product = json.products.find(p => p.product_id === id);
                        if (product) {
                            product.quantity = data.new_quantity;
                        }

                        dataInput.value = JSON.stringify(json);
                    } catch (e) {
                        console.error('خطا در به‌روزرسانی data-input:', e);
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error.message);
            alert(error.message);
            input.value = val;
        });
}
// جمع کل همیشه بعد از هر تغییر تعداد بدون رفرش صفحه نمایش داده می‌شود
document.addEventListener('DOMContentLoaded', function () {
    updateTotal();
});


///////////////////////تایمر سبد خرید///////////////////////
function formatTime(seconds) {
    const m = String(Math.floor(seconds / 60)).padStart(2, '0');
    const s = String(seconds % 60).padStart(2, '0');
    return m + ':' + s;
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.reservation-timer').forEach(function (span) {
        let timeLeft = parseInt(span.getAttribute('data-seconds'), 10);

        const interval = setInterval(() => {
            if (timeLeft <= 0) {
                span.innerText = "منقضی شده";
                span.classList.add('text-danger');
                clearInterval(interval);
                return;
            }
            span.innerText = formatTime(timeLeft--);
        }, 1000);
    });
});
function formatTime(sec) {
    const m = Math.floor(sec / 60);
    const s = sec % 60;
    return `${m}:${s.toString().padStart(2, '0')}`;
}
setInterval(() => {
    const timers = document.querySelectorAll('.reservation-timer');
    let allExpired = timers.length > 0; // فرض می‌کنیم همه منقضی شده‌اند مگر خلافش ثابت شود

    timers.forEach(span => {
        let seconds = parseInt(span.dataset.seconds);
        const productId = span.dataset.productId;

        if (isNaN(seconds)) return;

        if (seconds <= 0) {
            const wrapper = document.querySelector(`[data-product-wrapper="${productId}"]`);
            if (wrapper) {
                wrapper.remove();
            }

            fetch(`/cart/remove-expired/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
                .then(() => {
                    return fetch('/cart/total');
                })
                .then(res => res.json())
                .then(data => {
                    // بروزرسانی جمع کل
                    const cartTotal = document.getElementById('cart-total');
                    if (cartTotal) {
                        cartTotal.textContent = data.total.toLocaleString() + ' تومان';
                    }

                    // بروزرسانی تعداد سبد خرید
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        // درخواست جدید برای دریافت تعداد کل آیتم‌های سبد خرید
                        fetch('/cart/count')
                            .then(response => response.json())
                            .then(countData => {
                                cartCount.textContent = countData.count || 0;
                            });
                    }

                    // بروزرسانی فیلد data-input
                    const dataInput = document.getElementById('data-input');
                    if (dataInput) {
                        try {
                            let json = JSON.parse(dataInput.value);
                            json.subtotal = data.total;
                            json.products = json.products.filter(p => p.product_id !== parseInt(productId));
                            dataInput.value = JSON.stringify(json);
                        } catch (e) {
                            console.error('خطا در بروزرسانی data-input:', e);
                        }
                    }
                })
                .catch(error => {
                    console.error('خطا در حذف آیتم منقضی‌شده:', error);
                });
        } else {
            allExpired = false; // اگر حتی یک تایمر منقضی نشده باشد
            seconds--;
            span.dataset.seconds = seconds;
            span.textContent = formatTime(seconds);
        }
    });

    // بررسی نهایی برای حذف بخش پرداخت و نمایش پیام
    const remainingProducts = document.querySelectorAll('[data-product-wrapper]');
    if (remainingProducts.length === 0 && document.querySelector('.col-sm-12.col-md-4.mt-1')) {
        // حذف بخش جمع کل و فرم پرداخت
        const paymentSection = document.querySelector('.col-sm-12.col-md-4.mt-1');
        if (paymentSection) {
            paymentSection.remove();
        }

        // بروزرسانی تعداد سبد خرید به صفر
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = '0';
        }

        // اگر پیام قبلی وجود ندارد، آن را اضافه کنید
        if (!document.querySelector('.container.custom-container > p.text-white')) {
            const emptyCartMessage = document.createElement('p');
            emptyCartMessage.className = 'text-white';
            emptyCartMessage.textContent = 'سبد خرید شما خالی است!';

            const container = document.querySelector('.container.custom-container');
            if (container) {
                container.appendChild(emptyCartMessage);
            }
        }
    }
}, 1000);