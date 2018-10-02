<?php namespace App\Http\Services\Transformers;

use League\Fractal\Scope;
use League\Fractal\TransformerAbstract;

/**
 * this class override function includeResourceIfAvailable from TransformerAbstract
 * the purpose is modify orm relation field to snake case
 * the only change is line 86
 *
 * https://github.com/dingo/api/issues/986
 *
 * @package App\Http\Transformers
 */
class OverrideTransformerAbstract extends TransformerAbstract
{
    /**
     * jsut copy original function
     *
     * @param Scope $scope
     * @param mixed $data
     *
     * @return array|bool
     */
    public function processIncludedResources(Scope $scope, $data)
    {
        $includedData = [];

        $includes = $this->figureOutWhichIncludes($scope);

        foreach ($includes as $include) {
            $includedData = $this->includeResourceIfAvailable($scope, $data, $includedData, $include);
        }

        return $includedData === [] ? false : $includedData;
    }

    /**
     * jsut copy original function
     *
     * @param Scope $scope
     *
     * @return array
     */
    public function figureOutWhichIncludes(Scope $scope)
    {
        $includes = $this->getDefaultIncludes();

        foreach ($this->getAvailableIncludes() as $include) {
            if ($scope->isRequested($include)) {
                $includes[] = $include;
            }
        }

        foreach ($includes as $include) {
            if ($scope->isExcluded($include)) {
                $includes = array_diff($includes, [$include]);
            }
        }

        return $includes;
    }


    /**
     * override the original function，add array key to snake case
     *
     * @param Scope  $scope
     * @param mixed  $data
     * @param array  $includedData
     * @param string $include
     *
     * @return array
     */
    protected function includeResourceIfAvailable(
        Scope $scope,
        $data,
        $includedData,
        $include
    ) {
        if ($resource = $this->callIncludeMethod($scope, $include, $data)) {
            $childScope = $scope->embedChildScope($include, $resource);
            ## add snake_case
            $includedData[snake_case($include)] = $childScope->toArray();
        }

        return $includedData;
    }
}
