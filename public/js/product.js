
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
