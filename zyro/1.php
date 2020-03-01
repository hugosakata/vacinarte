<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Home</title>
	<base href="{{base_url}}" />
			<meta name="viewport" content="width=1200" />
		<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!-- Facebook Open Graph -->
	<meta property="og:title" content="Home" />
	<meta property="og:description" content="" />
	<meta property="og:image" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{curr_url}}" />
	<!-- Facebook Open Graph end -->
		
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/main.js?v=20190120113454" type="text/javascript"></script>

	<link href="css/font-awesome/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
	<link href="css/site.css?v=20190120113454" rel="stylesheet" type="text/css" />
	<link href="css/common.css?ts=1583009795" rel="stylesheet" type="text/css" />
	<link href="css/1.css?ts=1583009795" rel="stylesheet" type="text/css" />
	<ga-code/>
	<script type="text/javascript">
	window.useTrailingSlashes = true;
</script>
	
	<link href="css/flag-icon-css/css/flag-icon.min.css" rel="stylesheet" type="text/css" />	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->

	</head>


<body><div class="root"><div class="vbox wb_container" id="wb_header">
	
<div class="wb_cont_inner"></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_main">
	
<div class="wb_cont_inner"><div id="wb_element_instance1" class="wb_element wb_text_element" style=" line-height: normal;"><h4 class="wb-stl-pagetitle">Vacinarte</h4></div><div id="wb_element_instance2" class="wb_element" style="width: 100%;">
			<?php
				global $show_comments;
				if (isset($show_comments) && $show_comments) {
					renderComments(1);
			?>
			<script type="text/javascript">
				$(function() {
					var block = $("#wb_element_instance2");
					var comments = block.children(".wb_comments").eq(0);
					var contentBlock = $("#wb_main");
					contentBlock.height(contentBlock.height() + comments.height());
				});
			</script>
			<?php
				} else {
			?>
			<script type="text/javascript">
				$(function() {
					$("#wb_element_instance2").hide();
				});
			</script>
			<?php
				}
			?>
			</div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_footer">
	
<div class="wb_cont_inner" style="height: 280px;"><div id="wb_element_instance0" class="wb_element"><form class="wb_form" method="post" enctype="multipart/form-data"><input type="hidden" name="wb_form_id" value="48a8d4b5"><textarea name="message" rows="3" cols="20" class="hpc"></textarea><table><tr><th>Login&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_0" value="Login"><input class="form-control form-field" type="text" value="" name="wb_input_0" required="required"></td></tr><tr><th>Senha&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_1" value="Senha"><input class="form-control form-field" type="text" value="" name="wb_input_1" required="required"></td></tr><tr class="form-footer"><td colspan="2"><button type="submit" class="btn btn-default">Entrar</button></td></tr></table></form><script type="text/javascript">
			<?php $wb_form_id = popSessionOrGlobalVar("wb_form_id"); if ($wb_form_id == "48a8d4b5") { ?>
				var formValues = <?php echo json_encode(popSessionOrGlobalVar("post")); ?>;
				var formErrors = <?php echo json_encode(popSessionOrGlobalVar("formErrors")); ?>;
				wb_form_validateForm("48a8d4b5", formValues, formErrors);
				<?php $wb_form_send_success = popSessionOrGlobalVar("wb_form_send_success");
				if (($wb_form_send_state = popSessionOrGlobalVar("wb_form_send_state"))) { ?>
					var prompt = $("<div>")
						.addClass("alert alert-<?php echo $wb_form_send_success ? "success" : "danger"; ?>")
						.css({ position: "fixed", opacity: 0, right: "-50px", top: "10px", zIndex: 10000, fontSize: "24px",
							   padding: "30px 50px", lineHeight: "24px", maxWidth: "748px" })
						.append("<?php echo str_replace('"', '\"', $wb_form_send_state); ?>")
						.prepend($("<button>").addClass("close")
							.css({ marginRight: "-40px", marginTop: "-24px" })
							.html("&nbsp;&times;")
							.on("click", function() { $(this).parent().remove(); })
						)
					.appendTo("body");
					setTimeout(function() { prompt.animate({ opacity: 1, right: "10px" }, 250); }, 250);
					<?php $wb_form_send_success = false; $wb_form_send_state = null; ?>
				<?php } ?>
			<?php } ?>
			</script></div><div id="wb_element_instance3" class="wb_element" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
			$(function() {
				var footer = $(".wb_footer");
				var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
				if (!html) {
					footer.parent().remove();
					footer = $("#wb_footer, #wb_footer .wb_cont_inner");
					footer.css({height: ""});
				}
			});
			</script></div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div><div class="wb_sbg"></div></div>{{hr_out}}</body>
</html>
