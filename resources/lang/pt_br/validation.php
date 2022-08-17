<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'confirmed' => 'Campo de confirmação diferente.',
    'date' => 'Formato de data inválido.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'Máximo de :max caracteres.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'O :attribute deve ser um arquivo do tipo :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'Mínimo de :min caracteres.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_regex' => 'Formato inválido.',
    'regex' => 'Formato inválido.',
    'required' => 'Campo obrigatório',
    'unique' => 'Já existente.',
    'uploaded' => 'O :attribute falhou ao tentar carregar.',
    'image' => 'O Arquivo deve ser uma imagem.',
    'integer' => 'O :attribute deve ser um inteiro.',
    'dimensions' => 'Imagem não tem as dimensões mínimas.',

];
