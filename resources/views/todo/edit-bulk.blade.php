<form action="{{ route('todo.edit.bulk.submit') }}" class="appForm">
@csrf
@method('PUT')
<div class="row">
	@foreach ($todos as $todo)
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">{{ $todo->name }}</div>
				<div class="card-body">
					<div class="form-group">
						<label>Estado</label>
                        <select name="status[{{ $todo->id }}]" class="form-control form-control-sm">
                            <option value="2" {{ $todo->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="1" {{ $todo->status == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="0" {{ $todo->status == 'Completado' ? 'selected' : '' }}>Completado</option>
                        </select>
					</div>
					<div class="form-group">
						<label>Prioridad</label>
						<input type="number" min="1" name="priority[{{ $todo->id }}]" class="form-control form-control-sm"  value="{{ $todo->priority }}">
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<div class="col-12 my-2 appForm--response"></div>
	<div class="col-12">
		<button class="btn btn-dark btn-submit appForm--submit btn-sm float-right">Actualizar</button>
	</div>
</div>

</form>
