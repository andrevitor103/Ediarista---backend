<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    /**
     * Define os campos que podem ser gravados
     * @var array
     */

    protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep', 'codigo_ibge', 'foto_usuario'];

    /**
     * Define os campos que serão usados na serialização
     * @var array
     */

    protected $visible = ['nome_completo', 'cidade', 'foto_usuario', 'reputacao'];
    
    /**
     * Adiciona campos na serialização
     * @var array
     */

    protected $appends = ['reputacao'];

    /**
     * Monta a URL da imagem
     * @param string $valor
     * @return void
     */

    public function getFotoUsuarioAttribute(string $valor)
    {
        return config('app.url') . $valor;
    }

    /**
     * Retorna a reputação randomica
     * @return void
     */

    public function getReputacaoAttribute($valor){
        return mt_rand(1,5);
    }


    /**
     * Busca diaristas pelo código ibge
     * @param interger $codigoIbge
     * @return void
     */

    static public function buscaPorCodigoIbge(int $codigoIbge)
    {
        return self::where('codigo_ibge', $codigoIbge)->limit(6)->get();
    }

    /**
     * Busca total de registros das diaristas
     * @param interger $codigoIbge
     * @return void
     */

    static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
        $quantidade = self::where('codigo_ibge', $codigoIbge)->count();
        return $quantidade > 6 ? $quantidade - 6 : 0;
    }

}
