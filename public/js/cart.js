
    document.addEventListener("DOMContentLoaded", function() {
        var quantity = document.querySelectorAll('#quantity');
        quantity.forEach(function(item) {
            item.onchange = function(e) {
                var quantity = e.target.value;
                var price = e.target.parentElement.previousElementSibling.innerText;
                var total = e.target.parentElement.nextElementSibling.querySelector('.total');
                total.innerText = parseInt(price) * quantity;
            }
        });
    });
