$host = 'http://mars.kh.usc.edu.tw';
var NASURL = "http://mars.kh.usc.edu.tw/nas/index.php/query";
$(document).ready(function(){
//	alert(checkBroswer());
	$("#li_search").click(function(){
		var url = $(this).attr("value");
		href_load(url);
	});
	
    $("#search").click(function(){
        select();
    });
	
	$("#callAjaxForm").submit(function(){
//		alert("#callAjaxForm");
        select();
		return false;
    });
	
 	
});
function test(a)
{
	console.log(a);
}

function href_load(url) { //解決無法直接使用href屬性的問題
	location.href= url;
}

function onError(data, status)
{
	alert(data);
} 

function onSuccess(data, status)
{
/*
	var strJSON = '{"Name":"Tom", "Age":14,"Enable":true}';
	test(strJSON);
	var obj = jQuery.parseJSON(strJSON);
	test(obj.Name);
	test(data);
*/	
	if($("#sel_tw22").attr("value") == "0")
		data = jQuery.parseJSON(data);
	else
		data = eval(data);
	test(data);
	$("#result tr.qu").remove();
	for($i = 0; $i< data.length;$i++)
	{
/*
		if($("#sel_tw22").attr("value") == "0"){
			data2 = jQuery.parseJSON(data[$i]);
			for($j = 0; $j< data2.length;$j++)
			{
				$tr = "<tr class= 'qu' >";
				$td1 = "<td> " + data2[$j].p_adviser + "&nbsp;" + data2[$j].p_date + "<br><a href = '" + $host + "/nas_directory/" + data2[$j].p_leader_number + "' >" + data2[$j].p_name + "</a><hr></td>";
				$tr += $td1+"</tr>";
		  
				$("#result").append($tr);
			}
		} else 
*/		
		{
			$tr = "<tr class= 'qu' >";
			$td1 = "<td> " + data[$i].p_adviser + "&nbsp;" + data[$i].p_date + "<br><a href = '" + $host + "/nas_directory/" + data[$i].p_leader_number + "' >" + data[$i].p_name + "</a><hr></td>";
			$tr += $td1+"</tr>";
	  
			$("#result").append($tr);
		}
	}
}
function select()
{
	test($("#sel_tw22").attr("value"));
//	alert($("#inp_tw20").val());
	switch(parseInt($("#sel_tw22").val()))
//    if($("#sel_tw22").attr("value") == "0")
    {
		case 0:
			test(0);
			var request = $.ajax({
//				url: $host + "/nas/Controls/query.php",

				url: NASURL,
				type: "POST",	
				cache: false,
				crossDomain: true,
				success: onSuccess,
				error: onError,			
				data: {
					action:"keyword",
					k_value:$("#inp_tw20").val()
				},
				contentType: "application/x-www-form-urlencoded; charset=utf-8",
				dataType: "html"
			});
			break;
		case 1:
			test(1);
			var request = $.ajax({
				//url: $host + "/nas/Controls/query.php",
				url: NASURL,
				type: "POST",	
				cache: false,
				crossDomain: true,
				success: onSuccess,
				error: onError,			
				data: {
					action:"teacher",
					p_adviser:$("#inp_tw20").val()
				},
				contentType: "application/x-www-form-urlencoded; charset=utf-8",
				dataType: "html"
			});
			break;		
		case 2:
			test(2);
			var request = $.ajax({
				url: NASURL,
				//url: $host + "/nas/Controls/query.php",
				type: "POST",	
				cache: false,
				crossDomain: true,
				success: onSuccess,
				error: onError,			
				data: {
					action:"project",
					p_name:$("#inp_tw20").val()
				},
				contentType: "application/x-www-form-urlencoded; charset=utf-8",
				dataType: "html"
			});
			break;		
	}
/*		
        request.done(function(data) {
			test(2);

            if(data.length == 0)alert("無資料");
            else
            {
				test(data);
                data = jQuery.parseJSON(data);
                $("#result tr.qu").remove();
                for($i = 0; $i< data.length;$i++)
                {
                    data2 = jQuery.parseJSON(data[$i]);
                    for($j = 0; $j< data2.length;$j++)
                    {
                        $tr = "<tr class= 'qu' >";
						$td1 = "<td> " + data2[$j].p_adviser + "&nbsp;" + data2[$j].p_date + "<br><a href = '" + $host + "/nas_directory/" + data2[$j].p_leader_number + "' >" + data2[$j].p_name + "</a><hr></td>";
						
//                        $td1 = "<td><a href = '" + $host + "/nas_directory/"+data2[$j].p_leader_number+"' >"+data2[$j].p_name+"</a></td>";
                        $td2 = "<td>"+data2[$j].p_adviser+"</td>";
                        $td3 = "<td>"+data2[$j].p_type+"</td>";
                        $td4 = "<td>"+data2[$j].p_description+"</td>";
                        $td5 = "<td>"+data2[$j].p_leader_name+"</td>";
                        $td6 = "<td>"+data2[$j].p_leader_number+"</td>";
                        $td7 = "<td>"+data2[$j].p_date+"</td>";
                        $tr += $td1+$td2+$td3+$td4+$td5+$td6+$td7+"</tr>";
						
						$tr += $td1+"</tr>";
                  
                        $("#result").append($tr);
                    }
                }
            }
		
        });
	
        request.fail(function(jqXHR, exception) {
			if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }		

			var value = '';
			$.each(jqXHR, function(key, val) {
			  value += key + ' : ' + val + ';' + '\n';
			});

//            alert( "ajax2 : " + value );
        });
*/               
//    }	//end of if 
	
}

function checkBroswer() {
	var broswer = ''; 
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|Opera/i.test(navigator.userAgent) ){
		broswer = 'mobile';
	} else {
		broswer = 'PC';
	}
	return broswer;
}