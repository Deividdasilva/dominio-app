<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe DomainRule
 *
 * Representa uma regra de domínio associada a um usuário específico.
 *
 * @property int $id ID da regra de domínio
 * @property string $domain Domínio associado à regra
 * @property string $rule_type Tipo de regra (permitir/bloquear)
 * @property bool $status Status da regra (ativa/inativa)
 * @property int $priority Prioridade da regra
 * @property int $user_id ID do usuário ao qual a regra está associada
 * @property string|null $description Descrição opcional da regra
 */
class DomainRule extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = ['domain', 'rule_type', 'status', 'priority', 'user_id', 'description'];

    /**
     * Define a relação da regra de domínio com o usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Escopo para filtrar regras de um determinado tipo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type Tipo de regra (allow/block)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('rule_type', $type);
    }

    /**
     * Escopo para filtrar regras ativas ou inativas.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $status Status da regra (true para ativa, false para inativa)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('status', $status);
    }
}
