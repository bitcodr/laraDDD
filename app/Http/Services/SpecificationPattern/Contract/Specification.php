<?php namespace App\Http\Services\SpecificationPattern\Contract;

 
interface Specification
{
    public function isSatisfiedBy($candidate): bool;   
}
