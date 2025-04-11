<?php

namespace App\OpenApi\Requests;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class MaterialstammdatenRequest extends RequestBodyFactory
{
    public function build(): \GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody
    {
        return \GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody::create('Materialstammdaten')
            ->description('Material data from SAP')
            ->required()
            ->content(
                \GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType::json()->schema(
                    Schema::object()->properties(
                        Schema::integer('material')->example(123456),
                        Schema::string('bezeichnung1')->example('Test Material'),
                        Schema::boolean('lvorm')->example(false)
                    )
                )
            );
    }
}
