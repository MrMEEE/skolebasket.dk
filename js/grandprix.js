$(document).ready(function(){
  
  $('#savegrandprixregisterplayers').on('click',null,function(event){
	    event.preventDefault();
	    
	       
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "savegrandprixregisterplayers", userid: $('#userid').val(), year: $('#year').text(), month: $('#month').val(), day: $('#day').val() } ,success: function(data){
		    
		    if(data[0].status == "registered"){
			alert(fetchText("Log has been saved."));
		    $('#locations').val(-1);
			var d = new Date();
			$('#day').val(d.getDay());
			$('#month').val(d.getMonth()+1);
            $('#length').val(-1);
		    }
		  }});
  });

  
});
