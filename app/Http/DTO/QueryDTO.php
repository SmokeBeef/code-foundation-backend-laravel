<?php
namespace App\Http\DTO;

class QueryDTO extends BaseDTO
{
    public bool $isSuccess;
    protected string $message = '';
    protected array $errors = [];
    protected int $code = 400;

    protected array $validatorRules = [
        "id" => "nullable|string",
        "page" => "nullable|numeric|min:1",
        "perpage" => "nullable|numeric|min:1|max:50",
        "sortOrder" => "nullable|in:asc,desc",
        "sort.*.column" => "nullable|required_with:sort.*.order",
        "sort.*.order" => "nullable|required_with:sort.*.column|in:asc,desc",
        "sortBy" => "nullable|string",
        "search" => "nullable|string",
        "between.*.start" => "nullable|date|required_with:between.endDate,between.columnDate|date_format:Y-m-d",
        "between.*.end" => "nullable|date|required_with:between.startDate,between.columnDate|date_format:Y-m-d",
        "between.*.column" => "nullable|required_with:between.startDate,between.endDate",
        "groups.*" => "nullable"
    ];
    protected array $fields = ["*"];
    protected string $id;
    protected int $offset = 0;
    protected int $page = 0;
    protected int $limit = 25;
    protected array $sort = [];
    protected ?string $search = '';
    // protected string $sortOrder = 'asc';
    // protected ?string $sortBy = 'created_at';
    protected array $groups = [];
    protected ?array $between = [];

    public function __construct(array $configs)
    {
        $this->completeValidatorRules();
        $result = $this->queryConfigsValidation($configs, $this->validatorRules);
        $data = $result["data"];

        if (!$result["isSuccess"]) {
            $this->isSuccess = $result["isSuccess"];
            $this->message = $result["message"];
            $this->code = $result["code"];
            $this->errors = $result["errors"];

        } else {
            // dd($data);
            $this->isSuccess = $result["isSuccess"];
            $this->message = $result["message"];
            $this->code = $result["code"];
            $this->errors = $result["errors"];

            if (isset($data["id"])) {
                $this->setId($data["id"]);
            } else {
                $this->setAll($data);
            }

        }
    }


    private function completeValidatorRules(): void
    {
        $fields = array_map(function ($field) {
            $split = explode(".", $field);
            return end($split);
        }, $this->fields);
        $in = "|in:" . implode(",", $fields);
        $this->validatorRules["between.*.column"] .= $in;
        $this->validatorRules["sortBy"] .= $in;
        $this->validatorRules["groups.*"] .= $in;
        $this->validatorRules["sort.*.column"] .= $in;

    }

    private function setAll(array $data): void
    {
        $offset = ($data["page"] - 1) * $data["perpage"];

        $this->setLimit(+$data["perpage"]);
        $this->setOffset($offset);
        $this->setPage($data["page"]);
        $this->setSort($data["sort"]);
        $this->setSearch($data["search"]);
        $this->setGroups($data["groups"] ?? []);
        $this->setBetween($data["between"]);
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
    public function getPage(): int
    {
        return $this->page;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }
    public function getBetween(): ?array
    {
        return $this->between;
    }
    public function getId(): ?string
    {
        return $this->id;
    }
    public function getGroups(): ?array
    {
        return $this->groups;
    }
    public function getSort(): ?array
    {
        return $this->sort;
    }





    protected function setField(array $fields): void
    {
        $this->fields = $fields;
    }

    protected function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    protected function setPage(int $page): void
    {
        $this->page = $page;
    }

    protected function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    protected function setSearch(?string $search): void
    {
        $this->search = $search;
    }
    protected function setBetween(array $between): void
    {
        $this->between = $between;
    }
    protected function setId(int $id): void
    {
        $this->id = $id;
    }
    protected function setGroups(array $groups): void
    {
        $this->groups = $groups;
    }
    protected function setSort(array $sort): void
    {
        $this->sort = $sort;
    }
}