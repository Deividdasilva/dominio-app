@extends('layouts.app')

@section('content')
<div class="container bg-dark p-4 text-white">
    <div class="row">
        <div class="col text-center">
            <h3 style="font-size: 2.15rem;">Detalhes da Regra de Domínio</h3>
        </div>
    </div>

    <!-- Usando card do Bootstrap com estilo escuro e bordas arredondadas -->
    <div class="card bg-secondary text-white mt-3 rounded" style="border-radius: 5px;"> <!-- Raio personalizado -->
        <div class="card-body">
            <h5 class="card-title">Domínio: {{ $domainRule->domain }}</h5>
            <p class="card-text"><strong>Tipo de Regra:</strong> {{ $domainRule->rule_type == 'allow' ? 'Permitir' : 'Bloquear' }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $domainRule->status ? 'Ativo' : 'Inativo' }}</p>
            <p class="card-text"><strong>Prioridade:</strong> {{ $domainRule->priority }}</p>
            <p class="card-text"><strong>Descrição:</strong> {{ $domainRule->description }}</p>
            <div class="btn-group mt-3" role="group" aria-label="Basic example" style="gap: 10px;">
                <a href="{{ route('domain-rules.index') }}" class="btn btn-primary rounded">Voltar</a>
                <a href="{{ route('domain-rules.edit', $domainRule->id) }}" class="btn btn-warning rounded">Editar</a>
                <form action="{{ route('domain-rules.destroy', $domainRule->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
