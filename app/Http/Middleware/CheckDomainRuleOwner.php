<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DomainRule;
use Illuminate\Support\Facades\Auth;

/**
 * Classe CheckDomainRuleOwner
 *
 * Middleware para verificar se o usuário autenticado é o proprietário da regra de domínio.
 */
class CheckDomainRuleOwner
{
    /**
     * Manipula a requisição.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Certifique-se de que o nome do parâmetro da rota está correto
        $domainRule = DomainRule::find($request->route('domain_rule'));

        if (!$domainRule || $domainRule->user_id !== Auth::id()) {
            // Se a regra não existir ou o usuário não for o proprietário, redireciona com mensagem de erro
            return redirect()->route('domain-rules.index')->with('error', 'Você não tem permissão para acessar esta regra.');
        }

        return $next($request);
    }
}
