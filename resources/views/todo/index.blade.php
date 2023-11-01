@extends('layout.app')
@section('contents')

	<div class="container-fluid my-4" >
		<div class="card shadow" style="min-height:90vh ">
			<div class="card-header">
                Lista de Tareas
				<a href="{{ route('todo.create') }}" class="btn btn-sm btn-dark float-right">Agregar nueva</a>
				<button
					data-url="{{ route('todo.destroy.bulk') }}"
					class="btn btn-sm btn-danger mx-1 float-right deleteRequest--bulk
					" style="display: none;">Borrar Seleccionados</button>
				<button
					data-url="{{ route('todo.edit.bulk') }}"
					class="btn btn-sm btn-outline-info mx-1 float-right editRequest--bulk
					" style="display: none;">Editar Status/Prioridad de Seleccionados</button>
			</div>
			<div class="card-body ">

				@unless ($todos->count())
					<div class="alert alert-danger">No se han encontrado tareas :(</div>
				@endunless

		    	<div class="row todoCards">

		    		@foreach ($todos as $key => $todo)
					<div class="col-lg-4 col-md-6  ">

						<div class="card shadow mb-4">
				  			<div class="card-header">
				  				{{ $todo->name }}

								<span class="badge float-right rounded-4 badge-dark">{{--{{ $todo->status }}--}}
                                {{--imprimir un icono de color segun el valor del estado--}}
                                @if($todo->status == 2)
                                    <i class="fas fa-exclamation-triangle text-warning"></i>
                                @elseif($todo->status == 1)
                                    <i class="fas fa-spinner text-info"></i>
                                @elseif($todo->status == 0)
                                    <i class="fas fa-check-circle text-success"></i>
                                @endif
                                </span>
				  				<span class="badge float-right rounded-0 badge-info mx-1">{{ $todo->priority }}</span>

				  			</div>
					  		<div class="card-body">
			  					<table class="table  text-muted table-sm table-borderless">
			  						{{--si el tiempo es negativo, poner en rojo, si es menos de 3 dias amarillo y si es mas verde--}}
                                    <tr
                                        @if($todo->status != 0)
                                        class=" {{ $todo->due_date->isPast() ? 'text-white bg-danger' : ($todo->due_date->diffInDays() < 3 ? 'text-dark bg-warning' : 'bg-success text-dark') }}"
                                    ><td>Tiempo Restante: </td> <td>{{ $todo->due_date->diffForHumans() }}</td><tr>
                                @else
                                    class="text-success">
                                            <td>Tiempo Restante: </td> <td>Entregado :)</td><tr>
                                        @endif
			  						<tr><td>Fecha de entrega: </td> <td>{{ $todo->due_date->format('Y-m-d') }}</td><tr>
			  						<tr><td>Autor: </td> <td>{{ $todo->author }}</td><tr>
			  						<tr><td>Creado el: </td> <td>{{ $todo->created_at }}</td><tr>
			  						<tr><td>Actualizado el: </td> <td>{{ $todo->updated_at }}</td><tr>
                                    <tr><td>Cantidad de Subtareas: </td> <td>{{ $todo->items->count() }}</td></tr>
			  					</table>

					  		</div>
					  		<div class="card-footer p-1">
					  			<span class="border px-2 py-1 text-muted">
					  				<input type="checkbox" id="cp{{ $todo->id }}" value="{{ $todo->id }}" class="mx-2">
					  			<label for="cp{{ $todo->id }}">Seleccionar</label>
					  			</span>
					  			<button
						  				data-url="{{ route('todo.destroy',$todo->id) }}"
						  				class="btn btn-sm deleteRequest--btn btn-outline-danger mx-1 float-right "
						  			>Borrar</button>

						  			<a
						  				href="{{ route('todo.edit',$todo->id) }}"
						  				class="btn btn-sm btn-outline-info float-right"
						  			>Editar</a>
					  		</div>
				  		</div>

					</div>
		    		@endforeach

				</div>

			</div>
		</div>
	</div>
@include('modals.edit-bulk')
@endsection
