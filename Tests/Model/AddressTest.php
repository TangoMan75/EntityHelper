<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Tests\Model;

use TangoMan\EntityHelper\Model\Address;
use TangoMan\EntityHelper\Tests\GetMockTrait;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    use GetMockTrait;

    public function testGettersAndSetters()
    {
        $actual = new Address();
        $expected = $this->getMockItem('address.json');

//
//        $actual->setAddress($expected['address']);
//        $this->assertEquals(
//            $expected['address'],
//            $actual->getAddress()
//        );
//
        $actual->setStreet($expected['street']);
        $this->assertEquals(
            $expected['street'],
            $actual->getStreet()
        );

        $actual->setStreet2($expected['street2']);
        $this->assertEquals(
            $expected['street2'],
            $actual->getStreet2()
        );

        $actual->setCity($expected['city']);
        $this->assertEquals(
            $expected['city'],
            $actual->getCity()
        );

        $actual->setZipCode($expected['zipCode']);
        $this->assertEquals(
            $expected['zipCode'],
            $actual->getZipCode()
        );

        $actual->setCountry($expected['country']);
        $this->assertEquals(
            $expected['country'],
            $actual->getCountry()
        );

        $actual->setLat($expected['lat']);
        $this->assertEquals(
            $expected['lat'],
            $actual->getLat()
        );

        $actual->setLng($expected['lng']);
        $this->assertEquals(
            $expected['lng'],
            $actual->getLng()
        );
    }
}