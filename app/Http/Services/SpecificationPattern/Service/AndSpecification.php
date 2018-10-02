<?php namespace App\Http\Services\SpecificationPattern\Service;

use App\Http\Services\SpecificationPattern\Contract\Specification;
use App\Http\Services\SpecificationPattern\Composite\Composite;

class AndSpecification extends Composite
{
    private $a;

    private $b;

    public function __construct(Specification $a, Specification $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

 
    public function isSatisfiedBy($candidate): bool
    {
        return $this->a->isSatisfiedBy($candidate) && $this->b->isSatisfiedBy($candidate);
    }
}