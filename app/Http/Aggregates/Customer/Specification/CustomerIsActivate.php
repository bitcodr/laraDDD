<?php namespace App\Http\Aggregates\Customer\Specification;

use App\Http\Services\SpecificationPattern\Composite\Composite;
use App\Http\Aggregates\Customer\Enum\CustomerEnums;

class CustomerIsActive extends Composite
{

    public function isSatisfiedBy($candidate): bool
    {
        return ($candidate !== CustomerEnums::ACTIVATE) ? true : false;
    }

}