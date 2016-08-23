@extends('layouts.user')

@section('content')
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
				@foreach ($checkins as $checkin)
					<?php $c++; ?>
					<?php if(!empty($checkin->file)): ?>
						<?php $file = "public/upload/" .  $checkin->file; ?>
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
											{{ $checkin->otherdocument }}
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
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Status</strong></small></p></div>
									<div class="col-sm-9">
										<small>
											@if($checkin->status == 1)
												{{ "For DRC Administrator Approval" }}
											@elseif($checkin->status == 1.1)
												{{ "Disapproved By DRC Administrator" }}
											@elseif($checkin->status == 1.2)
												{{ "Voided By DRC Administrator" }}
											@elseif($checkin->status == 2)
												{{ "For Unit Head Approval" }}
											@elseif($checkin->status == 2.1)
												{{ "Disapproved By Unit Head" }}
											@elseif($checkin->status == 2.2)
												{{ "Voided By Unit Head" }}
											@elseif($checkin->status == 3)
												{{ "For Execom Approval" }}
											@elseif($checkin->status == 3.1)
												{{ "Disapproved By Execom" }}
											@elseif($checkin->status == 3.2)
												{{ "Voided By Execom" }}
											@elseif($checkin->status == 4)
												{{ "For DRC Approver Approval" }}
											@elseif($checkin->status == 4.1)
												{{ "Disapproved By DRC Approver" }}
											@elseif($checkin->status == 4.2)
												{{ "Voided By DRC Approver" }}
											@elseif($checkin->status == 5)
												{{ "For DRC Administrator Approval" }}
											@elseif($checkin->status == 5.1)
												{{ "Disapproved By DRC Administrator" }}
											@elseif($checkin->status == 5.2)
												{{ "Voided By DRC Administrator" }}
											@elseif($checkin->status == 6)
												{{ "Process Completed" }}
											@else
												{{ "" }}
											@endif
										</small>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Date Needed</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($neededDate, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Position</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($checkin->position, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Unit</strong></small></p></div>
									<div class="col-sm-9">
										<small>
											@if($checkin->unit == 1)
												{{ "Training and IT" }}
											@elseif($checkin->unit == 2)
												{{ "Business Development" }}
											@elseif($checkin->unit == 3)
												{{ "HR" }}
											@elseif($checkin->unit == 4)
												{{ "Finance" }}
											@elseif($checkin->unit == 5)
												{{ "Service Delivery" }}
											@elseif($checkin->unit == 6)
												{{ "Special Projects" }}
											@else
												{{ "" }}
											@endif
										</small>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Document Code</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($checkin->documentcode, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Document Name</small></strong></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($checkin->documentname, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Issue/Revision No</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($checkin->issueno, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Effective Date</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($effectiveDate, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>CPIAR No</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($checkin->cpiarno, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<div class="row">
									<div class="col-sm-2"><p class="text-right"><small><strong>Reason for Request</strong></small></p></div>
									<div class="col-sm-9"><small>{{ wordwrap($checkin->reason, 100, "<br />\n", TRUE) }}</small></div>
								</div>
								<?php if(!empty($checkin->dadmidinit) && !empty($checkin->dadmnoteinit)): ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>DRC Administrator Note</strong></small></p></div>
										<div class="col-sm-9"><small>{{ wordwrap($checkin->dadmnoteinit, 100, "<br />\n", TRUE) }}</small></div>
									</div>
								<?php endif; ?>
								<?php if(!empty($checkin->uhid) && !empty($checkin->uhnote)): ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>Unit Head Note</strong></small></p></div>
										<div class="col-sm-9"><small>{{ wordwrap($checkin->uhnote, 100, "<br />\n", TRUE) }}</small></div>
									</div>
								<?php endif; ?>	
								<?php if(!empty($checkin->ecid) && !empty($checkin->ecnote)): ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>EXEcom Note</strong></small></p></div>
										<div class="col-sm-9"><small>{{ wordwrap($checkin->ecnote, 100, "<br />\n", TRUE) }}</small></div>
									</div>
								<?php endif; ?>	
								<?php if(!empty($checkin->dappid) && !empty($checkin->dappnote)): ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>DRC Approver Note</strong></small></p></div>
										<div class="col-sm-9"><small>{{ wordwrap($checkin->dappnote, 100, "<br />\n", TRUE) }}</small></div>
									</div>
								<?php endif; ?>
								<?php if(!empty($checkin->dadmid) && !empty($checkin->dadmnote)): ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>DRC Administrator Note</strong></small></p></div>
										<div class="col-sm-9"><small>{{ wordwrap($checkin->dadmnote, 100, "<br />\n", TRUE) }}</small></div>
									</div>
								<?php endif; ?>
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