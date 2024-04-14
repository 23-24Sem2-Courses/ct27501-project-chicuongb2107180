

		
		$().ready(function() {
			jQuery("#changePassword").validate({
				rules:{

					old_password: {required: true, minlength:6},
					new_password: {required: true, minlength:6},
					confirm_password: {required: true, minlength:6, equalTo: "#new_password" },
				},
				messages:{
					old_password: {
						required: "Bạn chưa nhập vào mật khẩu",
						minlength:"Mật khẩu phải có độ dài ít nhất 6 ký tự"
					},
					new_password: {
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