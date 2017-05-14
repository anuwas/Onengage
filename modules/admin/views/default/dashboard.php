				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
                      <div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="#">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
							<a class="sidebar-right-toggle" data-open="#"></i></a>
						</div>
					</header>
					<!-- start: page -->
                    <!-- User Profile Start -->
						<section class="panel">
							<header class="panel-heading">
							<h2 class="panel-title">Admin Profile</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
									  <tr>
                                        <th width="20%">Name</th>
                                        <th width="20%">Status</th>
                                        <th width="20%">Created On</th>
                                        <th width="20%">Action</th>
                                      </tr>
									</thead>
									<tbody>

		<?php 
        /* $sql_cat = "SELECT * FROM admin_master WHERE status='Active' ORDER BY admin_id";
        $sql_ext = mysql_query($sql_cat) or die("Please check the information you have input");
        while($sql_cat_result=mysql_fetch_array($sql_ext)) {
		$id = $sql_cat_result['admin_id'];
        $name = $sql_cat_result['name'];
        $status = $sql_cat_result['status'];
        $add_on = $sql_cat_result['add_on']; */
        ?>

                                <tr class="odd gradeX">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="edit_profile.php?cid=">EDIT</a></td>
                                </tr>
                                <?php //} ?>
                                 </tbody>
								</table>
								<div class="row">
								 <div class="col-sm-6">
								<!--<div class="lb-ld"><a href="#">VIEW ALL</a></div>-->
                                    </div>
								</div>
							</div>
						</section>
				    <!-- User Profile END -->
                        <br>
                         <!-- AboutUS Panel Start -->
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
								<h2 class="panel-title">About US Panel</h2>
							</header>
							<div class="panel-body">
								<!--<div class="row">
								 <div class="col-sm-6">
								   <div class="mb-md">
									    <a href="edit_profile.php" class="btn btn-primary">Add New User <i class="fa fa-plus"></i></a>
								       </div>
                                      </div>
								     </div>-->
								<table class="table table-bordered table-striped mb-none" id="">
									<thead>
									  <tr>
                                        <th width="40%">About Website</th>
                                        <th width="50%">About Brijesh Dalmia</th>
                                        <th width="10%">Action</th>
                                      </tr>
									</thead>
									<tbody>

		<?php 
        /* $sql_cat = "SELECT * FROM content_master WHERE content_id='2' AND status='Yes'";
        $sql_ext = mysql_query($sql_cat) or die("Please check the information you have input");
        while($sql_cat_result=mysql_fetch_array($sql_ext)) {
		$id = $sql_cat_result['content_id']; */
        ?>

                               <tr class="odd gradeX">
                                <td></td>
                                <td></td>
                                <td><a href="update_aboutus.php?cid=">EDIT</a></td>
                               </tr>
                                <?php //} ?>
                                 </tbody>
								</table>
								<div class="row">
								 <div class="col-sm-6">
								<!--<div class="lb-ld"><a href="#">VIEW ALL</a></div>-->
                                    </div>
								</div>
							</div>
						</section>
				    <!-- AboutUS Panel END -->
                    <br>
                      <!-- PaymentInformation Panel Start -->
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
								<h2 class="panel-title">Payment Information Panel</h2>
							</header>
							<div class="panel-body">
								<!--<div class="row">
								 <div class="col-sm-6">
								   <div class="mb-md">
									    <a href="edit_profile.php" class="btn btn-primary">Add New User <i class="fa fa-plus"></i></a>
								       </div>
                                      </div>
								     </div>-->
								<table class="table table-bordered table-striped mb-none" id="">
									<thead>
									  <tr>
                                        <th width="13%">Name</th>
                                        <th width="20%">Account No.</th>
                                        <th width="20%">Bank</th>
                                        <th width="20%">Branch</th>
                                        <th width="20%">IFSC Code</th>
                                        <th width="10%">Action</th>
                                      </tr>
									</thead>
									<tbody>
		<?php 
        /* $sql_cat = "SELECT * FROM content_master WHERE content_id='3' AND status='Yes'";
        $sql_ext = mysql_query($sql_cat) or die("Please check the information you have input");
        while($sql_cat_result=mysql_fetch_array($sql_ext)) {
		$id = $sql_cat_result['content_id'];
        $status = $sql_cat_result['status']; */
        ?>
                               <tr class="odd gradeX">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                 <td></td>
                                <td><a href="update_paymentdetail.php?cid=">EDIT</a></td>
                               </tr>
                                <?php //} ?>
                                 </tbody>
								</table>
								<div class="row">
								 <div class="col-sm-6">
								<!--<div class="lb-ld"><a href="#">VIEW ALL</a></div>-->
                                    </div>
								</div>
							</div>
						</section>
				    <!-- PaymentInformation Panel END -->
                    <br>   
                     <!-- Footer Panel Start -->
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
								<h2 class="panel-title">Footer Panel</h2>
							</header>
							<div class="panel-body">
								<!--<div class="row">
								 <div class="col-sm-6">
								   <div class="mb-md">
									    <a href="edit_profile.php" class="btn btn-primary">Add New User <i class="fa fa-plus"></i></a>
								       </div>
                                      </div>
								     </div>-->
								<table class="table table-bordered table-striped mb-none" id="">
									<thead>
									  <tr>
                                        <th width="13%">Contact Phone</th>
                                        <th width="20%">Company Email</th>
                                        <th width="20%">Company Website</th>
                                        <th width="20%">Company Name</th>
                                        <th width="10%">Action</th>
                                      </tr>
									</thead>
									<tbody>

		<?php 
       /*  $sql_cat = "SELECT * FROM content_master WHERE content_id='1' AND status='Yes'";
        $sql_ext = mysql_query($sql_cat) or die("Please check the information you have input");
        while($sql_cat_result=mysql_fetch_array($sql_ext)) {
		$id = $sql_cat_result['content_id'];
        $status = $sql_cat_result['status']; */
        ?>

                               <tr class="odd gradeX">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="add_new_content.php?cid=">EDIT</a></td>
                               </tr>
                                <?php //} ?>
                                 </tbody>
								</table>
								<div class="row">
								 <div class="col-sm-6">
								<!--<div class="lb-ld"><a href="#">VIEW ALL</a></div>-->
                                    </div>
								</div>
							</div>
						</section>
				    <!-- Footer Panel END -->
                     <br>   
                <!-- end: page -->
				</section>
			
		
		
		
		
		<div id="dialog" class="modal-block mfp-hide">
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">Are you sure?</h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
						<div class="modal-text">
							<p>Are you sure that you want to delete this row?</p>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button id="dialogConfirm" class="btn btn-primary">Confirm</button>
							<button id="dialogCancel" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</footer>
			</section>
		</div>