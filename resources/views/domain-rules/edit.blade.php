@extends('layouts.app')

@section('content')
<div class="container bg-dark p-4 text-white">
    <div class="row">
        <div class="col text-center">
            <h3 style="font-size: 2.15rem;">Editar Regra de Domínio</h3>
        </div>
    </div>

    <form action="{{ route('domain-rules.update', $domainRule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="domain">Domínio</label>
            <input type="text" name="domain" id="domain" class="form-control border @error('domain') is-invalid @enderror" value="{{ old('domain', $domainRule->domain) }}" required>
            @error('domain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Agrupar campos em uma linha com borda em cada campo -->
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="rule_type">Tipo de Regra</label>
                <select name="rule_type" id="rule_type" class="form-control border @error('rule_type') is-invalid @enderror">
                    <option value="allow" {{ old('rule_type', $domainRule->rule_type) == 'allow' ? 'selected' : '' }}>Permitir</option>
                    <option value="block" {{ old('rule_type', $domainRule->rule_type) == 'block' ? 'selected' : '' }}>Bloquear</option>
                </select>
                @error('rule_type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control border @error('status') is-invalid @enderror">
                    <option value="1" {{ old('status', $domainRule->status) == '1' ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('status', $domainRule->status) == '0' ? 'selected' : '' }}>Inativo</option>
                </select>
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="priority">Prioridade</label>
                <input type="number" name="priority" id="priority" class="form-control border @error('priority') is-invalid @enderror" value="{{ old('priority', $domainRule->priority) }}" required>
                @error('priority')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Descrição (Opcional)</label>
            <textarea name="description" id="description" class="form-control border @error('description') is-invalid @enderror">{{ old('description', $domainRule->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('domain-rules.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
