<?php

namespace App\Imports;

use App\Actions\Listing\CreateListing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListingsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $action = new CreateListing();
        return $action->execute([
            'address_line_one' => $row['address_line_one'],
            'address_line_two' => $row['address_line_two'],
            'postcode' => $row['postcode'],
            'province' => $row['province'],
            'city' => $row['city'],
            'country' => $row['country'],
            'property_type' => $row['property_type'],
            'property_size' => $row['property_size'],
            'land_size' => $row['land_size'],
            'bedrooms' => $row['bedrooms'],
            'bathrooms' => $row['bathrooms'],
            'description' => str_replace("\u{2028}", "\n", $row['description']) ?? '',
            'specification' => str_replace("\u{2028}", "\n", $row['specification']) ?? '',
            'asking_price' => $row['asking_price'],
        ]);
    }
}
