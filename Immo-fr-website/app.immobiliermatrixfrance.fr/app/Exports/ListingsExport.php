<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListingsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'address_line_one',
            'address_line_two',
            'postcode',
            'province',
            'city',
            'country',
            'property_type',
            'property_size',
            'land_size',
            'bedrooms',
            'bathrooms',
            'asking_price',
            'description',
            'specification'
        ];
    }

}
