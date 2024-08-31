<?php

namespace App\Http\Controllers;

use App\Models\DomainRule;
use App\Services\DomainRuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Classe DomainRuleController
 *
 * Controlador responsável por gerenciar as operações relacionadas às regras de domínio.
 */
class DomainRuleController extends Controller
{
    /**
     * @var DomainRuleService
     */
    protected $domainRuleService;

    /**
     * Construtor da classe DomainRuleController.
     *
     * @param DomainRuleService $domainRuleService
     */
    public function __construct(DomainRuleService $domainRuleService)
    {
        $this->domainRuleService = $domainRuleService;
    }

    /**
     * Exibe uma lista de regras de domínio.
     *
     * @param Request $request Objeto de requisição HTTP
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filters = $request->only(['rule_type', 'status']);
        $rules = $this->domainRuleService->getFilteredRules($filters);

        return view('domain-rules.index', compact('rules'));
    }

    /**
     * Mostra o formulário para criar uma nova regra de domínio.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('domain-rules.create');
    }

    /**
     * Armazena uma nova regra de domínio.
     *
     * @param Request $request Objeto de requisição HTTP
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        $this->domainRuleService->createRule($validatedData);

        return redirect()->route('domain-rules.index')->with('success', 'Regra criada com sucesso.');
    }

    /**
     * Mostra o formulário para editar uma regra de domínio.
     *
     * @param DomainRule $domainRule Instância da regra de domínio a ser editada
     * @return \Illuminate\View\View
     */
    public function edit(DomainRule $domainRule)
    {
        $this->authorize('update', $domainRule);

        return view('domain-rules.edit', compact('domainRule'));
    }

    /**
     * Atualiza uma regra de domínio existente.
     *
     * @param Request $request Objeto de requisição HTTP
     * @param DomainRule $domainRule Instância da regra de domínio a ser atualizada
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DomainRule $domainRule)
    {
        $this->authorize('update', $domainRule);

        $validatedData = $this->validateRequest($request, $domainRule->id);

        $this->domainRuleService->updateRule($domainRule, $validatedData);

        return redirect()->route('domain-rules.index')->with('success', 'Regra atualizada com sucesso.');
    }

    /**
     * Remove uma regra de domínio existente.
     *
     * @param DomainRule $domainRule Instância da regra de domínio a ser excluída
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DomainRule $domainRule)
    {
        $this->authorize('delete', $domainRule);

        $this->domainRuleService->deleteRule($domainRule);

        return redirect()->route('domain-rules.index')->with('success', 'Regra excluída com sucesso.');
    }

    /**
     * Valida os dados da requisição.
     *
     * @param Request $request
     * @param int|null $domainRuleId ID da regra de domínio para validação de exclusividade
     * @return array
     */
    private function validateRequest(Request $request, $domainRuleId = null)
    {
        return $request->validate([
            'domain' => [
                'required',
                'regex:/^((?!-))(xn--)?[a-z0-9][a-z0-9-]{0,61}[a-z0-9]{1,}\.(xn--)?([a-z]{2,}|d[0-9]{1,3})(?!-)$/i',
                'unique:domain_rules,domain,' . $domainRuleId . ',id,user_id,' . Auth::id()
            ],
            'rule_type' => 'required|in:allow,block',
            'status' => 'required|boolean',
            'priority' => 'required|integer',
            'description' => 'nullable|string|max:255'
        ], [
            'domain.required' => 'O campo domínio é obrigatório.',
            'domain.regex' => 'O domínio informado não é válido.',
            'domain.unique' => 'Este domínio já foi registrado para este usuário.',
            'rule_type.required' => 'O campo tipo de regra é obrigatório.',
            'status.required' => 'O campo status é obrigatório.',
            'priority.required' => 'O campo prioridade é obrigatório.',
        ]);
    }

    /**
     * Exibe uma regra de domínio específica.
     *
     * @param DomainRule $domainRule Instância da regra de domínio a ser exibida
     * @return \Illuminate\View\View
     */
    public function show(DomainRule $domainRule)
    {
        $this->authorize('view', $domainRule);

        return view('domain-rules.show', compact('domainRule'));
    }

}
