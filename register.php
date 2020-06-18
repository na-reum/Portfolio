<?php require('lib/top.php'); ?>


    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent">

            <h2>Register</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    	$("form").submit(function(e){
    		e.preventDefault();
        var email = $("input[name='id']");
            if(email.val() == ''){
                alert('이메일을 입력하세요');
                email.focus();
                return false;
            }
    		var userNM = $("input[name='username']");
    		if( userNM.val() =='') {
                alert("성명을 입력하세요");
                userNM.focus();
                return false;
            }
            var nickname = $("input[name='nickname']");
            if( nickname.val() =='') {
                    alert("닉네임을 입력하세요");
                    nickname.focus();
                    return false;
                }
                var birth = $("input[name='birth']");
                  if(birth.val() !='' && !/^[0-9]{6}$/.test(birth.val())){
                  alert("생년월일은 6자리 숫자로 입력해주세요");
                  return false;
                }


    		var tel = $("input[name='tel']");
          if(tel.val() !='' && !/^[0-9]{10,11}$/.test(tel.val())){
    			alert("휴대폰 번호는 숫자만 10~11자리 입력하세요.");
    			return false;
    		} else if(tel.val() !='' && !/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/.test(tel.val())){
    			alert("유효하지 않은 전화번호 입니다.");
    			return false;
    		}

    		var password = $("input[name='password']");
    		var repassword = $("input[name='passwordcheck']");
    		if(password.val() =='') {
                alert("비밀번호를 입력하세요!");
                password.focus();
                return false;
            }
    		if(password.val().search(/\s/) != -1){
    			alert("비밀번호는 공백없이 입력해주세요.");
    			return false;
    		}
    		if(!/^[a-zA-Z0-9!@#$%^&*()?_~]{8,20}$/.test(password.val())){
    			alert("비밀번호는 숫자, 영문, 특수문자(!@$%^&*?_~ 만 허용) 조합으로 8~20자리를 사용해야 합니다.");
    			return false;
    		}
    		// 영문, 숫자, 특수문자 2종 이상 혼용
    		var chk=0;
    		if(password.val().search(/[0-9]/g) != -1 ){ chk ++;}
    		if(password.val().search(/[a-z]/ig)  != -1 ) { chk ++;}
    		if(password.val().search(/[!@#$%^&*()?_~]/g) != -1){ chk ++;}
    		if(chk < 2){
    			alert("비밀번호는 숫자, 영문, 특수문자를 두가지이상 혼용하여야 합니다.");
    			return false;
    		}
    		// email이 아닌 userID 인 경우에는 체크하면 유용. email은 특수 허용문자에서 걸러진다.
    		/*
    		if(password.val().search(userID.val())>-1){
    			alert("userID가 포함된 비밀번호는 사용할 수 없습니다.");
    			return false;
    		}
    		*/
    		if(repassword.val() =='') {
                alert("비밀번호를 다시 한번 더 입력하세요!");
                repassword.focus();
                return false;
            }
            if(password.val()!== repassword.val()){
                alert('입력한 두 개의 비밀번호가 일치하지 않습니다');
                return false;
            }
            $.ajax({

                url: '_register2.php',
                type: 'POST',
                data: {
                  id:$("input[name='id']").val(),
                  username:$("input[name='username']").val(),
                  nickname:$("input[name='nickname']").val(),
                  password:$("input[name='password']").val(),
                  passwordcheck:$("input[name='passwordcheck']").val(),
                  tel:$("input[name='tel']").val(),
                  gender:$("input[name='gender']").val(),
                  addr:$("input[name='addr']").val(),
                  birth:$("input[name='birth']").val()

                },
                dataType: "json",
                success: function (response) {
            //alert(response); // 확인하고 싶으면 dataType: "text" 로 변경한 후 확인 가능
            if(response.result == 1){
              alert('가입 완료');
              location.replace('index.php'); // 화면 갱신
            } else if(response.result == 0){
              alert('이미 가입된 아이디입니다');
            } else if(response.result == -2){
              alert('입력 데이터를 확인하세요');
            } else {
              alert('등록중에 에러가 발생했습니다\n'+ response);
              //alert('등록중에 에러가 발생했습니다');
            }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert("arjax error : " + textStatus + "\n" + errorThrown);
                }
            });


    	});


    });
    </script>
    <!-- ##### Register Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>회원가입</h3>
                        <!-- Register Form -->
                        <div class="login-form">
                            <form action="_register2.php" method="post">
                              <label for="exampleInputEmail1">* 필수항목</label>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="* Enter E-mail" maxlength="30">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>이메일 형식으로 적어주세요</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="* Password" minlength="8" maxlength="30">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>비밀번호는 숫자, 영문, 특수문자를 두가지이상 혼용하여야 합니다.</small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">PasswordCheck</label>
                                    <input type="password" name='passwordcheck' class="form-control" id="exampleInputPassword2" placeholder="* Passwordcheck" minlength="8" maxlength="30">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>비밀번호는 숫자, 영문, 특수문자를 두가지이상 혼용하여야 합니다.</small>

                                </div>
                                <div class="form-group">
                                    <label >성함</label>
                                    <input type="text" name="username" class="form-control"placeholder="* 성함" maxlength="15">
                                   </div>
                                <div class="form-group">
                                    <label >닉네임</label>
                                    <input type="text" name="nickname"class="form-control" placeholder="* 닉네임" maxlength="15">
                                </div>
                                <label ># 선택항목</label><br>
                                <label >성별 : </label>
                            <lable>    <input type="radio" name="gender" value="male" checked > 남자 </lable> &nbsp;
                          <lable>       <input type="radio" name="gender" value="female" > 여자 </lable> <br>
                                <div class="form-group">
                                    <label >생년월일</label>
                                  <input type="number" name="birth" class="form-control" placeholder="생년월일 (예 : 990919)"  max="99999999">
                                </div>
                                <div class="form-group">
                                    <label >전화번호</label>
                                  <input type="number" name="tel" class="form-control" placeholder="전화번호 (예 : 08012345678)" max="99999999999">
                                </div>
                                <div class="form-group">
                                    <label >주소</label>
                                    <input type="text" name="addr"class="form-control" placeholder="주소" maxlength="100">
                                  </div>



                                <button type="submit" class="btn oneMusic-btn mt-30">Send</button>
                            </form>
                              <button type="button" onclick="location.href='login.php'"class="btn oneMusic-btn mt-30">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Register Area End ##### -->

<?php require('lib/bottom.php') ;?>
