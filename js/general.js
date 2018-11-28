$(document).ready(function(){
      
      $('.loginButton').on('click',null,function(event){
	    event.preventDefault();
	    var password = CryptoJS.SHA256($("#password").val()).toString();
	    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "logon", username: $("#username").val(), password: password, club: $("#clubSelect").val()} ,success: function(data){
		  if(data[0].status == 1){
			alert(fetchText("Wrong Username or Password"));
		  }else{
			location.reload();
		  }
	    }});
      });
      
      $('.navigation').on('click',null,function(event){
	    event.preventDefault();
	    $('#nextState').attr('value', event.target.id);
	    $('#mainForm').submit();
	    //alert(event.target.id);
      });
      
      $('#logout').on('click',null,function(event){
	    event.preventDefault();
	    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "logout" } ,success: function(data){
			
	    }});
	    document.location.reload(true);
      });
      $('.evalStudentButton').on('click',null,function(event){
            event.preventDefault();
            window.open('https://docs.google.com/forms/d/e/1FAIpQLSfCqF6bzZ_TAdPRm09_-1au0coH_YFtQgr5X-kseGVEp8Ytcg/viewform', 'Elev Evaluering', 'window settings');
            return false;
      });
      $('.evalTeacherButton').on('click',null,function(event){
            event.preventDefault();
            window.open('https://docs.google.com/forms/d/e/1FAIpQLSepABkL5xT0-XQM0t7YR7YnmWpFojBn7tTbbJvGmPje998oEw/viewform', 'Lærer Evaluering', 'window settings');
            return false;
      });
      
      var zoomEnable;

      zoomEnable = function() {
	$("head meta[name=viewport]").prop("content", "width=device-width, initial-scale=1.0, user-scalable=yes");
      };

      $("input").on("touchstart", function(e) {
	$("head meta[name=viewport]").prop("content", "width=device-width, initial-scale=1.0, user-scalable=no");
      });

      $("input").blur(zoomEnable);
  
});

function changeState(newstate){

  document.mainForm.nextState.value = newstate;
  document.mainForm.submit();

}

function fetchText(string){
      var newtext;
      
      $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "fetchText", string: string } ,success: function(data){
	newtext = data[0].text;
	
      }});
      
      return newtext;
  
}
