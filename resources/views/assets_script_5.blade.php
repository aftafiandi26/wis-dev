<script src="{!! URL::route('assets/js/tinymce') !!}"></script>
<script>
	tinymce.init({
		selector: 'textarea',
		branding: false,
		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor textcolor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code'
		],
		toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
		content_css: [
		    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		    '//www.tinymce.com/css/codepen.min.css'
	    ]
	});
</script>