
    document.addEventListener("DOMContentLoaded", function() {
        var productImages = document.querySelector('#product_images');
        productImages.onchange = function(e) {
            var files = e.target.files;
            var showImages = document.querySelector('.show-images');
            showImages.innerHTML = '';
            for (var i = 0; i < files.length; i++) {
                var img = document.createElement('img');
                img.src = URL.createObjectURL(files[i]);
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.marginRight = '10px';
                showImages.appendChild(img);
            }
        }
    });



$().ready(function() {
			jQuery("#formproduct").validate({
				rules: {
					product_name: "required",
					product_price: {
						required: true,
						number: true
					},
					product_description: "required",
					product_images: {
						extension: "jpg|png|jpeg|gif"
					}
				},
				messages: {
					product_name: "Vui lòng nhập tên sản phẩm",
					product_price: {
						required: "Vui lòng nhập giá sản phẩm",
						number: "Vui lòng nhập số"
					},
					product_description: "Vui lòng nhập mô tả sản phẩm",
					product_images: {
						required: "Vui lòng chọn hình ảnh",
						extension: "Vui lòng chọn file đúng định dạng"
					}
				}
				
			});
		});
		$.validator.setDefaults({
			submitHandler:function(){
				form.submit();
				alert("submintted!!!");
			}
		});

		