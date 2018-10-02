<?php namespace App\Http\Services\SpecificationPattern\Composite;

use App\Http\Services\SpecificationPattern\Contract\Specification;
use App\Http\Services\SpecificationPattern\Service\AndSpecification;
use App\Http\Services\SpecificationPattern\Service\AndNotSpecification;
use App\Http\Services\SpecificationPattern\Service\OrSpecification;

abstract class Composite implements Specification
{

    abstract public function isSatisfiedBy($candidate): bool;   


    public function andIsSatisfiedBy(Specification $spec)
    {
        return new AndSpecification($this, $spec);
    }



    public function andIsNotSatisfiedBy(Specification $spec)
    {
        return new AndNotSpecification($this, $spec);
    }



    public function orIsSatisfiedBy(Specification $spec)
    {
        return new OrSpecification($this, $spec);
    }

}
