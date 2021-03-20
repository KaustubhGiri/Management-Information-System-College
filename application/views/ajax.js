$(document).ready(function()
{	//choosing scheme on basis of dept 
	$('#did').change(
	function()
	{ 	
		var d_id=$('#did').val();
		alert(d_id);
		if(d_id!="")
		{
			$.ajax({

				url:"unit/fetch_sc_id",
				method:"POST",
				data:{d_id:d_id},
				success:function(data)
				{	alert("success");

					$('#sc_id').html(data);
				}
				
			})//ajax end

			}



	});
	//choosing sem on basis of scheme 
	$('#sc_id').change(
	function()
	{ 	
		var sc_id=$('#sc_id').val();
		alert(sc_id);
		if(sc_id!="")
		{
			$.ajax({

				url:"unit/fetch_sem_id",
				method:"POST",
				success:function(data)
				{	alert("success");
					$('#semid').html(data);
				}
				
			})//ajax end

			}



	});
	
	//choosing course on basis of semister and scheme
	$('#semid').change(
	function()
	{ 	
		var sem_id=$('#semid').val();
		var sc_id=$('#sc_id').val();

		alert(sem_id);
		alert(sc_id);
		if(sem_id!="")
		{
			$.ajax({

				url:"unit/fetch_c_id",
				method:"POST",
				data:{sem_id:sem_id,sc_id:sc_id},
				success:function(data)
				{	alert("success");
					$('#cid').html(data);
				}
				
			})//ajax end

			}



	});





});