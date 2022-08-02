<?php include("header1.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="collapse navbar-collapse navbar-ex1-collapse sks-po">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"> Makeup </a>
                    <ul id="submenu-1" class="collapse">
                        <li><a data-toggle="collapse" data-target="#subbmenu-2" href="#"> Eyes</a>
                        	<ul id="subbmenu-2" class="collapse">
		                        <li>
		                           <div class="form-check">
                                      <label for="flexCheckIndeterminate">Kajal</label>
                                      <input class="form-check-input child" type="checkbox" name="childcategory" id="childcategory" value="1">
                                   </div>
		                        </li>
		                        <li>
		                           <div class="form-check">
                                      <label for="flexCheckIndeterminate">Kajal 1</label>
                                      <input class="form-check-input child" type="checkbox" name="childcategory" id="childcategory" value="1">
                                   </div>
		                        </li>
		                        <li>
		                           <div class="form-check">
                                      <label for="flexCheckIndeterminate">Kajal 2</label>
                                      <input class="form-check-input child" type="checkbox" name="childcategory" id="childcategory" value="1">
                                   </div>
		                        </li>
		                    </ul>
                        </li>
                        <li><a href="#"> Face</a></li>
                        <li><a href="#"> Lips</a></li>
                        <li><a href="#"> Tools & Brushes</a></li>
                        <li><a href="#"> Top Brands</a></li>
                        <li><a href="#"> Quick Links</a></li>
                        <li><a href="#"> Body Art</a></li>
                    </ul>
                </li>
            </ul>
        </div>
		</div>	
	</div>
</div>

<?php include("footer1.php"); ?>

<style type="text/css">
	/* Side Navigation */

@media(min-width:768px) {
    /*.side-nav {
        top: 60px;
        left: 225px;
        width: 225px;
        margin-left: -225px;
        border: none;
        border-radius: 0;
        border-top: 1px rgba(0,0,0,.5) solid;
        overflow-y: auto;
        background-color: #222;
        bottom: 0;
        overflow-x: hidden;
        padding-bottom: 40px;
    }*/

    .side-nav>li>a {
        width: 225px;
        border-bottom: 1px rgba(0,0,0,.3) solid;
    }

}

.side-nav>li>ul {
    padding: 0;
    border-bottom: 1px rgba(0,0,0,.3) solid;
}

.side-nav>li>ul>li>a {
    display: block;
    padding: 10px 0px;
    text-decoration: none;
    color: #999;   
}

/*.side-nav>li>ul>li>a:hover {
    color: #fff;
}*/

.navbar .nav > li > a > .label {
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  position: absolute;
  top: 14px;
  right: 6px;
  font-size: 10px;
  font-weight: normal;
  min-width: 15px;
  min-height: 15px;
  line-height: 1.0em;
  text-align: center;
  padding: 2px;
}

.navbar .nav > li > a:hover > .label {
  top: 10px;
}

.navbar-brand {
    padding: 5px 15px;
}
.sks-po ul li a:after {
	content: "\f107";
    font-family: FontAwesome;
    float: right;
    margin-right: 6px;
    line-height: 12px;
}
.sks-po ul li {
	list-style-type: none;

}
.sks-po ul li a {
	padding: 10px 0px;
}
.sks-po ul li ul li ul {
	padding: 0px;
}
.sks-po ul li ul li ul li {
	padding: 5px 0px;
	border-bottom: 1px solid #ddd	
}
.sks-po ul li ul li ul li .form-check-input {
	    float: right;
    margin-right: 6px;
}
</style>

<script type="text/javascript">
	$(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $(".side-nav .collapse").on("hide.bs.collapse", function() {                   
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
    });
    $('.side-nav .collapse').on("show.bs.collapse", function() {                        
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");        
    });
})    
    
</script>