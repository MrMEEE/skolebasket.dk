$(document).ready(function(){
  
  $('#savelocation').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#name').val() == ""){
	      
	      alert(fetchText("Please enter name of the Location"));
	      
	    }else{
	      
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "savelocation",  name: $('#name').val() } ,success: function(data){
		    
		    if(data[0].status == "exists"){
			alert(fetchText("Location already exists"));
		    }else{
			alert(fetchText("Location created"));
			$('#name').val("");
		    }
		  }});
	    }
  });

  $('#locations').on('change',null,function(event){
    
    if($('#locations').val() != -1){
    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getlocation", id: $('#locations').val() } ,success: function(data){
		    $('#name').html(data[0].name);
    }});
    
  }else{
    
    $('#name').html("");

  }
  });
  
  $('#deletelocation').on('click',null,function(event){
    
    event.preventDefault();
    
    if($('#locations').val() != -1){
     
      var answer = confirm(fetchText("Delete location: ")+$('#name').html());
      
      if (answer == true) {
	
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "deletelocation", id: $('#locations').val() } ,success: function(data){
	    $("#locations option[value='"+$('#locations').val()+"']").remove();
	    $("#locations").val("-1");
	    $('#name').html("");  

	}});
	
      }
      
    }
    
  });
  
  
  
});
