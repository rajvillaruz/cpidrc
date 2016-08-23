@extends('layouts.user')

@section('head')
	<link href="../css/jquery-ui.min.css" rel="stylesheet">
@stop

@section('content')
	<?php if(!empty($user->firstname) && !empty($user->lastname)): ?>
		<?php $name = $user->firstname . " " . $user->lastname; ?>
	<?php endif; ?>
	<?php date_default_timezone_set("Asia/Manila"); ?>
	<?php $today = date("M j, Y g:ia"); ?>
	
	{{ Form::open(array('route' => 'checkin.store', 'files' => true, 'class'=>'form-horizontal', 'role'=>'form')) }}
		<div class="row">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10"><h4>Document Request for Control</h4></div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="requestedBy" class="col-sm-4 control-label input-sm">Requested By</label>
				<div class="col-sm-8">
					<p class="form-control-static input-sm"><em>{{ $name }}</em></p>
				</div>
			</div>
			<div class="col-sm-5">
				<label for="dateRequested" class="col-sm-4 control-label input-sm">Date Requested</label>
				<div class="col-sm-8">
					<p class="form-control-static input-sm"><em>{{ $today }}</em></p>
				</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="unit" class="col-sm-4 control-label input-sm">Unit<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('unit')) has-error @endif">
      					{{ Form::select('unit', $aUnit, null, array('class' => 'form-control input-sm')) }}
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-5">&nbsp;&nbsp;</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="documentType" class="col-sm-4 control-label input-sm">Type of Document<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('documentType')) has-error @endif">							
						{{ Form::select('documentType', $aDocType, null, array('class' => 'form-control input-sm')) }}								
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-5">&nbsp;&nbsp;</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>	
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="requestType" id='requestType' class="col-sm-4 control-label input-sm">Type of Request<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('requestType')) has-error @endif">
						{{ Form::select('requestType', array('' => '', 
      												'1' => 'New Document', 
      												'2' => 'Amendment', 
      												'3' => 'Deletion'), null, array('class' => 'form-control input-sm')) }}
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-5">&nbsp;&nbsp;</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-10"><h4>Document Information</h4></div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="documentCode" class="col-sm-4 control-label input-sm">Document Code<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('documentCode')) has-error @endif">
						{{ Form::text('documentCode', '', array('class' => 'form-control input-sm')) }}
					</div>
					<div class="col-sm-4">
						<button type="button" class="btn btn-default input-sm" data-toggle="tooltip" data-placement="right" title="Code as per CPI ISO standard e.g. TM-SM-SD-22">
							<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<label for="documentName" class="col-sm-4 control-label input-sm">Document Title<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('documentName')) has-error @endif">
						{{ Form::text('documentName', '', array('class' => 'form-control input-sm')) }}
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="issueNo" class="col-sm-4 control-label input-sm"> Revision No<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('issueNo')) has-error @endif">
						{{ Form::text('issueNo', '', array('class' => 'form-control input-sm')) }}
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<label for="effectiveDate" class="col-sm-4 control-label input-sm">Effective Date<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8 @if ($errors->has('effectiveDate')) has-error @endif">
						<div class="input-group">
							{{ Form::text('effectiveDate', '', array('class' => 'form-control input-sm', 'id' => 'effectiveDate', 'readonly')) }}
						 	<span class="input-group-btn">
						 		<button type="button" class="btn btn-default input-sm" id="edButton">
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								</button>
							 </span>
								
						</div>
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5">
				<label for="cpiarNo" class="col-sm-4 control-label input-sm">CPIAR No</label>
				<div class="col-sm-8">
					<div class="col-sm-8">
						{{ Form::text('cpiarNo', '', array('class' => 'form-control input-sm', 'placeholder' => 'If Applicable')) }}
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<label for="file" class="col-sm-4 control-label input-sm" >File<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-8">
							{{ Form::file('file', array('class' => 'form-control input-sm')) }}
					</div>
					<div class="col-sm-4">&nbsp;&nbsp;</div>
				</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1">&nbsp;&nbsp;</div>
			<div class="col-sm-5 ">
				<label for="reason" class="col-sm-4 control-label input-sm">Reason for Request<font color="red">*</font></label>
				<div class="col-sm-8">
					<div class="col-sm-12 @if ($errors->has('reason')) has-error @endif">
						{{ Form::textarea('reason', '', array('class' => 'form-control input-sm', 'rows' => '3', 'style' => 'resize:none')) }}
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="col-sm-2">{{ Form::submit('Submit', array('class' => 'btn btn-primary input-sm')) }}</div>
				<div class="col-sm-10">
					@if ($errors->has())
					<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						{{ $errors->first(); }}
					</div>
					@endif
					@if (Session::has('error'))
					<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						{{ Session::get('error') }}
					</div>	
					@endif
					@if (Session::has('message'))
					<div class="alert alert-success" role="alert">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						{{ Session::get('message') }}
					</div>
					@endif		
				</div>
			</div>
			<div class="col-sm-1">&nbsp;&nbsp;</div>
		</div>
		<div class="form-group">
			<div class="col-sm-1"></div>
			<div class="col-sm-5"><label for="requiredFields" class="col-sm-4 control-label input-sm"><font color="red">* Required fields </font></label></div>
			<div class="col-sm-6">
			<label for="documentName" class="col-sm-8 control-label input-sm">FO-BR-MG-08 Rev03, 09042015</label></div>
			</div>
		</div>
	{{ Form::close() }}	
@stop

@section('script')
	<script src="../js/jquery-ui.min.js"></script>
	<script>
		$(function() {
			$( "#effectiveDate" ).datepicker({
			minDate: 1,
			beforeShowDay: $.datepicker.noWeekends
			});
			
			$('#edButton').click(function() {
				$('#effectiveDate').datepicker('show');
			});
		});	
	</script>
@stop



