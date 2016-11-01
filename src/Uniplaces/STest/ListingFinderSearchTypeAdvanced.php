<?php

namespace Uniplaces\STest;


final class ListingFinderSearchTypeAdvanced extends ListingFinder
{ 
    /**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
    protected function handleSearchType($listing, array $search)
    {	 
        if(!$this->checkAdress($listing, $search)) {
		   return false;
        }		
	    return $this->checkPrice($listing, $search);
    }
  
    /**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
    private function checkAdress($listing, $search) 
    {
	    if (isset($search['address'])) {
            $listingAddress = strtolower(trim($listing->getLocalization()->getAddress()));
            $address = strtolower(trim($search['address']));
					 
            if (levenshtein($listingAddress, $address) > 5) {
                return false;
            }			
        }		
	    return true;
    }
	
    /**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
	private function checkPrice($listing, $search) 
    {
        if (isset($search['price'])) {
            $listingPrice = $listing->getPrice();
			$minPricing = isset($search['price']['min']) ? $search['price']['min'] : null;
            $maxPricing = isset($search['price']['max']) ? $search['price']['max'] : null;

            if (($minPricing !== null && $minPricing > $listingPrice) || ($maxPricing !== null && $maxPricing < $listingPrice)) {
                return false;
            }
        }
        return true;
    }
}
