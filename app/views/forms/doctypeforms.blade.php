<div class="panel panel-info">
	<div class="panel-heading">Add Type of Document</div>
	<div class="panel-body">
		{{ Form::open(array('route' => 'maintenance.store', 'class'=>'form-horizontal', 'role'=>'form')) }}
			{{ Form::hidden('action', 'addDocType') }}
			<div class="form-group">
				{{ Form::label('docTypeName', 'Name', array('class' => 'col-sm-3 control-label input-sm')) }}
				<div class="col-sm-9 @if ($errors->has('docTypeName')) has-error @endif">
					{{ Form::text('docTypeName', '', array('class' => 'form-control input-sm')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('docTypeDesc', 'Description', array('class' => 'col-sm-3 control-label input-sm')) }}
				<div class="col-sm-9 @if ($errors->has('docTypeDesc')) has-error @endif">
					{{ Form::text('docTypeDesc', '', array('class' => 'form-control input-sm')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 text-center">
					{{ Form::submit('Add', array('class' => 'btn btn-primary input-sm')) }}
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
		@foreach($aDocType as $docType)
			{{ Form::open(array('method' => 'PATCH', 'route' => array('maintenance.update', $docType->id), 'class'=>'form-horizontal', 'role'=>'form')) }}
				{{ Form::hidden('action', 'editDocType') }}
				<tr>
					<td>{{ $docType->name }}</td>
					<td>{{ $docType->description }}</td>
					<?php $status = ''; ?>
					<?php if($docType->status == 1): ?>
						<?php $status = 'checked'; ?>
					<?php endif; ?>
					<td class="text-center">{{ Form::checkbox('docTypeStatus', '1', $status) }}</td>
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