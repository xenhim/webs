$(document).ready(function(){ 
	  $("#addStory").click(function(){
		  $('#addStory').attr("disabled", true);
		  var Avatar=$(this).attr("src-image");
		  //var sourcePath=$(this).attr("src-path");
		  var Name=$("#Name").val();
		  
		  var Gender= $('#Gender :selected').text();
		  var URL=$("#URL").val();
		 //var URL2=$("#URL2").val();
		 
		  var Status= $('#Status :selected').text();
		  var Badge=$('#Badge :selected').text();
		  var Genre=[];
		  var tags = $("#Genre").tagEditor('getTags')[0].tags;
				for (i = 0; i < tags.length; i++) { 
					Genre.push(tags[i]);
				}
	      var Author=[];
		 
		  var tags2 = $("#Author").tagEditor('getTags')[0].tags;
			for (i = 0; i < tags2.length; i++) { 
				Author.push(tags2[i]);
			}		 
		  var Country=$('#Country :selected').text();
		  var Waning=$('#Waning :selected').text();
		 
		  var NameOther=$("#NameOther").val();
		  var Content=$("#Content").val();
		  if(NameOther==""){
			  NameOther="Đang Cập Nhật";
		  }
		  if(Content==""){
			  Content="Đang Cập Nhật";
		  }
	 if (confirm("Bạn chắc muốn lưu!!!") == true) {	  
	  if(Avatar!=undefined && Name!=""){
		 $.ajax({     
	       url:'ajax/story/add.php',
	       type:'POST',
	       cache:false,
	       data:{'Gender':Gender,'URL':URL,'Name':Name,'NameOther':NameOther,'Status':Status,'Content':Content,'Avatar':Avatar,'Badge':Badge,'Waning':Waning,'Author':Author,'Genre':Genre.toString(),'Country':Country},
	       success:function(kq){
			  
	       	var o = JSON.parse(kq);
	              //console.log(o);
				  $('#addStory').attr("disabled", false);
					 alert(o.Error);
				  location.reload();
	           }
	      })
		 }else{
			 alert("Name Avatar no Null");
		 }
	 }
		 
	 }); 
 $("#editStory").click(function(){
	 $('#editStory').attr("disabled", true);
		  var Avatar=$(this).attr("src-image");
		  var Id=$(this).attr("data-id");
		  var Name=$("#Name").val();		 
		  var Status= $('#Status :selected').text();
		  var Badge=$('#Badge :selected').text();
		  
		  var Gender= $('#Gender :selected').text();
		  //var URL1=$("#URL1").val();
		  var URL=$("#URL").val();

		
		  var Genre=[];
		  var tags = $('#Genre').tagEditor('getTags')[0].tags;
				for (i = 0; i < tags.length; i++) { 
					Genre.push(tags[i]);
				}
	
		 var Author=[];
		  var tags2 = $("#Author").tagEditor('getTags')[0].tags;
			for (i = 0; i < tags2.length; i++) { 
				Author.push(tags2[i]);
			}
		  var Country=$('#Country :selected').text();
		  var Waning=$('#Waning :selected').text();
		 
		  var NameOther=$("#NameOther").val();
		  var Content=$("#Content").val();
		  if(NameOther==""){
			  NameOther="Đang Cập Nhật";
		  }
		  if(Content==""){
			  Content="Đang Cập Nhật";
		  }
	 if (confirm("Bạn chắc muốn lưu!!!") == true) {	
	  if(Avatar!=undefined && Name!=""){
		 $.ajax({     
	       url:'ajax/story/edit.php',
	       type:'POST',
	       cache:false,
	       data:{'Gender':Gender,'URL':URL,'Id':Id,'Name':Name,'NameOther':NameOther,'Status':Status,'Content':Content,'Avatar':Avatar,'Badge':Badge,'Waning':Waning,'Author':Author,'Genre':Genre.toString(),'Country':Country},
	       success:function(kq){
			  
	       	var o = JSON.parse(kq);
					$('#editStory').attr("disabled", false);	
					 alert(o.Error);
					 
					 if(o.Error=="Sửa thành công")
						 window.location.href = 'listStory.php';
					 else
					 location.reload();
				  
	           }
	      })
		 }else{
			 alert("Name Avatar no Null");
		 }
	 }
	  });  	 
});