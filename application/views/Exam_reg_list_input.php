
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
			form
			{
				margin:20px;
				text-align:center;
			}
	</style></head>
<div class="wrapper">
		<div class="upper">
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
			  <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
			  <script type="text/javascript" src="<?php echo base_url(); ?>js/exrl.js"></script>
			  <h4 class="titleofpage"> Exam Registration List</h4><br/>
			<form method="post" action="" target="_blank">
				
				<table class="table" id="table">
					<tr class="tr">
						<td class="td">
							<label for="exrl_upp_sel_tex_1" id="exrl_upp_lab_tex_1">Course Code</label>
						</td>
					<td class="td">
					<select name="course_code" id="exrl_upp_sel_tex_1">
			            <option value="">Select Course Code</option>
			            <?php foreach ($Course_code as $key => $value) { ?>
			            <option value="<?php echo $value->course_code;?>"><?php echo $value->course_code; ?></option>
			                    <?php } ?>
		            </select><br><br>
					</td>
					</tr>
					<tr class="tr">
						<td class="td">
							<label for="exrl_upp_sel_tex_2" id="exrl_upp_lab_tex_2">Shift</label>
						</td>
						<td class="td">
						<select name="course_shift" id="exrl_upp_sel_tex_2">
			                <option value="">Select Course shift</option>
			                 <option value="FS">FS</option>
			  				<option value="SS">SS</option>
			  			</select><br><br>
					  	</td>
					 </tr>
					 <tr class="tr">
					 	<td class="td">
					 	</td>
					 	<td class="td">
					 		<input type="submit" name="submit" value="Submit" id="exrl_upp_inp_sub_1" disabled>
					 	</td>
					 	
					 </tr>
		
				</table>
		</form>
	</div>
</div>
