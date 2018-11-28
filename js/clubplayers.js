$(document).ready(function(){
  
  $('#saveclubregisterplayers').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#locations').val() == -1){
	      
	      alert(fetchText("Please select a location"));
	      
	        }else if($('#length').val() == -1){
	    
	      alert(fetchText("Select practice length"));
                
            }else{
	      
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "saveclubregisterplayers", locationid: $('#locations').val(), userid: $('#userid').val(), year: $('#year').text(), month: $('#month').val(), day: $('#day').val(), length: $('#length').val() } ,success: function(data){
		    
		    if(data[0].status == "registered"){
			alert(fetchText("Log has been saved."));
		    $('#locations').val(-1);
			var d = new Date();
			$('#day').val(d.getDay());
			$('#month').val(d.getMonth()+1);
            $('#length').val(-1);
		    }
		  }});
	    }
  });

  
});
