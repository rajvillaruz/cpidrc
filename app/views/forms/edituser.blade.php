<table class="table table-striped">
	<thead>
		<th>Username</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th class="text-center">Active</th>
		<th class="text-center">Admin</th>
		<th class="text-center">UH</th>
		<th class="text-center">QMR</th>
		<th class="text-center">DC</th>
		<th>&nbsp;&nbsp;</th>
	</thead>
	<tbody>
		<!-- Section added by Rochelle Villaruz -->
		@if($errors->has())
			@if( Session::get('edit') == 1)
				@include('forms.message')
			@endif
		@endif
		<!-- End of Section -->
		@foreach($aUsers as $aUser)
			{{ Form::open(array('method' => 'PATCH', 'route' => array('maintenance.update', $aUser->id), 'class'=>'form-horizontal', 'role'=>'form')) }}
				{{ Form::hidden('action', 'editUser') }}
				<tr>
					<td>{{ $aUser->username }}</td>
					<td>
						{{ Form::text('updateFirstName', $aUser->firstname, array('class' => 'form-control input-sm')) }}
					</td>
					<td>
						{{ Form::text('updateLastName', $aUser->lastname, array('class' => 'form-control input-sm')) }}
					</td>
					<td>
						{{ Form::text('updateEmail', $aUser->email, array('class' => 'form-control input-sm')) }}
					</td>
					<?php $status = ''; ?>
					<?php if($aUser->status == 1): ?>
						<?php $status = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('uPrivileges[]', 'status', $status) }}</td>
					<?php $admin = ''; ?>
					<?php if($aUser->user == 1): ?>
						<?php $admin = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('uPrivileges[]', 'admin', $admin) }}</td>
					<?php $uh = ''; ?>
					<?php if($aUser->unithead == 1): ?>
						<?php $uh = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('uPrivileges[]', 'unitHead', $uh) }}</td>
					<?php $qmr = ''; ?>
					<?php if($aUser->qmr == 1): ?>
						<?php $qmr = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('uPrivileges[]', 'qmr', $qmr) }}</td>
					<?php $dc = ''; ?>
					<?php if($aUser->dcon == 1): ?>
						<?php $dc = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('uPrivileges[]', 'dc', $dc) }}</td>
					<td>
						<button type="submit" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</button
					</td>	
				</tr>
			{{ Form::close() }}
		@endforeach
	</tbody>
	<tfoot>
		<th>Username</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Active</th>
		<th>Admin</th>
		<th>UH</th>
		<th>QMR</th>
		<th>DC</th>
		<th>&nbsp;&nbsp;</th>
	</tfoot>
	
</table>
