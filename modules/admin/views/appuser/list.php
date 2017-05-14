<?php
/* @var $this yii\web\View */
?>

<section role="main" class="content-body">
					<header class="page-header">
						<h2>List of Merchant</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Merchant</span></li>
								<li><span>Listing</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="#"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">List of All Merchant</h2>
							</header>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<a href="#" class="btn btn-primary">Add Merchant <i class="fa fa-plus"></i></a>
										</div>
                                        </div>
                                        
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th width="20%">Type</th>
                                            <th width="20%">Name</th>
                                            <th width="15%">Email</th>
                                            <th width="25%">Phone</th>
                                            <th width="25%">Username</th>
                                            <th width="15%">Action</th>
                                      </tr>
									</thead>
									<tbody>
                                     <?php foreach ($model as $values){?>
                                     <tr class="odd gradeX">
                                     		<td><?php echo ucfirst($values->user_type);?></td>
                                            <td><?php echo $values->name;?></td>
                                            <td><?php echo $values->email;?></td>
                                           	<td><?php echo $values->mobile;?></td>
                                           	<td><?php echo $values->username;?></td>
                                <td>
                                </td>
                                      </tr>
                                    <?php } ?>
                                    </tbody>
                                    
								</table>
								
								
							</div>
						</section>
						
					<!-- end: page -->
				</section>