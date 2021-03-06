<?php
/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to support@tig.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact support@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
class TIG_Buckaroo3Extended_Test_Unit_Helper_StreetFormatterTest extends TIG_Buckaroo3Extended_Test_Framework_TIG_Test_TestCase
{
    /** @var null|TIG_Buckaroo3Extended_Helper_StreetFormatter */
    protected $_instance = null;

    /**
     * @return TIG_Buckaroo3Extended_Helper_StreetFormatter
     */
    protected function _getInstance()
    {
        if ($this->_instance === null) {
            $this->_instance = new TIG_Buckaroo3Extended_Helper_StreetFormatter();
        }

        return $this->_instance;
    }

    /**
     * @return array
     */
    public function formatProvider()
    {
        return array(
            'string, only street' => array(
                'Kabelweg',
                array(
                    'street' => 'Kabelweg',
                    'house_number' => '',
                    'number_addition' => ''
                )
            ),
            'string, with housenumber' => array(
                'Kabelweg 37',
                array(
                    'street' => 'Kabelweg',
                    'house_number' => '37',
                    'number_addition' => ''
                )
            ),
            'string, with number addition' => array(
                'Kabelweg 37 A',
                array(
                    'street' => 'Kabelweg',
                    'house_number' => '37',
                    'number_addition' => 'A'
                )
            ),
            'array, only street' => array(
                ['Kabelweg'],
                array(
                    'street' => 'Kabelweg',
                    'house_number' => '',
                    'number_addition' => ''
                )
            ),
            'array, with housenumber' => array(
                ['Kabelweg', '37'],
                array(
                    'street' => 'Kabelweg',
                    'house_number' => '37',
                    'number_addition' => ''
                )
            ),
            'array, with number addition' => array(
                ['Kabelweg', '37', 'A'],
                array(
                    'street' => 'Kabelweg',
                    'house_number' => '37',
                    'number_addition' => 'A'
                )
            ),
        );
    }

    /**
     * @param $streetData
     * @param $expected
     *
     * @dataProvider formatProvider
     */
    public function testFormat($streetData, $expected)
    {
        $instance = $this->_getInstance();
        $result = $instance->format($streetData);

        $this->assertEquals($expected, $result);
    }
}