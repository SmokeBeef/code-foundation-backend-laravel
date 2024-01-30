<?php
namespace App\Http\DTO;

class MutationDTO extends BaseDTO
{

    public bool $isSuccess;
    protected string $message = '';
    protected array $errors = [];
    protected int $code = 400;

    protected array $validatorRules;
    protected array $validatorRulesUpdate = [];
    protected array $data;
    protected $id = null;

    /**
     * Constructor for the Mutation class.
     *
     * Only Accepts an array of configurations.
     *
     * Example usage:
     * $userMutationDTO = new UserMutationDTO([
     *     "id" => "string|null",
     *     "input" => "array<String|int>" or $request->all() or null
     * ]);
     *
     * @param array $configs An associative array of configurations.
     */
    public function __construct(array $configs)
    {
        $isIdFill = isset($configs["id"]);
        $isInputFill = isset($configs["input"]);

        $result = [
            "isSuccess" => true,
            "message" => "Success, validation query",
            "data" => [],
            "errors" => [],
            "code" => 200
        ];

        // if Id and input != null, update 
        if ($isIdFill && $isInputFill) {


            if ($this->validatorRulesUpdate)
                $result = $this->mutationConfigsValidation($configs["input"], $this->validatorRulesUpdate);
            else {
                $result = $this->mutationConfigsValidation($configs["input"], $this->validatorRules);
            }

            $this->id = $configs["id"];
            // if id != null and input == null, delete
        } elseif ($isIdFill && !$isInputFill) {

            $this->id = $configs["id"];

            // if id empty and input is fill, create
        } elseif (!$isIdFill && $isInputFill) {

            $result = $this->mutationConfigsValidation($configs["input"], $this->validatorRules);

        }
        $this->data = $result["data"];
        $this->isSuccess = $result["isSuccess"];
        $this->message = $result["message"];
        $this->errors = $result["errors"];
        $this->code = $result["code"];

    }


    public function getData(): array
    {
        return $this->data;
    }
    public function getId(): string
    {
        return $this->id;
    }
}