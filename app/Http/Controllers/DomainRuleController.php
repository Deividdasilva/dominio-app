<?php

namespace App\Http\Controllers;

use App\Models\DomainRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainRuleController extends Controller
{
    public function index(Request $request)
    {
        $query = DomainRule::where('user_id', Auth::id());

        if ($request->filled('rule_type')) {
            $query->where('rule_type', $request->input('rule_type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $rules = $query->orderBy('priority', 'desc')->get();

        return view('domain-rules.index', compact('rules'));
    }

    public function create()
    {
        return view('domain-rules.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'domain' => 'required|unique:domain_rules,domain,NULL,id,user_id,' . Auth::id(),
    //         'rule_type' => 'required|in:allow,block',
    //         'status' => 'required|boolean',
    //         'priority' => 'required|integer',
    //     ]);

    //     $data = $request->all();
    //     $data['user_id'] = Auth::id();

    //     DomainRule::create($data);

    //     return redirect()->route('domain-rules.index')->with('success', 'Regra criada com sucesso.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'domain' => [
                'required',
                'regex:/^((?!-))(xn--)?[a-z0-9][a-z0-9-]{0,61}[a-z0-9]{1,}\.(xn--)?([a-z]{2,}|d[0-9]{1,3})(?!-)$/i', // Regex para validar domínio
                'unique:domain_rules,domain,NULL,id,user_id,' . Auth::id() // Validação de unicidade por usuário
            ],
            'rule_type' => 'required|in:allow,block',
            'status' => 'required|boolean',
            'priority' => 'required|integer',
        ], [
            'domain.required' => 'O campo domínio é obrigatório.',
            'domain.regex' => 'O domínio informado não é válido.',
            'domain.unique' => 'Este domínio já foi registrado para este usuário.',
            'rule_type.required' => 'O campo tipo de regra é obrigatório.',
            'status.required' => 'O campo status é obrigatório.',
            'priority.required' => 'O campo prioridade é obrigatório.',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        DomainRule::create($data);

        return redirect()->route('domain-rules.index')->with('success', 'Regra criada com sucesso.');
    }

    public function show(DomainRule $domainRule)
    {
        $this->authorize('view', $domainRule);

        return view('domain-rules.show', compact('domainRule'));
    }

    public function edit(DomainRule $domainRule)
    {
        $this->authorize('update', $domainRule);

        return view('domain-rules.edit', compact('domainRule'));
    }

    // public function update(Request $request, DomainRule $domainRule)
    // {
    //     $this->authorize('update', $domainRule);

    //     $request->validate([
    //         'domain' => 'required|unique:domain_rules,domain,' . $domainRule->id . ',id,user_id,' . Auth::id(),
    //         'rule_type' => 'required|in:allow,block',
    //         'status' => 'required|boolean',
    //         'priority' => 'required|integer',
    //     ]);

    //     $domainRule->update($request->all());

    //     return redirect()->route('domain-rules.index')->with('success', 'Regra atualizada com sucesso.');
    // }

    public function update(Request $request, DomainRule $domainRule)
    {
        $this->authorize('update', $domainRule);

        $request->validate([
            'domain' => [
                'required',
                'regex:/^((?!-))(xn--)?[a-z0-9][a-z0-9-]{0,61}[a-z0-9]{1,}\.(xn--)?([a-z]{2,}|d[0-9]{1,3})(?!-)$/i', // Regex para validar domínio
                'unique:domain_rules,domain,' . $domainRule->id . ',id,user_id,' . Auth::id() // Validação de unicidade por usuário
            ],
            'rule_type' => 'required|in:allow,block',
            'status' => 'required|boolean',
            'priority' => 'required|integer',
        ], [
            'domain.required' => 'O campo domínio é obrigatório.',
            'domain.regex' => 'O domínio informado não é válido.',
            'domain.unique' => 'Este domínio já foi registrado para este usuário.',
            'rule_type.required' => 'O campo tipo de regra é obrigatório.',
            'status.required' => 'O campo status é obrigatório.',
            'priority.required' => 'O campo prioridade é obrigatório.',
        ]);

        $domainRule->update($request->all());

        return redirect()->route('domain-rules.index')->with('success', 'Regra atualizada com sucesso.');
    }

    public function destroy(DomainRule $domainRule)
    {
        $this->authorize('delete', $domainRule);

        $domainRule->delete();

        return redirect()->route('domain-rules.index')->with('success', 'Regra excluída com sucesso.');
    }
}
