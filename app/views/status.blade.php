@extends('layouts.user')

@section('head')
	<link href="../css/jquery-ui.min.css" rel="stylesheet">
@stop


@section('content')
	{{ Form::open(array('route' => 'status.store', 'files' => true, 'class'=>'form-horizontal', 'role'=>'form')) }}
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10">
				<div class="col-sm-2">
					<label for="effectiveDate" class="col-sm-12 control-label input-sm">Effective Date</label>
				</div>
				<div class="col-sm-3">
					<label for="dateNeeded" class="col-sm-2 control-label input-sm">From</label>
					<div class="col-sm-10 @if ($errors->has('fromDate')) has-error @endif">
						<div class="input-group">
							{{ Form::text('fromDate', '', array('class' => 'form-control input-sm', 'id' => 'fromDate', 'readonly')) }}
							<span class="input-group-btn">
						 		<button type="button" class="btn btn-default input-sm" id="fromButton">
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								</button>
							 </span>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<label for="toDate" class="col-sm-2 control-label input-sm">To</label>
					<div class="col-sm-10 @if ($errors->has('toDate')) has-error @endif">
						<div class="input-group">
							{{ Form::text('toDate', '', array('class' => 'form-control input-sm', 'id' => 'toDate', 'readonly')) }}
					 		<span class="input-group-btn">
					 			<button type="button" class="btn btn-default input-sm" id="toButton">
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								</button>
							 </span>
						</div>
					</div>
				</div>
				<div class="col-sm-4">&nbsp;&nbsp;</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10">
				<div class="col-sm-2">
					<label for="documentType" class="col-sm-12 control-label input-sm">Document Type</label>
				</div>
				<div class="col-sm-4">
					<div class="col-sm-7 @if ($errors->has('documentType')) has-error @endif">
						{{ Form::select('documentType', array('' => '', 
      													'1' => 'QM', 
      													'2' => 'PM', 
      													'3' => 'SQ', 
      													'4' => 'QS', 
      													'5' => 'ML',
														'6' => 'WI',
														'7' => 'JD',
														'8' => 'FO',
														'9' => 'ST',
														'10' => 'CL',
														'11' => 'GD',
														'12' => 'TM',
														'13' => 'All'), null, array('class' => 'form-control input-sm')) }}
      				</div>			
				</div>
				<div class="col-sm-6">&nbsp;&nbsp;</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10">
				<div class="col-sm-2">
					<label for="documentType" class="col-sm-12 control-label input-sm">Request Type</label>
				</div>
				<div class="col-sm-4">
					<div class="col-sm-7 @if ($errors->has('documentType')) has-error @endif">
						{{ Form::select('requestType', array('' => '', 
      													'1' => 'New Document', 
      													'2' => 'Amendment', 
      													'3' => 'Deletion', 
      													'4' => 'Reproduction',
      													'5' => 'All'), null, array('class' => 'form-control input-sm')) }}
      				</div>			
				</div>
				<div class="col-sm-6">&nbsp;&nbsp;</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10">
				<div class="col-sm-5">&nbsp;&nbsp;</div>
				<div class="col-sm-1">
					{{ Form::submit('Submit', array('class' => 'btn btn-primary input-sm')) }}
				</div>
				<div class="col-sm-3">
					@if ($errors->has())
					<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						{{ $errors->first(); }}
					</div>
					@endif
				</div>
			</div>
			<div class="col-sm-3">&nbsp;&nbsp;</div>
		</div>
	{{Form::close()}}

<?php if(!empty($checkins)): ?>
@if(count($checkins) > 0)
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
									<div class="col-sm-4">Status</div>
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
				@foreach ($checkins as $checkin)
					<?php $c++; ?>
					<?php if(!empty($checkin->file)): ?>
						<?php $file = "upload/" . $checkin->id . "/" . $checkin->file; ?>
					<?php else: ?>
						<?php $file = ""; ?>
					<?php endif; ?>	
					<?php $requestDate = date('M j, Y', strtotime($checkin->requestdate)); ?>
					<?php $effectiveDate = date('M j, Y', strtotime($checkin->effectivedate)); ?>
					<?php $neededDate = date('M j, Y', strtotime($checkin->needdate)); ?>
					<div class="panel panel-info">
						<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion<?php echo $c; ?>" href="#collapse<?php echo $c; ?>">
						<div class="row">
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-4">{{ $checkin->id }}</div>
									<div class="col-sm-4">{{ $requestDate }}</div>
									<div class="col-sm-4">
										@if($checkin->status == 1)
											{{ "For Unit Head Approval" }}
										@elseif($checkin->status == 1.1)
											{{ "Disapproved By Unit Head" }}
										@elseif($checkin->status == 1.2)
											{{ "Voided By Unit Head" }}
										@elseif($checkin->status == 2)
											{{ "For QMR Approval" }}
										@elseif($checkin->status == 2.1)
											{{ "Disapproved By QMR" }}
										@elseif($checkin->status == 2.2)
											{{ "Voided By QMR" }}
										@elseif($checkin->status == 3)
											{{ "For Document Controller Approval" }}
										@elseif($checkin->status == 3.1)
											{{ "Disapproved By Document Controller" }}
										@elseif($checkin->status == 3.2)
											{{ "Voided By Document Controller" }}
										@elseif($checkin->status == 4)
											{{ "Approved Document" }}
										@else
											{{ "" }}
										@endif
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
											{{ "ML" }}
										@elseif($checkin->documenttype == 6)
											{{ "WI" }}
										@elseif($checkin->documenttype == 7)
											{{ "JD" }}
										@elseif($checkin->documenttype == 8)
											{{ "FO" }}
										@elseif($checkin->documenttype == 9)
											{{ "ST" }}
										@elseif($checkin->documenttype == 10)
											{{ "CL" }}
										@elseif($checkin->documenttype == 11)
											{{ "GD" }}
										@elseif($checkin->documenttype == 12)
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
										@elseif($checkin->requesttype == 4)
											{{ "Reproduction" }}
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
						<div id="collapse<?php echo $c; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								@include('layouts.note')
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>File</strong></small></p></div>
									<div class="col-sm-9">
										{{ Form::open(array('route' => 'status.store', 'files' => true, 'class'=>'form-horizontal', 'role'=>'form')) }}
											@if(File::exists($file) == 1)
												<button type="submit" name="fileButton" class="btn btn-info btn-xs">
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
							</div>
						</div>
					</div>
				@endforeach
			</div><!-- accordion -->
		</div>
		<div class="col-sm-1">&nbsp;&nbsp;</div>
	</div>
@else
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10"><small><h3>No Items Found.</h3></small></div>
	<div class="col-sm-1"></div>
</div>
@endif
<?php endif; ?>
@stop

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