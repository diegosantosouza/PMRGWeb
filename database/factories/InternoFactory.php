<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Interno;
use Faker\Generator as Faker;

$factory->define(Interno::class, function (Faker $faker) {
    return [
        'n' => $faker->numberBetween($min = 1000, $max = 9000),
        'status' => $faker->randomElement($array = array ('Prisão Preventiva','Condenado', 'Prisão Temporária', 'Alvará de Soltura')),
        'alojamento' => $faker->randomElement($array = array ('X1','X2', 'X3', 'X4')),
        'estagio' => $faker->randomElement($array = array ('1','2', '3', '4')),
        'processo_de_execucao' => $faker->numberBetween($min = 100000, $max = 900000),

        'nome_completo' => $faker->name($gender = 'male'|'female'),
        'sexo' => $faker->randomElement($array = array ('Masculino','Feminino')),
        'rg' => $faker->numberBetween($min = 100000, $max = 900000),
        'org_expedidor' => $faker->randomElement($array = array ('SSP/SP','SSP/RJ', 'SSP/MG', 'SSP/BA')),
        'cpf' => $faker->numberBetween($min = 100000, $max = 900000),
        'titulo_eleitor' => $faker->numberBetween($min = 100000, $max = 900000),
        'zona' => $faker->numberBetween($min = 1000, $max = 9000),
        'secao' => $faker->numberBetween($min = 100, $max = 900),
        'nacionalidade' => ('Brasil'),
        'natural' => $faker->randomElement($array = array ('São Paulo','Guarulhos', 'Jundiai', 'Arujá', 'Embu das Artes')),
        'estado' => $faker->randomElement($array = array ('SP','MG', 'RJ', 'SC', 'GO')),
        'nascimento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'idade' => $faker->numberBetween($min = 18, $max = 100),
        'estado_civil' => $faker->randomElement($array = array ('Solteiro','Casado', 'Viuvo', 'Separado')),
        'conjugue' => $faker->name($gender = 'male'|'female'),
        'pai' => $faker->name($gender = 'male'),
        'mae' => $faker->name($gender = 'female'),
        'escolaridade' => $faker->randomElement($array = array ('Ensino Fundamental','Ensino Médio', 'Superior', 'Técnico')),
        'religiao' => $faker->randomElement($array = array ('Católica','Evangélica', 'Espírita', 'Candonblé')),
        'etnia' => $faker->randomElement($array = array ('Branca','Preta', 'Parda', 'Amarela')),
        'cabelos' => $faker->randomElement($array = array ('Preto','branco', 'Loiro', 'Castanho')),
        'olhos' => $faker->randomElement($array = array ('Castanho','Preto', 'Verde', 'Azul')),
        'altura' => $faker->numberBetween($min = 150, $max = 200),
        'peso' => $faker->numberBetween($min = 50, $max = 100),
        'defeitos_fisicos' => $faker->randomElement($array = array ('Nada','Consta')),
        'sinais_nascenca' => $faker->randomElement($array = array ('Nada','Consta')),
        'cicatrizes' => $faker->randomElement($array = array ('Sim','Não')),
        'tatuagens' => $faker->randomElement($array = array ('Sim','Não')),

        'endereco' => $faker->address,
        'cidade' => $faker->randomElement($array = array ('São Paulo','Guarulhos', 'Jundiai', 'Arujá', 'Embu das Artes')),
        'telefone' => $faker->numberBetween($min = 10000000, $max = 90000000),

        'nome_guerra' => $faker->firstName($gender = 'male'|'female'),
        're' => $faker->numberBetween($min = 100000, $max = 200000),
        'funcional' => $faker->numberBetween($min = 1000000, $max = 2000000),
        'patente' => $faker->randomElement($array = array ('Soldado','Cabo', 'Sargento', 'Tenente', 'Capitão', 'Major', 'Coronel')),
        'situacao' => $faker->randomElement($array = array ('Ativo','Reserva')),
        'batalhao' => $faker->randomDigit,
        'batalhao_cidade' => $faker->randomElement($array = array ('São Paulo','Guarulhos', 'Jundiai', 'Arujá', 'Embu das Artes')),
        'admissao' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'demissao' => $faker->date($format = 'Y-m-d', $max = 'now'),

        'regime' => $faker->randomElement($array = array ('Aberto','Fechado')),
        'sit_processual' => $faker->randomElement($array = array ('Preventiva','Flagrante')),
        'reincidencia' => $faker->randomElement($array = array ('Sim','Primário')),
        'sit_anterior_prisao' => $faker->randomElement($array = array ('Ativo','Reserva')),
        'origem_processo' => $faker->randomElement($array = array ('Justiça militar','Justiça Comum', 'Justiça Federal')),
        'cpb_cpm' => $faker->randomElement($array = array ('CPM','CPB')),
        'assist_juridica' => $faker->randomElement($array = array ('Própria','Pública')),
        'vara_comarca' => ('4ª Auditoria'),
        'data_prisao' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'tipo_prisao' => $faker->randomElement($array = array ('Preventiva','Flagrante')),
        'tipo_crime' => $faker->randomElement($array = array ('Roubo','Furto', 'Homicídio')),
        'artigo' => $faker->randomElement($array = array ('155','157', '121')),
        'captura_procurado' => $faker->randomElement($array = array ('Sim','Não')),
        'captura_estado' => $faker->randomElement($array = array ('SP','MG', 'RJ', 'SC', 'GO')),
        'tipo_inclusao' => $faker->randomElement($array = array ('Mandato','Justiça Militar')),
        'procedencia' => $faker->randomElement($array = array ('47M','11M', '7M', '45M', '13M')),
        'data_liberdade_remocao' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'local' => $faker->randomElement($array = array ('São Paulo','Guarulhos', 'Jundiai', 'Arujá', 'Embu das Artes')),
        'acidente_doenca_morte' => $faker->name($gender = 'male'|'female')

    ];
});
