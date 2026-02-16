<?php

use App\Actions\GeoCoding\CalculateDistance;
use App\Actions\GeoCoding\GetGeoCodeAddress;

it('can get the latitude and longitude for a given street address', function () {
   $address = 'Bank Hey Street, Blackpool, FY1 4BJ, Lancashire';

   $action = new GetGeoCodeAddress();

   $location = $action->execute($address);

   $this->assertEquals(53.8155596, $location['lat']);
   $this->assertEquals(-3.0546549, $location['lon']);

});

it('can calculate the distance between two locations', function () {
    $address1 = 'Bank Hey Street, Blackpool, FY1 4BJ, Lancashire';
    $address2 = 'Manchester Airport, Manchester';

    $action = new GetGeoCodeAddress();

    $location1 = $action->execute($address1);

    $location2 = $action->execute($address2);

    $calculateDistance = new CalculateDistance();

    $actualDistance = $calculateDistance->execute(
        $location1['lat'],
        $location1['lon'],
        $location2['lat'],
        $location2['lon']
    );

    $expectedDistance = 72.553055126232;

    $this->assertEqualsWithDelta($expectedDistance, $actualDistance, 0.1);
});
