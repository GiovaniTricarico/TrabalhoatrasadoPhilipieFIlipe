?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class produto extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        return [
        'id' => $this->id,
        'nome' => $this->nome,
        'email' => $this->preco,
        'boletim' => $this->boletim,
        'cpf' => $this->cpf,
        'telefone' => $this->telefone,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }
}    
