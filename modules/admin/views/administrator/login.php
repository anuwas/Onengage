<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="body-sign">
       
			<div class="center-sign">
				<a href="../admin" class="logo pull-left">
				<img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>images/logo.png" width="358" height="70" alt="Dalmia">
				</a>
				

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
					<?php 
                    if(isset($msg)=='Invalid')
                    {
                    echo"<div class='alert alert-danger'>Please check your Email and Password!</div>";
                    
                    }
                    ?>
						<?php $form = ActiveForm::begin(); ?>
							<div class="form-group mb-lg">
								<label>Email Address</label>
								<div class="input-group input-group-icon">
								   <input name="Administrator[email]" id="administrator-email" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>				
                                           </span>			
                                          </span>							
                                         </div>
						                </div>


							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<!--<a href="pages-recover-password.html" class="pull-right">Lost Password?</a>-->
								</div>
								<div class="input-group input-group-icon">
									<input name="Administrator[password]" id="administrator-password" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>	<span>				
                                            		</span>						
                                            		</div>
						  </div>
							<div class="row">
								<div class="col-sm-8">
									<!--<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
									<label for="RememberMe">Remember Me</label>
									</div>-->
										
								</div>
								<div class="col-sm-4 text-right">
                                
									<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
						  </div>
							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or
                                </span>	
                               </span>
					    <?php ActiveForm::end(); ?>
                        
					</div>
				</div>
                <div class="alert alert-info" style="padding:1px;background-color:#D82936;">
				<p class="text-center text-muted mt-md mb-md">&copy;<b>Copyright 2016. All Rights Reserved.</b></p>
                </div>
			</div>
		</section>