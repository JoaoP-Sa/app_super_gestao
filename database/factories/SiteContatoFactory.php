<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SiteContato;
use Faker\Generator as Faker;

$factory->define(SiteContato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'telefone' => $faker->tollFreePhoneNumber,
        'email' => $faker->unique()->email, // o unique() é para definirmos o email como único por
                                        // registro
        'motivo_contato' => $faker->numberBetween(1, 3),
        'mensagem' => $faker->text(200),
    ];
});
