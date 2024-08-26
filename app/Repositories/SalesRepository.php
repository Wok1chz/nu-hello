<?
namespace App\Repositories;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Collection;

class SalesRepository {
    
    public function getActiveSales(): Collection
    {
        return Sales::active()->get();
    }
}