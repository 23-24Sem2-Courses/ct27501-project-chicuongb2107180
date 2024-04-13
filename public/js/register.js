

		
		$().ready(function() {
			jQuery("#signupForm").validate({
				rules:{
					customer_name: "required",
					customer_email: {required: true, email:true},
                    customer_phone: {required: true, minlength:10},
                    customer_address: "required",
					username: {required: true, minlength:5},
					password: {required: true, minlength:6},
					confirm_password: {required: true, minlength:6, equalTo: "#password" },
				},
				messages:{
					customer_name: "Bạn chưa nhập vào họ và tên",
                    customer_email: "Hộp thư điện tử không hợp lệ",
                    customer_phone: {required: "Bạn chưa nhập vào số điện thoại", minlength:"Số điện thoại không hợp lệ"},
                    customer_address: "Bạn chưa nhập vào địa chỉ",
					username: {
						required: "Bạn chưa nhập vào tên đăng nhập",
						minlength:"Tên đăng nhập phải có độ dài ít nhất 5 ký tự"
					},
					password: {
						required: "Bạn chưa nhập vào mật khẩu",
						minlength:"Mật khẩu phải có độ dài ít nhất 6 ký tự"
					},
					confirm_password: {
						required: "Bạn chưa nhập vào mật khẩu",
						minlength:"Mật khẩu phải có độ dài ít nhất 6 ký tự",
						equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập" 
					},
				},
				errorElement: "div",
				errorPlacement: function(error, element){
					error.addClass("invalid-feedback");
					if(element.prop("type")=== "checkbox"){
						error.insertAfter(element.siblings("label"));
					}else{
						error.insertAfter(element);
						}
				},
				highlight: function(element, errorClass, validClass){
					$(element).addClass("is-invalid").removeClass("is-valid");
				},
				unhighlight: function(element, errorClass, validClass){
					$(element).addClass("is-valid").removeClass("is-invalid");
				},
				
			});
		});
		$.validator.setDefaults({
			submitHandler:function(){
				form.submit();
				alert("submintted!!!");
			}
		});