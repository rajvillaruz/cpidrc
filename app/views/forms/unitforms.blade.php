<div class="panel panel-info">
	<div class="panel-heading">Add Unit</div>
	<div class="panel-body">
		{{ Form::open(array('route' => 'maintenance.store', 'class'=>'form-horizontal', 'role'=>'form')) }}
			{{ Form::hidden('action', 'addUnit') }}
			<div class="form-group">
				{{ Form::label('unitName', 'Name', array('class' => 'col-sm-3 control-label input-sm')) }}
				<div class="col-sm-9 @if ($errors->has('unitName')) has-error @endif">
					{{ Form::text('unitName', '', array('class' => 'form-control input-sm')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('unitDesc', 'Description', array('class' => 'col-sm-3 control-label input-sm')) }}
				<div class="col-sm-9 @if ($errors->has('unitDesc')) has-error @endif">
					{{ Form::text('unitDesc', '', array('class' => 'form-control input-sm')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 text-center">
					{{ Form::submit('Add Unit', array('class' => 'btn btn-primary input-sm')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div>		

<table class="table table-striped">
	<thead>
		<th>Name</th>
		<th>Description</th>
		<th class="text-center">Active</th>
		<th>&nbsp;&nbsp;</th>
	</thead>
	<tbody>
		@foreach($aUnit as $unit)
			{{ Form::open(array('method' => 'PATCH', 'route' => array('maintenance.update', $unit->id), 'class'=>'form-horizontal', 'role'=>'form')) }}
				{{ Form::hidden('action', 'editUnit') }}
				<tr>
					<td>{{ $unit->name }}</td>
					<td>{{ $unit->description }}</td>
					<?php $status = ''; ?>
					<?php if($unit->status == 1): ?>
						<?php $status = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('unitStatus', '1', $status) }}</td>
					<td>
						<button type="submit" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</button
					</td>
				</tr>
			{{ Form::close() }}
		@endforeach
	</tbody>
</table>