@extends('layouts.app')

@section('content')
<div class="container text-white bg-dark p-3">
    <div class="row">
        <div class="col text-center">
            <h3 style="font-size: 2.15rem;">Regras de Domínios</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-10">
        </div>
        <div class="col-2 text-right">
            <a href="{{ route('domain-rules.create') }}" class="btn btn-primary mb-3">Criar Nova Regra</a>
        </div>
    </div>

    <form method="GET" action="{{ route('domain-rules.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col-md-2">
                <label for="rule_type">Tipo de Regra</label>
                <select name="rule_type" id="rule_type" class="form-control">
                    <option value="">Todos</option>
                    <option value="allow">Permitir</option>
                    <option value="block">Bloquear</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <table class="table text-white">
        <thead>
            <tr>
                <th class="col-1">#</th>
                <th class="col-3">Domínio</th>
                <th class="col-2">Tipo</th>
                <th class="col-1">Status</th>
                <th class="col-2">Prioridade</th>
                <th class="col-3">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rules as $rule)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $rule->domain }}</td>
                <td>{{ $rule->rule_type == 'allow' ? 'Permitir' : 'Bloquear' }}</td>
                <td>{{ $rule->status ? 'Ativo' : 'Inativo' }}</td>
                <td>{{ $rule->priority }}</td>
                <td>
                    <a href="{{ route('domain-rules.show', $rule->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('domain-rules.edit', $rule->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('domain-rules.destroy', $rule->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Links de Paginação -->
    <div class="d-flex justify-content-center">
        {{ $rules->links() }}
    </div>
</div>
@endsection
