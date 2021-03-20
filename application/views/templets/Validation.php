
<div class="validation_section">
		<?php 
			if($message !="")
			{
		?>
				<div class="<?php if($validclass !=""){ echo $validclass; } ?>">
  					<?php echo $message; ?>
				</div>
		<?php	
			}
		?>
</div>


<style type="text/css">

.validation_section{
		border: none;
	}

	
.valid {
  padding: 20px;
  color: white;
  opacity: 1;
  margin-bottom: 15px;
}

.valid.danger {background-color: #f44336;}
.valid.success {background-color: #4CAF50;}
.valid.info {background-color: #2196F3;}
.valid.warning {background-color: #ff9800;}

</style>