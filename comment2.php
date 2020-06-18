<div class="reply_view">
	<h3>댓글목록</h3>
		<?php
    $sql_comment = "SELECT * FROM `post_comment` WHERE del_flg='0' AND cid='free_post' AND no={$v['no']}"; // ★ 블로그 ID : cid는 blogid와 동일하게 설정한다. cid가 없으면 타게시판/블로그와 no 동일할 경우에 다른 곳의 댓글이 여기서도 댓글이 보이게 된다.

		foreach($conn->query($sql_comment) as $c){
		?>
		<div class="dap_lo">
			<div><b><?php echo $c['nickname'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$c[content]"); ?></div>
			<div class="rep_me dap_to"><?php echo $c['reg_date']; ?></div>
			<div class="rep_me rep_menu">
				<a class="dat_edit_bt" href="#">수정</a>
				<a class="dat_delete_bt" href="#">삭제</a>
			</div>
			<!-- 댓글 수정 폼 dialog -->
			<div class="dat_edit">
				<form method="post" action="rep_modify_ok.php">
					<input type="hidden" name="rno" value="<?php echo $c['cno']; ?>" /><input type="hidden" name="b_no" value="<?php echo $c['no']; ?>">
					<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
					<textarea name="content" class="dap_edit_t"><?php echo $c['content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
			<!-- 댓글 삭제 비밀번호 확인 -->
			<div class='dat_delete'>
				<form action="reply_delete.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $c['cno']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
			 		<p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
				 </form>
			</div>
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
<div class="dap_ins">
			<input type="hidden" name="bno" class="bno" value="<?php echo $c['no']; ?>">
			<input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
			<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
	</div>
</div><!--- 댓글 불러오기 끝 -->
