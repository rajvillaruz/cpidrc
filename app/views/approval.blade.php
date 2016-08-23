@extends('layouts.user')

@section('content')
	<div class="row">
		<div class="col-sm-1">&nbsp;&nbsp;</div>
		<div class="col-sm-10">
			<div class="panel-group" id="accordion">
				<div class="panel panel-default" >
					<div class="panel-heading">
						<div class="row">
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-4">Tracking Number</div>
									<div class="col-sm-4">Date Requested</div>
									<div class="col-sm-4">Requested By</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="row">
									<div class="col-sm-5">Type Of Document</div>
									<div class="col-sm-5">Type Of Request</div>
									<div class="col-sm-2">&nbsp;&nbsp;</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $c = 0; ?>
				@if(Session::has('checker'))
					<?php $checker = Session::get('checker'); ?>
				@else
					<?php $checker = 0; ?>
				@endif
				@foreach ($checkins as $checkin)
					<?php $c++; ?>
					<?php if(!empty($checkin->file)): ?>
						<?php $file = "upload/" . $checkin->id . "/" .  $checkin->file; ?>
					<?php else: ?>
						<?php $file = ""; ?>
					<?php endif; ?>	
					<?php $requestDate = date('M j, Y', strtotime($checkin->requestdate)); ?>
					<?php $effectiveDate = date('M j, Y', strtotime($checkin->effectivedate)); ?>
					@if($checkin->id == $checker)
						<?php $class = "panel panel-danger"; ?>
						<?php $collapse = "in"; ?>
					@else
						<?php $class = "panel panel-info"; ?>
						<?php $collapse = ""; ?>
					@endif
					<div class="{{ $class }}">
						<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion<?php echo $c; ?>" href="#collapse<?php echo $c; ?>">
						<div class="row">
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-4">{{ $checkin->id }}</div>
									<div class="col-sm-4">{{ $requestDate }}</div>
									<div class="col-sm-4">
										@foreach ($users as $vUser)
											@if ($vUser->id == $checkin->requestby)
												{{ $vUser->firstname . " " . $vUser->lastname }}
											@endif
										@endforeach
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="row">
									<div class="col-sm-5">
										@if($checkin->documenttype == 1)
											{{ "QM" }}
										@elseif($checkin->documenttype == 2)
											{{ "PM" }}
										@elseif($checkin->documenttype == 3)
											{{ "SQ" }}
										@elseif($checkin->documenttype == 4)
											{{ "QS" }}
										@elseif($checkin->documenttype == 5)
											{{ "QS" }}
										@elseif($checkin->documenttype === 6)
											{{ "WI" }}
										@elseif($checkin->documenttype === 7)
											{{ "JD" }}
										@elseif($checkin->documenttype === 8)
											{{ "FO" }}
										@elseif($checkin->documenttype === 9)
											{{ "ST" }}
										@elseif($checkin->documenttype === 10)
											{{ "CL" }}
										@elseif($checkin->documenttype === 11)
											{{ "GD" }}
										@elseif($checkin->documenttype === 12)
											{{ "TM" }}
										@else
											{{ "" }}
										@endif
									</div>
									<div class="col-sm-5">
										@if($checkin->requesttype == 1)
											{{ "New Document" }}
										@elseif($checkin->requesttype == 2)
											{{ "Amendment" }}
										@elseif($checkin->requesttype == 3)
											{{ "Deletion" }}
										@else
											{{ "" }}
										@endif
									</div>
									<div class="col-sm-2"><span class="glyphicon glyphicon-chevron-down"></span></div>
								</div>
							</div>
						</div>
						</a>
					</div>
						<div id="collapse<?php echo $c; ?>" class="panel-collapse collapse <?php echo $collapse; ?>">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Status</strong></small></p></div>
									<div class="col-sm-9">
										<small>
											@if($checkin->status == 1)
												{{ "For Unit Head Approval" }}
											@elseif($checkin->status == 2)
												{{ "For QMR Approval" }}
											@elseif($checkin->status == 3)
												{{ "For Document Controller Approval" }}
											@elseif($checkin->status == 4)
												{{ "For DRC Approver Approval" }}
											@elseif($checkin->status == 5)
												{{ "For DRC Administrator Approval" }}
											@else
												{{ "" }}
											@endif
										</small>
									</div>
								</div>
								@include('layouts.note')
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>File</strong></small></p></div>
									<div class="col-sm-9">							
										{{ Form::open(array('route' => 'approval.store', 'files' => true, 'class'=>'form-horizontal', 'role'=>'form')) }}
											@if(File::exists($file) == 1)
												<button type="submit" class="btn btn-info btn-xs">
													<span class="glyphicon glyphicon-download"></span> {{ $checkin->file }}
												</button>
												{{ Form::hidden('id', $checkin->id) }}
												{{ Form::hidden('file', $checkin->file) }}
											@else
												<small>No File Attached.</small>
												
											@endif
										{{ Form::close() }}
									</div>
								</div>
								<div class="row">
									{{ Form::open(array('method' => 'PATCH', 'route' => array('approval.update', $checkin->id), 'class'=>'form-horizontal', 'role'=>'form')) }}
										{{ Form::hidden('requestType', $checkin->requesttype) }}
										<div class="form-group">
											<div class="col-sm-2"></div>
											<div class="col-sm-10">
												<div class="checkbox input-sm">
													@if($checkin->status == 3)
														@if($checkin->requesttype == 1)
															<label>
																<input type="checkbox" name="checkbox1" value="1">
																Upload ISO Document
															</label>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="checkbox2" value="1">
																Update Master List of Documents
															</label>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="checkbox3" value="1">
																Inform unit that document has been approved and available in our google sites.
															</label>
														@endif
														@if($checkin->requesttype == 2)
															<label>
																<input type="checkbox" name="checkbox1" value="1">
																Upload ISO Document
															</label>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="checkbox2" value="1">
																Remove old document and transfer to obsolete folder
															</label>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="checkbox3" value="1">
																Update Master List of Documents
															</label>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="checkbox4" value="1">
																Inform unit that document has been approved and available in our google sites.
															</label>
														@endif
														@if($checkin->requesttype == 3)
															<label>
																<input type="checkbox" name="checkbox1" value="1">
																Update Master List of Documents
															</label>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="checkbox2" value="1">
																Inform unit that document has been deleted in our google sites.
															</label>
														@endif
													@endif
												</div>
											</div>
										</div>	
										<div class="form-group">
											<div class="col-sm-2"><p class="text-right"><small><strong>Note</strong></small></p></div>
											<div class="col-sm-6 @if ($errors->has('note' . $checkin['id'])) has-error @endif">
												{{ Form::textarea('note' . $checkin['id'], '', array('class' => 'form-control input-sm', 'rows' => '1', 'style' => 'resize:none')) }}
											</div>
											<div class="col-sm-2 @if ($errors->has('status' . $checkin['id'])) has-error @endif">
												{{ Form::select('status' . $checkin['id'], array('' => '', 
      												'1' => 'Approve', 
      												'0.1' => 'Disapprove', 
      												'0.2' => 'Void'), null, array('class' => 'form-control input-sm')) }}
											</div>
											<div class="col-sm-2">{{ Form::submit('Submit', array('class' => 'btn btn-primary input-sm')) }}</div>
										</div>
									{{ Form::close() }}	
								</div>
								<div class="row">
									<div class="col-sm-2"></div>
									<div class="col-sm-6"></div>
									<div class="col-sm-4">
										@if($checker ==  $checkin->id)
											@if($errors->has())
												<div class="alert alert-danger" role="alert">
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
													<span class="sr-only">Error:</span>
													{{ $errors->first(); }}
												</div>
											@endif
										@endif
									</div>
								</div>
								<div class="row">
									<div class="col-sm-8"></div>
									<div class="col-sm-4"><p class="text-right">FO-BR-MG-08 Rev03, 09042015</p></div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div><!-- accordion -->
		</div>
		<div class="col-sm-1">&nbsp;&nbsp;</div>
	</div>	
	@section('script')
	<script src="../js/jquery-ui.min.js"></script>
	<script>
		$(function()
		{
			$("#toDate").datepicker();
			$("#fromDate").datepicker().bind("change",function() {
				var minValue = $(this).val();
				minValue = $.datepicker.parseDate("mm/dd/yy", minValue);
				minValue.setDate(minValue.getDate()+1);
				$("#toDate").datepicker( "option", "minDate", minValue );
			});
			$('#fromButton').click(function() {
				$('#fromDate').datepicker('show');
			});
			$('#toButton').click(function() {
				$('#toDate').datepicker('show');
			});	
		});
	</script>
	@stop
@stop

