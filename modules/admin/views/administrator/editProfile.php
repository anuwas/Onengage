<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" media="screen" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">


	<script type="text/javascript">
	/* $(document).ready(function(){
	$('#submit').click(function(){
		var status=$('#administrator-active').val();
		if ($("#administrator-active:checked").length == 0){
		alert('Select Status'); 
		return false;  
		}
	 });
	}); */
</script>  	
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add/Edit Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Administrator</span></li>
								<li><span>Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					
					<!-- start: page -->
					<div class="row">
									<div class="col-sm-6">
										<!--<div class="mb-md">
											<a href="all_services.php" class="btn btn-primary">List of Blogs</a>
										</div>-->
                                        </div>
                                        
								</div>
					<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Add/Edit Profile</h2>
							</header>			
					<div class="row">
						
						<div class="col-md-12">
						<?php 
                    if($msg!='')
                    {
                    echo"<div class='alert alert-danger'>".$msg."!</div>";
                    
                    }?>
						<?php $form = ActiveForm::begin(); ?>
							<!-- <form role="form" name="frm" action="controller/con_update_profile.php" method="post" enctype="multipart/form-data" class="form-horizontal"> -->
								<section class="panel">
									<input name="cid" type="hidden" value="">
                                    
									<div class="panel-body">
                                    
										<div class="form-group">
											<label class="col-sm-2 control-label">Name<span class="required">*</span></label>
											<div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Enter Name" name="Administrator[name]" id="administrator-name" readonly="readonly" 
                                            value="<?php echo $model->name;?>">
											</div>
										</div>
                                        
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Email<span class="required">*</span></label>
											<div class="col-sm-8">
											<input type="text" class="form-control" placeholder="Enter Email" name="Administrator[email]" id="administrator-email" readonly="readonly" value="<?php echo $model->email;?>">
                                             
											</div>
										</div>
                                        
                                         
                                        <div class="form-group">
											<label class="col-sm-2 control-label">Old Password<span class="required">*</span></label>
											<div class="col-sm-8">
					<input type="password" class="form-control" placeholder="Enter Old Password" name="Administrator[oldpassword]" id="administrator-oldpassword" 
                         value="" required>
											</div>
										</div>
                                        
                                        <div class="form-group">
											<label class="col-sm-2 control-label">New Password<span class="required">*</span></label>
											<div class="col-sm-8">
					<input type="password" class="form-control" placeholder="Enter New Password" name="Administrator[newpassword]" id="administrator-newpassword"  value="" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Confirm Password<span class="required">*</span></label>
											<div class="col-sm-8">
					<input type="password" class="form-control" placeholder="Enter Confirm Password" name="Administrator[confirmpassword]" id="administrator-confirmpassword"  value="" required>
											</div>
										</div>
                                       
                                       
                                       <div class="form-group">
											<label class="col-sm-2 control-label">Status<span class="required">*</span></label>
											<div class="col-sm-10">
                                        	
                                            <label class="radio-inline">
                                                <input type="radio" name="Administrator[active]" id="administrator-active" value="1" checked>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Administrator[active]" id="administrator-active" value="0">Inactive
                                            </label>
											</div>
										</div>
									
                                       <div class="col-sm-9 col-sm-offset-2">
												<!--<button class="btn btn-primary">Submit</button>-->
												<input name="submit" id="submit" value="Submit" type="submit" class="btn btn-primary">
												<a href="<?php echo  Yii::$app->request->baseUrl;?>/admin" class="btn btn-primary">Cancel</a>
												<!-- <button type="reset" class="btn btn-default">Reset</button> -->
												
											</div>
									</div>
									
								</section>
							<?php ActiveForm::end(); ?>
						</div>
						<!-- col-md-6 -->
						
					</div>
					<div class="row">
						
						
					</div>
					<!-- end: page -->
				</section>

		<!-- Vendor -->
		
		
		<!-- Specific Page Vendor -->
		<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/jquery-validation/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/ckeditor/adapters/jquery.js"></script>

        <script type="text/javascript" src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/tinymce/js/tinymce/tinymce.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>
        <script type="text/javascript" src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/vendor/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>
		

		<!-- Examples -->
		<script src="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/javascripts/forms/examples.validation.js"></script>
	