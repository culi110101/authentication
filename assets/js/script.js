$().ready(function () {
	// $("#register-form").validate({
	// 	onfocusout: false,
	// 	onkeyup: false,
	// 	onclick: false,
	// 	rules: {
	// 		"account_name": {
	// 			required: true,
	// 			maxlength: 15
	// 		},
	// 		"email": {
	// 			required: true,
	// 			email: true
	// 		},
	// 		"username": {
	// 			required: true,
	// 		},
	// 		"phonenumber": {
	// 			required: true,
	// 		},
	// 		"address": {
	// 			required: true,
	// 		},
	// 		"password": {
	// 			required: true,
	// 			validatePassword: true
	// 		},
	// 		"confirmpassword": {
	// 			equalTo: "#register_password"
	// 		}
	// 	}
	// });
	// $.validator.addMethod("validatePassword", function (value, element) {
	// 	return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
	// }, "Hãy nhập password ít nhất 8 ký tự bao gồm chữ hoa, chữ thường và ít nhất một chữ số");
	$('textarea#tinymce').tinymce({
		height: 300,
		menubar: false,
		plugins: [
			'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
			'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
			'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
		],
		toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
	});
});