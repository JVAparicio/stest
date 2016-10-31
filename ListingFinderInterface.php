<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;

/**
 * ListingFinderInterface
 */
interface ListingFinderInterface
{
    /**
     * @param Listing[] $listings
     * @param array     $search The search is done by the user
     *                          Simple:
     *                          array(
     *                              'city' => 'name of city' // exact match,
     *                              // both dates must be filled or none
     *                              ['start_date' => DateTime,
     *                              'end_date' => DateTime,]
     *                              'occupation' => 'undergraduate|postgraduate|...'
     *                              )
     *                          )
     *
     *                          Advanced:
     *                          array(
     *                              'city' => 'name of city' // exact match,
     *                              // this is not an exact match, is using Levenshtein distance
     *                              // after cleaning both strings
     *                              ['address' => '...'],
     *                              ['price' => array(
     *                                  ['min' => val],
     *                                  ['max' => val],
     *                              )],
     *                              // both dates must be filled or none
     *                              ['start_date' => DateTime,
     *                              'end_date' => DateTime,]
     *                              'occupation' => 'undergraduate|postgraduate|...'
     *                              )
     *                          )
     *
     * @return Listing[]
     */
    public function reduce(array $listings, array $search);
}
