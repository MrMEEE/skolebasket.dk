$(document).ready(function(){
  $('#girlsdiv').hide();
  $('#boysdiv').hide();
  $('#lengthdiv').hide();
  $('#updatediv').hide();
  $('#deletediv').hide();
  $('#date').hide();  
  if ($('#selectuser').val() != -1){
    
    $('#logstable tr').not(':first').remove();
      $('#clublogstable tr').not(':first').remove();
      var html = '';
      $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getlogsforuser", userid: $('#selectuser').val() } ,success: function(data){
      var out = '';
    for (var i in data) {
        out += i + ": " + data[i] + "\n";
    }
    for(var i = 0; i < data.logs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.logs[i].id+'</td><td class="date">' + data.logs[i].date + '</td><td class="boys">' + data.logs[i].boys + '</td><td class="girls">' + data.logs[i].girls + '</td><td class="length">' + data.logs[i].length + '</td></tr>';
    $('#logstable tr').first().after(html);
    var html = '';
    for(var i = 0; i < data.clublogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.clublogs[i].id+'</td><td class="date">' + data.clublogs[i].date + '</td><td class="length">' + Math.round(data.clublogs[i].length * 60) + '</td></tr>';
    $('#clublogstable tr').first().after(html);
    var html = '';
    for(var i = 0; i < data.grandprixlogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.grandprixlogs[i].id+'</td><td class="date">' + data.grandprixlogs[i].date + '</td></tr>';
    
    $('#grandprixlogstable tr').first().after(html);
    
        
      }});
  }
  
  $('#selectuser').on('change',null,function(event){
	    $('#logstable tr').not(':first').remove();
      $('#clublogstable tr').not(':first').remove();
      var html = '';
      $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getlogsforuser", userid: $('#selectuser').val() } ,success: function(data){
      var out = '';
    for (var i in data) {
        out += i + ": " + data[i] + "\n";
    }
    for(var i = 0; i < data.logs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.logs[i].id+'</td><td class="date">' + data.logs[i].date + '</td><td class="boys">' + data.logs[i].boys + '</td><td class="girls">' + data.logs[i].girls + '</td><td class="length">' + data.logs[i].length + '</td></tr>';
    $('#logstable tr').first().after(html);
    var html = '';
    for(var i = 0; i < data.clublogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.clublogs[i].id+'</td><td class="date">' + data.clublogs[i].date + '</td><td class="length">' + Math.round(data.clublogs[i].length * 60) + '</td></tr>';
    $('#clublogstable tr').first().after(html);
    
    var html = '';
    for(var i = 0; i < data.grandprixlogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.grandprixlogs[i].id+'</td><td class="date">' + data.grandprixlogs[i].date + '</td></tr>';
    
    $('#grandprixlogstable tr').first().after(html);
    
    $('#girlsdiv').hide();
    $('#boysdiv').hide();
    $('#lengthdiv').hide();
    $('#date').hide(); 
    $('#updatediv').hide();
        
    }});
  });
  
  $('body').on('click', '#logstable tr', function(){
    var date = $(this).find(".date").text().split('-');
    //alert($(this).find(".id").text());
    $('#girlsdiv').show();
    $('#boysdiv').show();
    $('#lengthdiv').show();
    $('#date').show();
    $('#logstable tr').css("background-color", "white");
    $('#clublogstable tr').css("background-color", "white");
    $('#grandprixlogstable tr').css("background-color", "white");
    $(this).css("background-color", "lightgrey");
    //$('#date').text($(this).find(".date").text());
    $('#day').val(parseInt(date[2]));
    $('#month').val(parseInt(date[1]));
    $('#year').val(date[0]);
    $('#boys').val($(this).find(".boys").text());
    $('#girls').val($(this).find(".girls").text());
    $('#length').val($(this).find(".length").text());
    $('#logid').val($(this).find(".id").text());
    $('#logtype').val("school");
    $('#updatediv').show();
    $('#deletediv').show();
   
  });
  
  $('body').on('click', '#clublogstable tr', function(){
    //alert($(this).find(".id").text());
    var date = $(this).find(".date").text().split('-');
    $('#girlsdiv').hide();
    $('#boysdiv').hide();
    $('#lengthdiv').show();
    $('#date').show();
    $('#day').val(parseInt(date[2]));
    $('#month').val(parseInt(date[1]));
    $('#year').val(date[0]);
    //$('#date').text($(this).find(".date").text());
    $('#length').val($(this).find(".length").text());
    $('#logid').val($(this).find(".id").text());
    $('#updatediv').show();
    $('#deletediv').show();
    $('#logtype').val("club");
    $('#logstable tr').css("background-color", "white");
    $('#clublogstable tr').css("background-color", "white");
    $('#grandprixlogstable tr').css("background-color", "white");
    $(this).css("background-color", "lightgrey");
    
    
  });
  
    $('body').on('click', '#grandprixlogstable tr', function(){
    //alert($(this).find(".id").text());
    var date = $(this).find(".date").text().split('-');
    $('#girlsdiv').hide();
    $('#boysdiv').hide();
    $('#lengthdiv').hide();
    $('#date').show();
    $('#day').val(parseInt(date[2]));
    $('#month').val(parseInt(date[1]));
    $('#year').val(date[0]);
    //$('#date').text($(this).find(".date").text());
    //$('#length').val($(this).find(".length").text());
    $('#logid').val($(this).find(".id").text());
    $('#updatediv').show();
    $('#deletediv').show();
    $('#logtype').val("grandprix");
    $('#logstable tr').css("background-color", "white");
    $('#grandprixlogstable tr').css("background-color", "white");
    $('#clublogstable tr').css("background-color", "white");
    $(this).css("background-color", "lightgrey");
    
    
  });
  
  $('#delete').on('click',null,function(event){
  
    event.preventDefault();
    
    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "deletelog", id: $('#logid').val(), logtype: $('#logtype').val() } ,success: function(data){
    
      $('#logstable tr').not(':first').remove();
      $('#clublogstable tr').not(':first').remove();
      $('#grandprixlogstable tr').not(':first').remove();
      var html = '';
      $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getlogsforuser", userid: $('#selectuser').val() } ,success: function(data){
      var out = '';
    for (var i in data) {
        out += i + ": " + data[i] + "\n";
    }
    for(var i = 0; i < data.logs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.logs[i].id+'</td><td class="date">' + data.logs[i].date + '</td><td class="boys">' + data.logs[i].boys + '</td><td class="girls">' + data.logs[i].girls + '</td><td class="length">' + data.logs[i].length + '</td></tr>';
    $('#logstable tr').first().after(html);
    var html = '';
    for(var i = 0; i < data.clublogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.clublogs[i].id+'</td><td class="date">' + data.clublogs[i].date + '</td><td class="length">' + Math.round(data.clublogs[i].length * 60) + '</td></tr>';
    $('#clublogstable tr').first().after(html);
    
    var html = '';
    for(var i = 0; i < data.grandprixlogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.grandprixlogs[i].id+'</td><td class="date">' + data.grandprixlogs[i].date + '</td></tr>';
    
    $('#grandprixlogstable tr').first().after(html);
        
    }});
      
      $('#logid').val("");
      $('#logtype').val("");
			$('#length').val("-1");
			$('#girls').val("-1");
			$("#boys").val("-1");
      $('#girlsdiv').hide();
      $('#boysdiv').hide();
      $('#lengthdiv').hide();
      $('#date').hide();
      $('#updatediv').hide();
      $('#deletediv').hide();
      
    }});
  });
  
  $('#update').on('click',null,function(event){
    
    event.preventDefault();
    
    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "editlog", id: $('#logid').val(), length: $('#length').val(), boys: $('#boys').val(), girls: $('#girls').val(), logtype: $('#logtype').val(), day: $('#day').val(), month: $('#month').val(), year: $('#year').val() } ,success: function(data){
			$('#logstable tr').not(':first').remove();
      $('#clublogstable tr').not(':first').remove();
      $('#grandprixlogstable tr').not(':first').remove();
      var html = '';
      $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getlogsforuser", userid: $('#selectuser').val() } ,success: function(data){
      var out = '';
    for (var i in data) {
        out += i + ": " + data[i] + "\n";
    }
    for(var i = 0; i < data.logs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.logs[i].id+'</td><td class="date">' + data.logs[i].date + '</td><td class="boys">' + data.logs[i].boys + '</td><td class="girls">' + data.logs[i].girls + '</td><td class="length">' + data.logs[i].length + '</td></tr>';
    $('#logstable tr').first().after(html);
    var html = '';
    for(var i = 0; i < data.clublogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.clublogs[i].id+'</td><td class="date">' + data.clublogs[i].date + '</td><td class="length">' + Math.round(data.clublogs[i].length * 60) + '</td></tr>';
    $('#clublogstable tr').first().after(html);
    
    var html = '';
    for(var i = 0; i < data.grandprixlogs.length; i++)
      html += '<tr><td class="id" style="display:none;">'+data.grandprixlogs[i].id+'</td><td class="date">' + data.grandprixlogs[i].date + '</td></tr>';
    
    $('#grandprixlogstable tr').first().after(html);
        
    }});
      
      
      $('#logid').val("");
      $('#logtype').val("");
			$('#length').val("-1");
			$('#girls').val("-1");
			$("#boys").val("-1");
      $('#girlsdiv').hide();
      $('#boysdiv').hide();
      $('#lengthdiv').hide();
      $('#date').hide();
      $('#updatediv').hide();
      $('#deletediv').hide();
	  }});
	

    
  });
    
});
