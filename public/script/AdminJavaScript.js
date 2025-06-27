////////////////////////////edite_orders///////////////////
document.addEventListener('DOMContentLoaded', function () {
    const noRadio = document.getElementById('no');
    const yesRadio = document.getElementById('yes');
    const returnShipperContainer = document.querySelector('.return-shipper-container');
    const receiveShipperSelect = document.getElementById('receive_shipper');
    const orderForm = document.getElementById('orderForm');

    function toggleReturnShipper() {
        if (noRadio && noRadio.checked) {
            returnShipperContainer.style.display = 'none';
            if (receiveShipperSelect) {
                receiveShipperSelect.value = '';
                receiveShipperSelect.removeAttribute('required');
            }
        } else {
            returnShipperContainer.style.display = 'flex';
            if (receiveShipperSelect) {
                receiveShipperSelect.setAttribute('required', 'required');
            }
        }
    }

    // Add event listeners if radio buttons exist
    if (noRadio && yesRadio) {
        noRadio.addEventListener('change', toggleReturnShipper);
        yesRadio.addEventListener('change', toggleReturnShipper);

        // Initialize on page load
        toggleReturnShipper();
    }

    // Handle form submission
    if (orderForm) {
        orderForm.addEventListener('submit', function () {
            if (noRadio && noRadio.checked && receiveShipperSelect) {
                receiveShipperSelect.disabled = false;
                receiveShipperSelect.value = '';
            }
        });
    }
});

///////////////////////////
