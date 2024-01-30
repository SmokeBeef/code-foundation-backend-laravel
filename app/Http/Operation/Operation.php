<?php
namespace App\Http\Operation;

use App\Http\Operation\BaseOperation;

class Operation extends BaseOperation
{
    private $total = 0;
    private $page = 0;
    private $perPage = 0;


    // setter 
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }
    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }


    // getter 
    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }
}