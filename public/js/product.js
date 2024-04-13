
    document.getElementById('quantity').addEventListener('input', function() {
        var quantity = document.getElementById('quantity').value;
        var total = quantity * price;
        document.getElementById('tong_tmp').innerText = total;
    })

    

    var images = document.getElementsByClassName('image-item');
    var showImage = document.getElementsByClassName('show-image')[0];
    for (var i = 0; i < images.length; i++) {
        images[i].addEventListener('click', function() {
            var src = this.getElementsByTagName('img')[0].src;
            showImage.innerHTML = '<img src="' + src + '" style="width:100%">';
        })
    }

    document.getElementsByClassName('btn')[0].addEventListener('click', function() {
        var quantity = document.getElementById('quantity').value;
        var total = quantity * price;
        var tong_tmp = document.getElementById('tong_tmp').innerText;
        var data = {
            product_id: product_id,
            quantity: quantity,
            price: price,
            total: total
        }
        var cart = localStorage.getItem('cart');
        if (cart) {
            cart = JSON.parse(cart);
        } else {
            cart = [];
        }
        cart.push(data);
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Thêm sản phẩm vào giỏ hàng thành công');
    })

    document.getElementsByClassName('btn')[0].addEventListener('click', function() {
        var total = quantity * price;
        var tong_tmp = document.getElementById('tong_tmp').innerText;
        var data = {
            product_id: product_id,
            quantity: quantity,
            price: price,
            total: total
        }
        var cart = localStorage.getItem('cart');
        if (cart) {
            cart = JSON.parse(cart);
        } else {
            cart = [];
        }
        cart.push(data);
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Thêm sản phẩm vào giỏ hàng thành công');
    })

