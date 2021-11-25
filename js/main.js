$(document).ready(()=>{
    const $logSec =$('#loginSec');
    const $regSec =$('#registerSec');
    
    //login btn
    //hide register section and show login section, make the login button blue and the register button white
    $('#logBtn').on('click', () => {
        $logSec.fadeIn();
        $regSec.hide(); 
        $("#logBtn").removeClass("btn-light").addClass("btn-primary");
        $("#regBtn").removeClass("btn-primary").addClass("btn-light");
   
    });
    
    //register btn
    //show register section and hide login section, make the register button blue and the login button white
    $('#regBtn').on('click', () => {
        $regSec.fadeIn();
        $logSec.hide();
        $("#regBtn").removeClass("btn-light").addClass("btn-primary");
        $("#logBtn").removeClass("btn-primary").addClass("btn-light");
    });

    //creating a new account
    $('#createAccount').on('click', ()=>{
        var fieldTr = 0;
        var fields = document.querySelectorAll('.registFormBox');
        //checks all fields and highlights all empty fields else unhighlights any once highlighted field
        for(i = 0; i < fields.length; i++){
            if(fields[i].value == ""){
                fields[i].style.border = "2px solid red";
                fieldTr++;
            }
            else
                fields[i].style.border = "1px solid black";
        }
        
        //resets/hides the warning boxes
        $('#fillWarning').fadeOut();
        $('#passWarning').fadeOut();
        $('#emailWarning').fadeOut();

        //since there is no missing field, proceed to check password
        if(!(fieldTr)){
            //check if password fields match, create a post
            if($('#passField').val() == $('#confField').val()){
                //$("#createAccount").attr("disabled", "true");
                //get the values of the fields
                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var address = $('#add').val();
                var district = $('#dist').val();
                var email = $('#regEAddr').val();
                var phone = $('#pNum').val();
                var password = $('#passField').val();

                $.ajax({
                    url: "php/db_register.php",
                    type: "POST",
                    data: {
                        first: fname,
                        last: lname,
                        homeAdd: address,
                        district: district,
                        emailAdd: email,
                        phoneNum: phone,
                        password: password				
                    },
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            window.location.href = "./home.php"						
                        }
                        else if(dataResult.statusCode == 201){
                           alert("Error occured !");
                        }
                        else if(dataResult.statusCode == 202){
                            $('#emailWarning').fadeIn();
                        }                        
                    }
                });
            }
            //else flag user by highlighing fields and showing message of missmatch
            else{
                $('#passWarning').fadeIn();
                $('#passField').css("border", "2px solid red");
                $('#confField').css("border", "2px solid red");
            }
        }
        //if there are any missing field, flag user with message
        else
            $('#fillWarning').fadeIn();
    });

    //signing in using user credentials
    $('#signIn').on('click', ()=>{
        var signE = $('#signEmail').val();
        var signP = $('#signPass').val();

        $('#accountMismatch').fadeOut();
        $('#accountIncomplete').fadeOut();
    
        if(signE == "" || signE == " " || signP == ""){
            $('#accountIncomplete').fadeIn();
        }        
        else{
            $.ajax({
				url: "php/db_lookup.php",
				type: "POST",
				data: {
					signE: signE,
					signP: signP						
				},
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "./home.php";						
					}
					else if(dataResult.statusCode==201){
						$('#accountMismatch').fadeIn();
					}
					
				}
			});
        }
    });

});