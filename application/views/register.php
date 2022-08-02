<?php $this->load->view("header"); ?>



<div class="container-fluid llg1-wp">
	<div class="container">
		<div class="row">
			<div class="col-md-4" style="margin-left:30%">
				<div class="log-scn-dv">
					<div class="hdrp">
						<h4>REGISTER</h4>
					</div>
					<div class="lgn-bbdy">
						<p class="rgst-nmbr">register to earn <span>2000 Reward Points! </span></p>
						<div id='res'></div>
						<form id="frm1">
							<div class="form-group">
								<input type="text" name="name" class="form-control ssgn-s4" placeholder="Name" required>
								<span class="message" id="msgname"></span>
							</div>
							<div class="form-group">
								<input type="tel" name="mobile" class="form-control ssgn-s4" placeholder="Phone Number" required>
								<span class="message" id="msgmobile"></span>
							</div>
							
							<div class="form-group">
								<input type="text" name="emailreg" class="form-control ssgn-s4" placeholder="Email" required value="<?php echo $this->session->userdata('email');?>">
								<span class="message" id="msgemailreg"></span>
							</div>
							
							<div class="input-group form-group">
					          <input type="password" class="form-control pwd sks-pwd" name = "password" value="iamapassword" required>
					          <span class="input-group-btn">
					            <button class="btn sk-pwd-shw reveal" type="button">show</button>
					          </span> 
					          <span class="message" id="msgpassword"></span>
					        </div>
							<div class="form-group">
								<input type="button" class="but-lgn-sbs" id="isValidateRegistor" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("footer.php"); ?>

<script>



$(document).on('click','#isValidateRegistor', function() {
	if (isValidateRegistor()) {
		var frm = $("#frm1").serialize();
		alert(frm);
		$.ajax({
			url :'<?=base_url("home/registeruser")?>',
			data : frm,
			type : 'POST',
			success : function(result) {
			    $('#res').html(result);
			    /*if(result){
			        $('#mainlogin').show();
			        $('#registeruser').hide();
			    }*/
			    
				location.reload();
			}
		});
	}
});	

function isValidateRegistor() {

	var valid = true;
	var name = $("input[name='name']").val();
	var mobile = $("input[name='mobile']").val();
	var password = $("input[name='password']").val();

	$(".message").html("&nbsp;");
	$(".message").css("color", "red");
	$(".message").css("font-size", "12px");
	$(".message").hide();
    
    if (name.length == 0 ) {
		valid = false;
		$("#msgname").html("Enter valid name");
		$("#msgname").show();
	}
	
	if (mobile.length == 0 ) {
		valid = false;
		$("#msgmobile").html("Enter 10 digit no");
		$("#msgmobile").show();
	}
	
	if (password == 0 ) {
		valid = false;
		$("#msgpassword").html("Enter valid password");
		$("#msgpassword").show();
	}
    

	return valid;
}


</script>

<style type="text/css">
	.lgdvi2 {
		height: 50vh;
	}
	.llg1-wp {
		background-color: #f7f7f7;
		margin: 20px 0;
	}
	.log-scn-dv {
		background-color: #fff;
	    box-shadow: 0 0 9px 2px rgb(20 23 28 / 10%), 0 3px 1px 0 rgb(20 23 28 / 10%);
	    padding: 15px;
	    border-radius: 20px;
    	border: 1px solid #ddd;
	}
	.hdrp h3 {
		color: #001325;
	    padding-bottom: 0.25rem;
	    font-family: 'Source Sans Pro', sans-serif;
	    font-weight: bold;
	    text-transform: uppercase;
	}
	.hdrp p {
		 font-size: 17px;
	}
	.lgn-bbdy {
		border-top: 1px solid #3333336b;
    	padding-top: 10px;
	}
	.lgn-bbdy img {
		margin: 20px 0px;
	}
	.ssgn-s1 {
		background-color: #f91e6a;
	    color: #fff;
	    padding: 22px;
	    width: 100%;
	    border: none;
	    font-family: 'Roboto', sans-serif;
	    font-size: 17px;
	    text-align: center;
	}
	.ssgn-s1::placeholder {
		color: #fff;
	}
	.lgn-ggls {
		width: 100%;
	    border: 1px solid #ddd;
	    padding: 7px;
	    font-family: 'Roboto', sans-serif;
	    font-size: 17px;
	    color: #999;
	    text-transform: capitalize;
	    font-weight: bold;
	    letter-spacing: 1px;
	}
	.fa-google {
		background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
	    -webkit-background-clip: text;
	    background-clip: text;
	    color: transparent;
	    -webkit-text-fill-color: transparent;
	}
	.lgp-pp {
		margin: 30px 0;
	}
	.lgp-pp p {
		font-size: 16px;
	}


	.hdrp h4 {
		    color: #001325;
	    padding-bottom: 0.25rem;
	    font-family: 'Source Sans Pro', sans-serif;
	    text-transform: uppercase;
	    text-align: center;
	}
	.ssgn-s2 {
		background-color: #f7f7f7;
	    padding: 19px;
	    text-align: center;
	    font-size: 17px;
	    font-family: 'Roboto', sans-serif;
	    border: 1px solid #f03;
	}
	.but-lgn-sbs {
		width: 100%;
	    padding: 8px;
	    text-transform: uppercase;
	    background-color: #f91e6a;
	    border: none;
	    color: #fff;
	    font-size: 17px;
	    border-radius: 3px;
	    margin-top: 90px;
	}
	.otps-lble {
		text-align: center;
    	margin: 30px 0;
	}
	.otps-lble p {
		font-family: 'Roboto', sans-serif;
	    text-align: center;
	    font-size: 15px;
	    font-weight: normal;
	}
	.enr-otp {
		border: none;
	    border-bottom: 1px solid #ddd;
	    box-shadow: none;
	    border-radius: 0;
	    width: 60%;
	    display: inline-block;
	}
	.ottps label a {
		text-transform: uppercase;
    	color: #f91e6a;
	}
	.ssgn-s3 {
		background-color: #f7f7f7;
	    padding: 19px;
	    text-align: center;
	    font-size: 17px;
	    font-family: 'Roboto', sans-serif;
	}
	.ottps p {
		text-align: center;
	    font-size: 16px;
	    color: #777;
	}
	.rgst-nmbr {
		text-align: center;
	    font-size: 16px;
	    padding: 9px;
	    margin-bottom: 30px;
	    text-transform: capitalize;
	}
	.rgst-nmbr span {
		    color: #f91e6a;
	}
	.ssgn-s4 {
		border: none;
	    box-shadow: none;
	    border-radius: 0px;
	    border-bottom: 1px solid #ddd;
	    font-family: 'Roboto', sans-serif;
	}
	.sks-pwd {
		border: none;
	    box-shadow: none;
	    border-radius: 0px;
	    border-bottom: 1px solid #ddd;
	}
	.sk-pwd-shw {
		background-color: #fff0;
	    text-transform: uppercase;
	    font-family: 'Roboto', sans-serif;
	}
	.lgn-nmbr {
		background-color: #f91e6a;
	    color: #fff;
	    text-align: center;
	    width: 100%;
	    padding: 9px;
	    font-size: 16px;
	    margin: 15px 0;
	}
</style>


<script type="text/javascript">
	$(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>