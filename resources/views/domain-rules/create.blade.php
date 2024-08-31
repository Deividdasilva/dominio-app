@extends('layouts.app')

@section('content')
<div class="container bg-dark p-4 text-white">
    <div class="row">
        <div class="col text-center">
            <h3 style="font-size: 2.15rem;">Criar Nova Regra de Domínio</h3>
        </div>
    </div>

    <form action="{{ route('domain-rules.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="domain">Domínio</label>
            <input type="text" name="domain" id="domain" class="form-control @error('domain') is-invalid @enderror" value="{{ old('domain') }}" placeholder="Digite o domínio">

            @error('domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <div class="form-row mb-3"> <!-- Adicionado margem abaixo dos campos na mesma linha -->
            <div class="col-md-4">
                <label for="rule_type">Tipo de Regra</label>
                <select name="rule_type" id="rule_type" class="form-control">
                    <option value="allow">Permitir</option>
                    <option value="block">Bloquear</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="priority">Prioridade</label>
                <input type="number" name="priority" id="priority" class="form-control" value="{{ old('priority') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Descrição (Opcional)</label>
            <textarea name="description" id="description" class="form-control mb-3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('domain-rules.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

{{-- <script>
    document.getElementById('domain').addEventListener('input', function() {
        const domainRegex = /^((?!-))(xn--)?[a-z0-9][a-z0-9-]{0,61}[a-z0-9]{1,}\.(xn--)?([a-z]{2,}|d[0-9]{1,3})(?!-)$/i;
        const domainInput = this;
        const errorMessage = document.querySelector('.invalid-feedback');

        if (!domainRegex.test(domainInput.value)) {
            domainInput.classList.add('is-invalid');
            errorMessage.textContent = 'O domínio informado não é válido.';
        } else {
            domainInput.classList.remove('is-invalid');
            errorMessage.textContent = '';
        }
    });
    </script> --}}

