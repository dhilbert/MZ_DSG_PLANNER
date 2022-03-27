<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CKEditor 5 - Classic editor</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
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
    <h1>Classic editor</h1>

	※ 이미지 / 동영상 업로드 못함.... 

    <form action="fallinlove2.php" method="POST">
        <textarea name="content" id="editor">
		<br><p><strong>작업경로</strong></p><p>/30.DSG/08.로레알_운영/2022/202202/01.SIS/SIS 상세페이지/220222_파워패브릭+PDP/02.design/몰별 베리에이션</p><p>&nbsp;</p><p><strong>롯데온만 선출시(3/21)로 먼저 작업합니다. (적용파일: PF+_pdp_220315_3.jpg)</strong></p><p><strong>CTA버튼 뺀 버전으로 작업</strong></p><p>나머지 몰은 홀딩</p><figure class="table"><table><tbody><tr><td>&nbsp;</td><td>SSG</td><td>AK mall</td><td>Galleria</td><td>Hmall</td><td>LotteOn</td><td>Imall</td><td>kakao</td></tr><tr><td>사이즈</td><td>PC&amp;모바일 : width=1280px</td><td>PC&amp;모바일 : width=1070px</td><td>PC&amp;모바일 : width=1280px</td><td>PC&amp;모바일 : width=800px</td><td>PC&amp;모바일 : width=1140px</td><td>PC&amp;모바일 width="1200"</td><td>PC&amp;모바일 : width=750px</td></tr><tr><td>비고</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>파일크기 3MB미만</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure><p>&nbsp;</p>        </textarea>
        <p><input type="submit" value="Submit"></p>
    </form>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>


<?php
    
	$editor_data = isset($_POST['content']) ? $_POST['content'] : 3;
echo "html 코드:<br>";
	echo $editor_data;
?>