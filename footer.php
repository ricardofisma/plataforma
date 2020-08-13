<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	
.mainw {
	max-height: 550px;;
	background-color: #2c2f;
	color: white;
	font-size: 38pt;
	text-align: center;
	line-height: 550px;
}

.footer-distributed{
	background-color: rgb(20,0,20);
	box-shadow: 1px 1px 1px 0 rgba(200, 200, 0, 0.12);
	box-sizing: border-box;
	width: 100%;
	text-align: center;
	font: bold 16px serif;

	padding: 55px 50px;
	margin-top: 25px;
}

.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right{
	display: inline-block;
	vertical-align: top;
}




.footer-distributed .footer-left{
	width: 33%;
}

.footer-distributed h3{
	color:  #ffffff;
	margin: 0;
}

.footer-distributed h3 span{
	color:  rgb(10,50,70);
}


.footer-distributed .footer-links{
	color:  #ffffff;
	margin: 20px 0 12px;
	padding: 0;
}

.footer-distributed .footer-links a{
	display:inline-block;
	line-height: 1.8;
	text-decoration: none;
	color:  inherit;
}

.footer-distributed .footer-company-name{
	color:  rgb(255,85,85);
	font-size: 14px;
	font-weight: normal;
	margin: 0;
}







.footer-distributed .footer-center{
	width: 33%;
}

.footer-distributed .footer-center i{
	background-color:  rgb(255,255,255);
	color: rgb(70,0,70);
	font-size: 25px;
	width: 38px;
	height: 38px;
	border-radius: 50%;
	text-align: center;
	line-height: 42px;
	margin: 10px 15px;
	vertical-align: middle;
}

.footer-distributed .footer-center i.fa-envelope{
	font-size: 17px;
	line-height: 38px;
}

.footer-distributed .footer-center p{

	color: #ffffff;
	vertical-align: middle;
	margin:0;
}

.footer-distributed .footer-center p span{
	display:block;
	font-weight: normal;
	font-size:14px;
	line-height:2;
}

.footer-distributed .footer-center p a{
	color:  #5383d3;
	text-decoration: none;;
}








.footer-distributed .footer-right{
	width: 33%;
		vertical-align: middle;
}

.footer-distributed .footer-company-about{
	line-height: 20px;
	color:  #92999f;
	font-size: 13px;
	font-weight: normal;
	margin: 0;
}


.footer-distributed .footer-icons{
	margin-top: 25px;
}

.footer-distributed .footer-icons a{
	display: inline-block;
#	width: 30px;
#	height: 30px;
	cursor: pointer;
	background-color:  rgb(255,255,255);
	border-radius: 2px;
padding:5px;
	font-size: 30px;
	border-radius:7px;
	color: rgb(70,0,70);
	text-align: center;
	line-height: 35px;

	margin-right: 3px;
	margin-bottom: 5px;
}


@media (max-width: 880px) {

	.footer-distributed{
		font: bold 14px sans-serif;
	
	}

	.footer-distributed .footer-left,
	.footer-distributed .footer-center,
	.footer-distributed .footer-right{
		display: block;
		width: 100%;
		font-family:serif;
		margin-bottom: 40px;
		text-align: center;
	}

	.footer-distributed .footer-center i{
		margin-left: 0;
	}
	.main {
		line-height: normal;
		font-size: auto;
	}

}
    </style>

<?php
	$ff=mysqli_query($link,"SELECT * FROM foot");
	$ff1=mysqli_fetch_assoc($ff);
//	echo "<img id='upfilew2' style='height:155px ;cursor:pointer;' data-c1='rrrr' src= 'archivosland/".$aboutw2['idland']."".$aboutw2['foto']."' onerror=this.src='curso.png'>";
?>

<?php
	$about2=mysqli_query($link,"SELECT * FROM land WHERE tipo='logo'");
	$aboutw2=mysqli_fetch_assoc($about2);
//	echo "<img id='upfilew2' style='height:155px ;cursor:pointer;' data-c1='rrrr' src= 'archivosland/".$aboutw2['idland']."".$aboutw2['foto']."' onerror=this.src='curso.png'>";
?>

		
		<footer class="footer-distributed">

			<div class="footer-left">

				<h3><?php echo $ff1['t1']?></h3>

				<p class="footer-links"><?php echo $ff1['t2']?>				</p>
				<p class="footer-company-name"><?php echo $ff1['t3']?></p>

<div style="margin:10px">
<img src="archivosland/<?php echo $aboutw2['idland']."".$aboutw2['foto']?>" onerror=this.src="curso.png" style="height:100px;border-radius:5px;" alt="">
</div>
			</div>


			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><?php echo $ff1['t4']?></p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p><?php echo $ff1['t5']?></p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="<?php echo $ff1['t6']?>"><?php echo $ff1['t6']?></a></p>
				</div>

			</div>

			<div class="footer-right">

					<h3></h3>
				<p style="color:white;font-size:15px"><?php echo $ff1['t7']?></p>

<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<!-- https://msng.link/o/?ricardo.mallquib=fm -->
				<div class="footer-icons">
				    <a target="_blank" href="<?php echo $ff1['t8']?>"><i class="fab fa-whatsapp"></i></a>
					<a target="_blank" href="<?php echo $ff1['t9']?>"><i class="fab fa-facebook-messenger"></i></a>
					<a target="_blank" href="<?php echo $ff1['t10']?>"><i class="fab fa-facebook"></i></a>
					<a target="_blank" href="<?php echo $ff1['t11']?>"><i class="fab fa-twitter"></i></a>
					<a target="_blank" rel="noopener noreferrer" href="<?php echo $ff1['t12']?>"><i class="fab fa-instagram"></i></a>
					<a target="_blank" href="<?php echo $ff1['t13']?>"><i class="fab fa-github"></i></a>
					<a target="_blank" href="<?php echo $ff1['t14']?>"><i class="fab fa-youtube"></i></a>
					<a target="_blank" href="<?php echo $ff1['t15']?>"><i class="fab fa-blogger"></i></a>

				</div>

			</div>

		</footer>



<style>
.ww{
margin-right:0px;  overflow: hidden;  position: fixed;  bottom: 0;  right:0;  z-index: 9999;# background: rgb(50,0,50); border-radius:5px;
}

