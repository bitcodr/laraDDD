<?php

return [

    /*
     * Are filter queries allowed? If set to true, queries like age>18 are allowed
     */
    'allowFilters' => true,

    /*
     * The default values
     */
    'defaults' => [
        'limit' => 50,
        'sort' => [
            [
                'column'    => 'id',
                'direction' => 'desc'
            ]
        ],
    ],

    /*
     * The parameters to be excluded
     */
    'excludedParameters' => [
        'include',          // because of Fractal Transformers
        'token',            // because of JWT Auth
    ],

];
