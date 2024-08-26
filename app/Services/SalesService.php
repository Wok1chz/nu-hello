<?
namespace App\Services;

use App\Repositories\SalesRepository;
use Illuminate\Database\Eloquent\Collection;

class SalesService {
    
    public function getActiveSales(): Collection
    {
        return (new SalesRepository())->getActiveSales();
    }
}