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
								<?php if(!empty($checkin->uhid) && !empty($checkin->uhnote)): ?>
									<?php $uhdate = date('M j, Y', strtotime($checkin->uhdate)); ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>Unit Head Note</strong></small></p></div>
										<div class="col-sm-9">
											<small>
												{{ wordwrap($checkin->uhnote, 100, "<br />\n", TRUE) }}
												<br />
												<small>
													@foreach ($users as $vUser)
														@if($checkin->uhid == $vUser->id)
															— {{ $vUser->firstname . " " . $vUser->lastname }}
														@endif
													@endforeach
													, {{$uhdate}}
												</small>
											</small>
										</div>
									</div>
								<?php endif; ?>	
								<?php if(!empty($checkin->uhid) && empty($checkin->uhnote)): ?>
									<?php $uhdate = date('M j, Y', strtotime($checkin->uhdate)); ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>Unit Head Note</strong></small></p></div>
										<div class="col-sm-9">
											<small>
												<small>
													@foreach ($users as $vUser)
														@if($checkin->uhid == $vUser->id)
															— {{ $vUser->firstname . " " . $vUser->lastname }}
														@endif
													@endforeach
													, {{$uhdate}}
												</small>
											</small>
										</div>
									</div>								
								<?php endif; ?>				
								<?php if(!empty($checkin->qmrid) && !empty($checkin->qmrnote)): ?>
									<?php $qmrdate = date('M j, Y', strtotime($checkin->qmrdate)); ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>QMR Note</strong></small></p></div>
										<div class="col-sm-9">
											<small>
												{{ wordwrap($checkin->qmrnote, 100, "<br />\n", TRUE) }}
												<br />
												<small>
													@foreach ($users as $vUser)
														@if($checkin->qmrid == $vUser->id)
															— {{ $vUser->firstname . " " . $vUser->lastname }}
														@endif
													@endforeach
													, {{$qmrdate}}
												</small>
											</small>
										</div>
									</div>
								<?php endif; ?>
								<?php if(!empty($checkin->qmrid) && empty($checkin->qmrnote)): ?>
									<?php $qmrdate = date('M j, Y', strtotime($checkin->qmrdate)); ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>QMR Note</strong></small></p></div>
										<div class="col-sm-9">
											<small>
												<small>
													@foreach ($users as $vUser)
														@if($checkin->qmrid == $vUser->id)
															— {{ $vUser->firstname . " " . $vUser->lastname }}
														@endif
													@endforeach
													, {{$qmrdate}}
												</small>
											</small>
										</div>
									</div>
								<?php endif; ?>		
								<?php if(!empty($checkin->dconid) && !empty($checkin->dconnote)): ?>
									<?php $dcondate = date('M j, Y', strtotime($checkin->dcondate)); ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>Document Controller Note</strong></small></p></div>
										<div class="col-sm-9">
											<small>
												{{ wordwrap($checkin->dconnote, 100, "<br />\n", TRUE) }}
												<br />
												<small>
													@foreach ($users as $vUser)
														@if($checkin->dconid == $vUser->id)
															— {{ $vUser->firstname . " " . $vUser->lastname }}
														@endif
													@endforeach
													, {{$dcondate}}
												</small>
											</small>
										</div>
									</div>
								<?php endif; ?>
								<?php if(!empty($checkin->dconid) && empty($checkin->dconnote)): ?>
									<?php $dcondate = date('M j, Y', strtotime($checkin->dcondate)); ?>
									<div class="row">
										<div class="col-sm-2"><p class="text-right"><small><strong>Document Controller Note</strong></small></p></div>
										<div class="col-sm-9">
											<small>
												<small>
													@foreach ($users as $vUser)
														@if($checkin->dconid == $vUser->id)
															— {{ $vUser->firstname . " " . $vUser->lastname }}
														@endif
													@endforeach
													, {{$dcondate}}
												</small>
											</small>
										</div>
									</div>
								<?php endif; ?>