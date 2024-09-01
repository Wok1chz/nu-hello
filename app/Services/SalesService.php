<?
namespace App\Services;

use App\Repositories\SalesRepository;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Collection;

class SalesService {

    public function __construct(
        protected SalesRepository $repository,
    ) {}
    
    public function getActiveSales(): Collection
    {
        return $this->repository->getActiveSales();
    }

    public function createSale(array $data): Sales
    {
        return $this->repository->createSale($data);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}