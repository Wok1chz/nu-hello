<?
namespace App\Repositories;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Collection;

class SalesRepository {
    
    
    public function getActiveSales(): Collection
    {
        return Sales::active()->get();
    }

    public function createSale(array $data): Sales
    {
        return Sales::create($data);
    }

    public function findById(int $id): Collection
    {
        return Sales::where('id', $id)->get();
    }
}