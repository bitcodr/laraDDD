<?php namespace App\Http\Aggregates\Customer\Specification;

use App\Http\Services\SpecificationPattern\Composite\Composite;

class CustomerHasActiveOrder extends Composite
{

    public function isSatisfiedBy($candidate): bool
    {
        return ($candidate > 0) ? true : false;
    }

}