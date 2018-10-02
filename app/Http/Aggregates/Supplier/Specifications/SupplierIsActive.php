<?php namespace App\Http\Aggregates\Supplier\Specification;

use App\Http\Services\SpecificationPattern\Composite\Composite;
use App\Http\Aggregates\Supplier\Enum\SupplierEnums;

class SupplierIsActive extends Composite
{

    public function isSatisfiedBy($candidate): bool
    {
        return ($candidate !== SupplierEnums::ACTIVATE) ? true : false;
    }

}