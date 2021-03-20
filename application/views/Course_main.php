<style>
    input{
        width: 130px;
        border-radius:2px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
 		$(document).ready(function(){
//for all
 load_data();
// for course_id
 function load_data(query)
 {
 	// alert('in');
  $.ajax({
   url:"COURSE/fetch",
   type:"POST",
   dataType:"json",
   data:{query:query},
   success:function(data){
    // alert('success');
    var count=0;
    $('#result').empty();
    $('#result').append("<table>");
    $.each(data,function(key,value){
        $('#result').append('<tr><td><form method="POST">'+count+'</td><td>'+value.course_code+'</td><td>'+value.course_name+'</td><td>'+value.student_enrollmentno+'</td><td>'+value.course_reg_date+'</td><input type="hidden" name="tableRow['+count+'][course_reg_id]" value="'+value.course_reg_id+'"></td><td><input type="submit" class="btn btn-danger" name="tableRow['+count+'][del_button]" value="Delete"></form></td></tr>');
        count++;
    });
    $('#result').append("</table>");
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  // alert(search);
  if(search != '')
  {
   load_data(search);
  }
  else
  {
  	load_data();
  }
  
 });

 // for course_code
function load_data1(query)
 {
 	
 	// alert('in');
   $.ajax({
   url:"COURSE/fetch1",
   type:"POST",
   dataType:"json",
   data:{query:query},
   success:function(data){
    var count=0;
    $('#result').empty();
    $('#result').append("<table>");
    $.each(data,function(key,value){
        $('#result').append('<tr><td><form method="POST">'+count+'</td><td>'+value.course_code+'</td><td>'+value.course_name+'</td><td>'+value.student_enrollmentno+'</td><td>'+value.course_reg_date+'</td><input type="hidden" name="tableRow['+count+'][course_reg_id]" value="'+value.course_reg_id+'"></td><td><input type="submit" class="btn btn-danger" name="tableRow['+count+'][del_button]" value="Delete"></form></td></tr>');
        count++;
    });
    $('#result').append("</table>");
   }
  })
 }

 $('#search_text1').keyup(function(){
  var search = $(this).val();
  // alert(search);
  if(search != '')
  {
   load_data1(search);
  }
  
 });

//for enrollment no
function load_data2(query)
 {
 	
 	// alert('in');
   $.ajax({
   url:"COURSE/fetch2",
   type:"POST",
   dataType:"json",
   data:{query:query},
   success:function(data){
    // alert('success');
    var count=0;
    $('#result').empty();
    $('#result').append("<table>");
    $.each(data,function(key,value){
    		$('#result').append('<tr><td><form method="POST">'+count+'</td><td>'+value.course_code+'</td><td>'+value.course_name+'</td><td>'+value.student_enrollmentno+'</td><td>'+value.course_reg_date+'</td><input type="hidden" name="tableRow['+count+'][course_reg_id]" value="'+value.course_reg_id+'"></td><td><input type="submit" class="btn btn-danger" name="tableRow['+count+'][del_button]" value="Delete"></form></td></tr>');
        count++;
    });
    $('#result').append("</table>");
   }
  })
 }

 $('#search_text2').keyup(function(){
  var search = $(this).val();
  // alert(search);
  if(search != '')
  {
   load_data2(search);
  }
 
 });
 // for course reg
 function load_data3(query)
 {
 	
 	// alert('in');
   $.ajax({
   url:"COURSE/fetch3",
   type:"POST",
   dataType:"json",
   data:{query:query},
   success:function(data){
    var count=0;
    $('#result').empty();
    $('#result').append("<table>");
    $.each(data,function(key,value){
        $('#result').append('<tr><td><form method="POST">'+count+'</td><td>'+value.course_code+'</td><td>'+value.course_name+'</td><td>'+value.student_enrollmentno+'</td><td>'+value.course_reg_date+'</td><input type="hidden" name="tableRow['+count+'][course_reg_id]" value="'+value.course_reg_id+'"></td><td><input type="submit" class="btn btn-danger" name="tableRow['+count+'][del_button]" value="Delete"></form></td></tr>');
        count++;
    });
    $('#result').append("</table>");
   }
  })
 }

 $('#search_text3').keyup(function(){
  var search = $(this).val();
  // alert(search);
  if(search != '')
  {
   load_data3(search);
  }
 
 });
});
</script>

<div class="wrapper">
	<div class="upper" id="upper">
    <h4 class="titleofpage"> Course Registration</h4><br/>
 		<table>
 			<tr>
 				<th>Serial No</th>
 				<th>Course Code</th>
 				<th>Course Name</th>
                <th>Enrollment No</th>
 				<th>Course Reg Date</th>
 				<th>Record Delete</th>
                <th></th>
 			</tr>
 		   <tr>
                <td></td>
 				<td><input type="text" class="" id="search_text" name="Course_Name" placeholder="Course Code" /></td>
 				<td><input type=text id="search_text1" name="Course_Code" placeholder="Course Name"></td>
 				<td><input type=text id="search_text2" name="Enrollment_no" placeholder="Enrollment No"></td>
 				<td><input type=text id="search_text3" name="Course_reg_date" placeholder="Course Reg Date"></td>
 				<td></td>
                <td>
                    <form method="post" action="<?php echo site_url(); ?>/course_reg_controller">
                        <input type="submit" class="btn btn-warning" value="ADD"/>
                    </form>
                    <form method="post" action="<?php echo site_url(); ?>/course_list">
                        <input type="submit" class="btn btn-info" value="PDF"/>
                    </form>
                </td>
             </tr>
        </table>
        <br>
        <br>		
        <div id = "result"></div>
    </div>
</div>