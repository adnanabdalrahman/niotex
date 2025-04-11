<?php

namespace App\OpenApi\Responses;

use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Illuminate\Http\Response;

class Success202 extends ResponseFactory
{
    public function build(): \GoldSpecDigital\ObjectOrientedOAS\Objects\Response
    {
        return \GoldSpecDigital\ObjectOrientedOAS\Objects\Response::create('Success202')
            ->statusCode(202)
            ->description('Material data received and queued')
            ->content(
                \GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType::json()->schema(
                    Schema::object()->properties(
                        Schema::string('message')->example('Material data received and queued')
                    )
                )
            );
    }
}
