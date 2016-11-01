<?php

namespace Uniplaces\STest;

final class ListingFinderSearchTypeSimple extends ListingFinder
{
    /**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
    protected function handleSearchType($listing, array $search)
    {	 
        return true;
    }
}
