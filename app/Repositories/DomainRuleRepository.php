<?php

namespace App\Repositories;

use App\Models\DomainRule;
use Illuminate\Support\Facades\Auth;

/**
 * Classe DomainRuleRepository
 *
 * Este repositório é responsável por encapsular todas as operações de banco de dados
 * relacionadas às regras de domínio.
 */
class DomainRuleRepository
{
    /**
     * Obtém todas as regras de domínio do usuário autenticado com filtros opcionais.
     *
     * @param array $filters Filtros opcionais para a consulta
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRules(array $filters = [], $perPage = 10)
    {
        $query = DomainRule::where('user_id', Auth::id());

        if (isset($filters['rule_type'])) {
            $query->where('rule_type', $filters['rule_type']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy('priority', 'desc')->paginate($perPage);
    }

    /**
     * Cria uma nova regra de domínio.
     *
     * @param array $data Dados da regra a serem criados
     * @return \App\Models\DomainRule
     */
    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return DomainRule::create($data);
    }

    /**
     * Atualiza uma regra de domínio existente.
     *
     * @param \App\Models\DomainRule $domainRule Instância da regra de domínio a ser atualizada
     * @param array $data Dados a serem atualizados
     * @return bool
     */
    public function update(DomainRule $domainRule, array $data)
    {
        return $domainRule->update($data);
    }

    /**
     * Exclui uma regra de domínio existente.
     *
     * @param \App\Models\DomainRule $domainRule Instância da regra de domínio a ser excluída
     * @return bool|null
     */
    public function delete(DomainRule $domainRule)
    {
        return $domainRule->delete();
    }
}
