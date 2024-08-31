<?php

namespace App\Services;

use App\Repositories\DomainRuleRepository;
use App\Models\DomainRule;

/**
 * Classe DomainRuleService
 *
 * Este serviço é responsável por encapsular a lógica de negócio relacionada às regras de domínio.
 */
class DomainRuleService
{
    /**
     * @var DomainRuleRepository
     */
    protected $domainRuleRepository;

    /**
     * Construtor da classe DomainRuleService.
     *
     * @param DomainRuleRepository $domainRuleRepository
     */
    public function __construct(DomainRuleRepository $domainRuleRepository)
    {
        $this->domainRuleRepository = $domainRuleRepository;
    }

    /**
     * Obtém as regras de domínio filtradas com base nos parâmetros fornecidos.
     *
     * @param array $filters Filtros opcionais para a consulta
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFilteredRules(array $filters = [])
    {
        return $this->domainRuleRepository->getRules($filters, 5);
    }

    /**
     * Cria uma nova regra de domínio.
     *
     * @param array $data Dados validados para criar uma nova regra
     * @return \App\Models\DomainRule
     */
    public function createRule(array $data)
    {
        return $this->domainRuleRepository->create($data);
    }

    /**
     * Atualiza uma regra de domínio existente.
     *
     * @param \App\Models\DomainRule $domainRule Instância da regra de domínio a ser atualizada
     * @param array $data Dados validados para atualização
     * @return bool
     */
    public function updateRule(DomainRule $domainRule, array $data)
    {
        return $this->domainRuleRepository->update($domainRule, $data);
    }

    /**
     * Exclui uma regra de domínio existente.
     *
     * @param \App\Models\DomainRule $domainRule Instância da regra de domínio a ser excluída
     * @return bool|null
     */
    public function deleteRule(DomainRule $domainRule)
    {
        return $this->domainRuleRepository->delete($domainRule);
    }

}
