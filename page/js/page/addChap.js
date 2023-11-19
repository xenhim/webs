class images {
  constructor(path, temp) {
    this.path = path;
    this.temp = temp;
  }
}


$(document).ready(function(){ 
	  $("#addChap").click(function(){
		$('#addChap').attr("disabled", true);		  
		 var Summary = $("#Summary").val();		
		 var Name=$("#Name").val();
		 var Content=CKEDITOR.instances.Content.getData();
		 var Content_01="";
		 var Content_02="";
		 var Content_03=CKEDITOR.instances.Content_03.getData();
		// var c_4=$("#Content_04").val();
		 var Content_04=$("#Content_04").val();
		 var Content_04="";
		 var Notify="";
		 var Title=$("#Title").val();
		 var IdStory=$('#addChap').attr("id-story");
		 var tab_attribs = [];
		 var temp2=[];
		 var temp3=[];
		  var check_link= $('#check_link :selected').text();
			$('img.image-avatar').each(function () {
				var temp1=$(this).attr("custom_attribute");
				var str1=temp1.substring(temp1.lastIndexOf("/")+1);
				var str2=str1.lastIndexOf(".");
				var str3=str1.substring(0,str2);
				const img = new images(temp1, str3);
				temp2.push(img);
			});
	    temp2.sort(function(a, b){return a.temp - b.temp});
		for(var i=0;i<temp2.length;i++){
			temp3.push(temp2[i].path);
		}
		 if(check_link !="Chọn"){
			  temp3=Content_04.split(',');
		  }
	   if(Name!=""){
		 $.ajax({     
	       url:'ajax/chap/add.php',
	       type:'POST',
	       cache:false,
	       data:{'IdStory':IdStory,'Name':Name,'Path':temp3,'Content':Content,'Content_01':Content_01,'Content_02':Content_02,'Content_03':Content_03,'Content_04':Content_04,'Notify':Notify,'Summary':Summary,'tempChap':tempChap,'Title':Title},
	       success:function(kq){
	       	var o = JSON.parse(kq);
	                 //console.log(kq);
					 $('#addChap').attr("disabled", false);	
					 alert(o.Error);
					 location.reload();
				  
	           }
	      })
		 }else{
			 alert("Name no Null");
		  }
	}); 
	$("#editChap").click(function(){
		
		if(confirm("Are you sure you want to save this?")){
       
   
		 $('#editChap').attr("disabled", true);	
		 
		  var Summary = $("#Summary").val();
		
		 var Name=$("#Name").val();
		 var Content=CKEDITOR.instances.Content.getData();
		 var Content_01="";
		 var Content_02="";
		 var Content_03=CKEDITOR.instances.Content_03.getData();
		 //var c_4=$("#Content_04").val()
		 var Content_04=$("#Content_04").val();
		 var Notify="";
		 var Title=$("#Title").val();
		 var IdChap=$('#editChap').attr("data-id-chap");
		 var IdStory=$('#editChap').attr("data-id-story");
		 var tab_attribs = [];
		 var temp2=[];
		 var temp3=[];
		 
		  var check_link= $('#check_link :selected').text();
			$('img.image-avatar').each(function () {
				var temp1=$(this).attr("custom_attribute");
				var str1=temp1.substring(temp1.lastIndexOf("/")+1);
				var str2=str1.lastIndexOf(".");
				var str3=str1.substring(0,str2);
				const img = new images(temp1, str3);
				temp2.push(img);
			});
	    temp2.sort(function(a, b){return a.temp - b.temp});
		for(var i=0;i<temp2.length;i++){
			temp3.push(temp2[i].path);
		}
		if(check_link !="Chọn"){
			  temp3=Content_04.split(',');
		  }
		  
		
	   if(Name!=""){
		 $.ajax({     
	       url:'ajax/chap/edit.php',
	       type:'POST',
	       cache:false,
	       data:{'IdStory':IdStory,'IdChap':IdChap,'Name':Name,'Path':temp3,'Content':Content,'Content_01':Content_01,'Content_02':Content_02,'Content_03':Content_03,'Content_04':Content_04,'Notify':Notify,'Summary':Summary,'tempChap':tempChap,'Title':Title},
	       success:function(kq){
	       	var o = JSON.parse(kq);
	               // console.log(kq);
					  $('#editChap').attr("disabled", false);	
					  alert(o.Error);
					  console.log(temp3);
					  if(o.Error=="Sửa thành công")
						 window.location.href = 'listChap.php?idStory='+IdStory;
					  else
					  location.reload();
				  
	           }
	      })
		 }else{
			 alert("Name no Null");
		  }
	   }
    else{
        return false;
    }
	}); 
 	 
});