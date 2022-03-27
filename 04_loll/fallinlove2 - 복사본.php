<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<!-- 클래식 에디터 -->
	<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
	<title>Home</title>
	
	<!-- 넓이 높이 조절 -->
	<style>
	.ck.ck-editor {
    	max-width: 100%;
	}
	.ck-editor__editable {
	    min-height: 300px;
	}
	</style>
</head>
<body>
<form name="frm" role="form" method="get" action="index_proc.php">
    <div id="classic" name='rrrrr'>
        <p>This is some sample content.</p>
    </div>
    <script >
        ClassicEditor
            .create( document.querySelector( '#classic' ))
            .catch( error => {
                console.error( error );
            } );
    </script>


<input  type='submit' class="btn btn-success login-btn" type="submit" value="전송">

</form>


</body>
</html>