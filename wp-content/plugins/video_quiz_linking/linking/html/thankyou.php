<!DOCTYPE html>
<html>
<head>
	<title>Thank You</title>
	<style>
		*{
			padding: 0px;
			box-sizing: border-box;
			margin: 0px;			
		}
		.thanx_container{
			width: 100%;
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.thnx_inner_container{
			width: 95%;
			flex-direction: column;
			display: flex;
			max-width: 1024px;
			justify-content: center;
			align-items: center;
		}
		.thnx_inner_container h1{
			display: flex;
			width: 100%;
			justify-content: center;
			align-items: center;
			color: #000;
			font-size: 48px;
			text-align: center;
		}
		.thankyou_img{
			display: flex;
			margin: 30px 0px;
			width: 100%;
			justify-content: center;
			align-items: center;
		}
		.thnx_inner_container p{
			font-size: 24px;
			display: flex;
			width: 100%;
			justify-content: center;
			align-items: center;
			color: #777;			
		}
		.btn_area{
			display: flex;
			width: 100%;
			justify-content: center;
			align-items: center;
		}
		.btn{
			background-color: #777;
			color: white;
			font-size: 24px;
			display: flex;
			padding: 10px 20px;
			border: none;
			margin: 10px;
			border-radius: 10px;
			justify-content: center;
			align-items: center;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="thanx_container">
		<div class="thnx_inner_container">
			<h1>
				THANK YOU
			</h1>
			<div class="thankyou_img">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="200" height="200"><path fill="#4caf50" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"/><path fill="#ccff90" d="M34.602,14.602L21,28.199l-5.602-5.598l-2.797,2.797L21,33.801l16.398-16.402L34.602,14.602z"/></svg>
			</div>
			<!-- <p>
				bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla 
			</p> -->
			<div class="btn_area">
				<a href="<?php echo site_url(); ?>">
					<button class="btn">Go To Home</button>
				</a>
			</div>
		</div>
		
	</div>
</body>
</html>