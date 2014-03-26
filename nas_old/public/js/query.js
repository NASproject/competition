var URL = "http://" + $(location).attr('host')+ "/nas/index.php/query";
console.log(URL);
$(document).ready(function(){
    $('#sds').dropdown();
    $("#selects li").click(function(){
        var placeholders = new Array(4)
        placeholders[0] = "請輸入關鍵字"
        placeholders[1] = "請輸入指導教授"
        placeholders[2] = "請輸入專題名稱"
		placeholders[3] = "請輸入級別"
        $selec = $(this).find("a").attr("se");
        $("#appendedDropdownButton").attr("placeholder",placeholders[$selec-1]);
        $("#appendedDropdownButton").attr("se",$selec);
      
    });
    $("#appendedDropdownButton").next().next().click(function(){
        select();
    });
});

function test(a)
{
	console.log(a);
}

function select()
{
   
    if($("#appendedDropdownButton").attr("placeholder") == "請輸入關鍵字")
    {
        
        var request = $.ajax({
            url: URL,
            type: "POST",
            data: {
                action:"keyword",
                k_value:$("#appendedDropdownButton").val()
            },
            dataType: "html"
        });
        request.done(function(data) {
            if(data == 0)alert("無資料");
            else{
           
                $("#result tr.qu").remove();
				console.log(data);
//                data = eval(data);
				data = jQuery.parseJSON(data)
                for($i = 0; $i< data.length;$i++)
                {
                    $tr = "<tr class= 'qu'>";
					$td1 = "<td>"+($i+1)+"</td>";
                    $td2 = "<td><a href = '/nas_directory/"+data[$i].p_leader_number+"' >"+data[$i].p_name+"</a></td>";					
                    $td3 = "<td>"+data[$i].p_adviser+"</td>";					
                    $td4 = "<td>"+data[$i].p_type+"</td>";
					$td5 = "<td>"+data[$i].p_description+"</td>";
                    $td6 = "<td>"+data[$i].p_leader_name+"</td>";
//                    $td7 = "<td>"+data[$i].p_enter_year+"</td>";
					$td7 = "<td>"+data[$i].p_date+"</td>";					
					$td8 = "<td>"+data[$i].p_id+"</td>";
					
					if ($td8 = "<td>"+data[$i].p_id+"</td>")
					{
						$td8 = "<td>"+"V"+"</td>";
						
					}
					else{
						$td8 = "<td>"+"X"+"</td>";
					}
                    $tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+$td8+"</tr>";
                    $("#result").append($tr);
                }
            }   
        });
        request.fail(function(jqXHR, textStatus) {
            alert( "ajax2 : " + textStatus );
        });
               
    }
    else if($("#appendedDropdownButton").attr("placeholder") == "請輸入指導教授")
    {
		
        var request = $.ajax({
            url: URL,
            type: "POST",
            data: {
                action:"teacher",
                p_adviser:$("#appendedDropdownButton").val()
            },
            dataType: "html"
        });
        request.done(function(data) {
            if(data == 0)alert("無資料");
            else{
           
                $("#result tr.qu").remove();
				console.log(data);
                data = eval(data);
                for($i = 0; $i< data.length;$i++)
                {
				
					$tr = "<tr class= 'qu'>";
					$td1 = "<td>"+($i+1)+"</td>";
                    $td2 = "<td><a href = '/nas_directory/"+data[$i].p_leader_number+"' >"+data[$i].p_name+"</a></td>";					
                    $td3 = "<td>"+data[$i].p_adviser+"</td>";					
                    $td4 = "<td>"+data[$i].p_type+"</td>";
					$td5 = "<td>"+data[$i].p_description+"</td>";
                    $td6 = "<td>"+data[$i].p_leader_name+"</td>";
//                    $td7 = "<td>"+data[$i].p_enter_year+"</td>";
					$td7 = "<td>"+data[$i].p_date+"</td>";					
					$td8 = "<td>"+data[$i].p_id+"</td>";

					$tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+$td8+"</tr>";
					//$("#result").append($tr);
																						
						$(document).ready(function(data){
						$("#btn").click(function(data){
						//$('#btn').bind("click", function(data){
						
							//($td8).slideToggle();
							//for($i = 0; $i< data.length;$i++)
							//{													
								if ($td8 = "<td>"+data[$i].p_id+"</td>")
								{								
									$td8 = "<td>"+"V"+"</td>" ;
								}
								else{
									$td8 = "<td>"+"X"+"</td>"	;
								}
								
							$tr += $td8+"</tr>";
							$("#result").append($tr);
							//}
						});							
							event.stopPropagation();													
					});
					//$tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+$td8+"</tr>";
					$("#result").append($tr);
                }
            } 
			
				
        });
		
        request.fail(function(jqXHR, textStatus) {
            alert( "ajax2 : " + textStatus );
        });
                
    }
    else if($("#appendedDropdownButton").attr("placeholder") == "請輸入專題名稱")
    {
        var request = $.ajax({
            url: URL,
            type: "POST",
            data: {
                action:"project",
                p_name:$("#appendedDropdownButton").val()
            },
            dataType: "html"
        });
        request.done(function(data) {
            if(data == 0)alert("無資料");
            else{
                $("#result tr.qu").remove();
                data = eval(data);       
                for($i = 0; $i< data.length;$i++)
                {
                    $tr = "<tr class= 'qu'>";
					$td1 = "<td>"+($i+1)+"</td>";
                    $td2 = "<td><a href = '/nas_directory/"+data[$i].p_leader_number+"' >"+data[$i].p_name+"</a></td>";					
                    $td3 = "<td>"+data[$i].p_adviser+"</td>";					
                    $td4 = "<td>"+data[$i].p_type+"</td>";
					$td5 = "<td>"+data[$i].p_description+"</td>";
                    $td6 = "<td>"+data[$i].p_leader_name+"</td>";
//                    $td7 = "<td>"+data[$i].p_enter_year+"</td>";
					$td7 = "<td>"+data[$i].p_date+"</td>";
					$td8 = "<td>"+data[$i].p_id+"</td>";
					
					if ($td8 = "<td>"+data[$i].p_id+"</td>")
					{
						$td8 = "<td>"+"V"+"</td>";
					}
					else{
						$td8 = "<td>"+"X"+"</td>";
					}
                    $tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+$td8+"</tr>";
                    $("#result").append($tr);
                }
            }   
        });
                
    }
	else if($("#appendedDropdownButton").attr("placeholder") == "請輸入級別")
    {
        var request = $.ajax({
            url: URL,
            type: "POST",
            data: {
                action:"enter_year",
                enter_year:$("#appendedDropdownButton").val()
            },
            dataType: "html"
        });
        request.done(function(data) {
            if(data == 0)alert("無資料");
            else{
                $("#result tr.qu").remove();
                data = eval(data);       
                for($i = 0; $i< data.length;$i++)
                {
                    $tr = "<tr class= 'qu'>";
					$td1 = "<td>"+($i+1)+"</td>";
                    $td2 = "<td><a href = '/nas_directory/"+data[$i].p_leader_number+"' >"+data[$i].p_name+"</a></td>";					
                    $td3 = "<td>"+data[$i].p_adviser+"</td>";					
                    $td4 = "<td>"+data[$i].p_type+"</td>";
					$td5 = "<td>"+data[$i].p_description+"</td>";
                    $td6 = "<td>"+data[$i].p_leader_name+"</td>";
//					$td7 = "<td>"+data[$i].p_enter_year+"</td>";
                    $td7 = "<td>"+data[$i].p_date+"</td>";
					$td8 = "<td>"+data[$i].p_id+"</td>";
					
					if ($td8 = "<td>"+data[$i].p_id+"</td>")
					{
						$td8 = "<td>"+"w"+"</td>";
					}
					else{
						$td8 = "<td>"+"X"+"</td>";
					}
                    $tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+$td8+"</tr>";
                    $("#result").append($tr);
                }
            }   
        });
                
    }
}
