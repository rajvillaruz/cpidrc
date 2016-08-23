@extends('layouts.user')

<!-- Section added by Rochelle Villaruz -->
@if($errors->has())
@if( Session::get('edit') == 1)
@section('script')
		<script>
			$(document).ready(function(){
				$('#updateUserModal').modal("show");
			});
		</script>
@stop
@endif
@endif
<!-- End of Section -->

@section('content')
	<div class="row">
		<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-4">
						<div class="panel panel-info">
							<div class="panel-body">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#unitModal"> Unit </button>
								
								<!-- Modal -->
								<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Unit</h4>
											</div>
											<div class="modal-body">
												@include('forms.unitforms')
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<br/>
								
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#typeDocModal"> Type of Document </button>
								
								<!-- Modal -->
								<div class="modal fade" id="typeDocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Type of Document</h4>
											</div>
											<div class="modal-body">
												@include('forms.doctypeforms')
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<br/>
								
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#defaultModal"> Defaults </button>
								
								<!-- Modal -->
								<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Defaults</h4>
											</div>
											<div class="modal-body">
												???
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<br/>

								<!-- Button trigger modal -->
								<button type="button" id="btnupdateuser" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#updateUserModal" > Users </button>
								
								<!-- Modal -->
								<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Update User</h4>
											</div>
											<div class="modal-body">
												@include('forms.edituser')
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
																
							</div>
						</div>
						@include('forms.message')
					</div>
					<div class="col-sm-8">
						<div class="panel panel-info">
							<div class="panel-heading">Create User</div>
							<div class="panel-body">
								@include('forms.createuser')
							</div>
						</div>		
					</div>
				</div>	
			</div>
		<div class="col-sm-1">&nbsp;&nbsp;</div>
	</div>
@stop


