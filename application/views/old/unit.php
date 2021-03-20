<?php
	error_reporting(0);
?><!DOCTYPE html>
<html>
<head>
	<style>
			table {
			    width:100%;
			}
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th, td {
			    padding: 15px;
			    text-align: left;
			}
			table#t01 tr:nth-child(even) {
			    background-color: #eee;
			}
			table#t01 tr:nth-child(odd) {
			   background-color: #fff;
			}
			table#t01 th {
			    background-color: black;
			    color: white;
			}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="scheme_id"]').on('change', function() {
			alert("sgfedthb");
			var val = $(this).val();
            if(val) {
                $.ajax({
                    url: 'uni/fetch_id/'+val,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="course_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="course_id"]').append('<option value="'+ value.course_id +'">'+ value.course_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="course_id"]').empty();
            }
        });
    });
</script>
</head>
<body>
	<form method="post" action="" class="modal-content">
		<div class="container">
		<?php echo $unit ?>
		Scheme-Name :
			<select id = "scheme_id" name = "scheme_id">
				<option value="">Select Option</option>
				<?php foreach ($scheme as $key => $value) { ?>
					<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?></option>
				<?php } ?>
			</select><br><br>
		Course-Name :
			<select id = "course_id" name = "course_id">
				<option value="">Select Option</option>
				<?php foreach ($course as $key => $value) { ?>
					<option value="<?php echo $value->course_id; ?>"><?php echo $value->course_name; ?></option>
				<?php } ?>
			</select><br><br>
		Semester:
			<select name = "semister_id" >
				<option value="">Select Option</option>
				<?php foreach ($sem as $key => $value) { ?>
          			<option value="<?php echo $value->semister_id; ?>"><?php echo $value->semister_type; ?></option>
        		<?php } ?>
			</select><br><br>
			Unit Test Type:
			<select name="ut_type">
				<option value="1">First Unit Test</option>
				<option value="2">Second Unit Test</option>
			</select><br><br>
		
				
		    <table>
 					<tr>
		    			<th>Student Enrollment No.</th>
		    			<th>Marks Gain</th> 
		    			<th>Total Marks</th>
  					</tr>
  					<tr>
						<?php $count = 0; foreach ($std_en as $key => $value) { ?>
						<td ><input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>"    required><?php echo  $value->student_enrollmentno;  ?></td>
						<td><input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][marks]" required><span class="text-danger"><?php echo form_error("marks")?></span></td>
						<td><input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][total_marks]" required></td>
   						
 					</tr>
 					<?php $count ++; } ?>
 			</table>
			<br>
			<div>
        		<button type="submit" name="submit" class="uni">Submit</button>
         	</div>
      	</div>
	</form>
</body>
</html>

         	<h4>Data That Fetch</h4>
         	<div>
         		<table>
         			<tr>
         				<th>Id</th>
         				<th>Sem Id</th>
         				<th>Course Id</th>
         				<th>Scheme Id</th>
         				<th>Student Id</th>
         				<th>Marks</th>
         				<th>Marks Out off</th>
         			</tr>
<?php 
       if ($_POST['ut_type'] == 1){
         		if($fetch->num_rows() > 0){
         			foreach($fetch->result() as  $row){
?>
         			<tr>
         				<td><?php echo $row->ut1_id; ?></td>
         				<td><?php echo $row->ut1_semister_id; ?></td>
         				<td><?php echo $row->ut1_course_id; ?></td>
         				<td><?php echo $row->ut1_scheme_id; ?></td>
         				<td><?php echo $row->ut1_student_id; ?></td>
         				<td><?php echo $row->ut1_marks; ?></td>
         				<td><?php echo $row->ut1_outof; ?></td>
         			</tr>
<?php
         			}
         		}else{
?>
         			<tr>
         				<td colspan="7">No Data Found</td>
         			</tr>
<?php 
         		}		
        }else{
         		if($fetch1->num_rows() > 0){
         			foreach($fetch1->result() as  $row){
?>
         			<tr>
         				<td><?php echo $row->ut2_id; ?></td>
         				<td><?php echo $row->ut2_semister_id; ?></td>
         				<td><?php echo $row->ut2_course_id; ?></td>
         				<td><?php echo $row->ut2_scheme_id; ?></td>
         				<td><?php echo $row->ut2_student_id; ?></td>
         				<td><?php echo $row->ut2_marks; ?></td>
         				<td><?php echo $row->ut2_outof; ?></td>
         			</tr>
<?php
         			}

         		}else{
?>
         			<tr>
         				<td colspan="7">No Data Found</td>
         			</tr>
<?php
         		}
        }
?>
         		</table>
         	</div>