<?
   session_start();
?>
<meta charset="euc-kr">
<?
   if(!$userid) {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }   
     if($userlevel==9)
{
echo("
	<script>
 window.alert('레벨이 낮아 댓글을 남길 수 없습니다.\\n가입인사 게시판에 글을 남겨 등업하시면 댓글을 쓸 수 있습니다.')
     history.go(-1)
	</script>
	");
	exit;


}
   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

   // 레코드 삽입 명령
   $sql = "insert into news_ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$username', '$usernick', '$ripple_content', '$regist_day')";    
   
   mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
   mysql_close();                // DB 연결 끊기

   echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	";
?>

   
