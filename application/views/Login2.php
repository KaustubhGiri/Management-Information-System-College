<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
body
{
	background-color: lightblue;
	padding: 0;
	margin: 0;
}
	.div
	{
		box-shadow: 0 10px 50px black;
		height: auto;
		width: 40vw;
		margin: 10% auto;
		background-color: white;
		padding-bottom: 50px;
	}
	.header
	{
       	font-family:Blippo,serif;
		background-color: #f1f1f1;
		padding: 5px;
		text-align: center;
		font-size:250%;

	}
	.content_section
	{
		text-align: center;
		height: auto;
		padding: 10px;
	}
	h3
	{

		font-family: Blippo,cursive;
		padding: 20px;
	}
	input[type="text"],input[type="password"],input[type="submit"]
	{
		height: 40px;
		width: 30vw;
	}
	input[type="submit"]
	{
		border: none;
		border-radius: 5px;
		color: white;
		width: 15vw;
		background-color: blue;
		margin-left: 5vw;
	}
	::placeholder
     {
     	padding-left: 20px;
     	color: gray;
     }
     @media(max-width: 768px)
     {
     	.div
     	{
     		height: auto;
     		width: 90%;
     	}
     	input[type="text"],input[type="password"]
	   {
		height: 40px;
		width: 70%;
	   }
	   input[type="submit"]
	   {
	   	width: 30%;
	   }
     }
</style>
<body>
	<div class="div">
		<header class="header">GPM</header>
		<div class="content_section">
			<h3>PLEASE LOGIN TO ENTER</h3>
			<input type="text" name="" placeholder="Username"><br><br>
			<input type="password" name="" placeholder="Password"><br><br>
             <div>
			<input type="submit" name="" value="Submit">
		</div>
	</div>
	</div>

</body>
</html>