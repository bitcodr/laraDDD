<?php namespace App\Http\Services\QueryBuilder\Service;

use JohannesSchobel\DingoQueryMapper\Parser\DingoQueryMapper;
use JohannesSchobel\DingoQueryMapper\Parser\DingoQueryMapperBuilder;

final class QueryBuilder
{
    public static function pageinateBuilder($request, $model, $columns = ['*'])
    {
        $qm = new DingoQueryMapperBuilder($request);
        return $qm->createFromBuilder($model, $columns)->paginate();
    }

    public static function builder($request, $model, $columns = ['*'])
    {
        $qm = new DingoQueryMapperBuilder($request);
        return $qm->createFromBuilder($model, $columns)->get();
    }

    public static function collectionBuilder($request, $model, $sort = true)
    {
        $qm = new DingoQueryMapper($request);
        return $qm->createFromCollection($model, $sort)->get();
    }

    public static function collectionPaginate($request, $model, $sort = true)
    {
        $qm = new DingoQueryMapper($request);
        return $qm->createFromCollection($model, $sort)->paginate();
    }

}
