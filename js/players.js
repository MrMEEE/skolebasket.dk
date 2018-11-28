$(document).ready(function(){
  
  $('#saveregisterplayers').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#gyms').val() == -1){
	      
	      alert(fetchText("Please select a gym"));
	      
	    }else if($('#boys').val() == -1){
	    
	      alert(fetchText("Select number of boys"));
	      
	    }else if($('#girls').val() == -1){
	    
	      alert(fetchText("Select number of girls"));
            
            }else if($('#class').val() == -1){
	    
	      alert(fetchText("Select class"));
	      
            }else if($('#length').val() == -1){
	    
	      alert(fetchText("Select practice length"));
                
            }else{
	      
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "saveregisterplayers", gymid: $('#gyms').val(), userid: $('#userid').val(), boys: $('#boys').val(), girls: $('#girls').val(), class: $('#class').val(), year: $('#year').text(), month: $('#month').val(), day: $('#day').val(), length: $('#length').val() } ,success: function(data){
		    
		    if(data[0].status == "registered"){
			alert(fetchText("Number of players has been saved"));
		    	$('#gyms').val(-1);
			$('#boys').val(-1);
			$('#girls').val(-1);
			$('#class').val(-1);
			var d = new Date();
			$('#day').val(d.getDay());
			$('#month').val(d.getMonth()+1);
                        $('#length').val(-1);
		    }
		  }});
	    }
  });

  
});
